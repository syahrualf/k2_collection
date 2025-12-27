<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Produk;

class ChatbotController extends Controller
{
    
     //TEXT NORMALIZATION
    private function normalize($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
// daftar kata umum yang tidak berpengaruh ke makna
        $stopwords = [
            'apa',
            'apakah',
            'yang',
            'dan',
            'di',
            'ke',
            'dari',
            'berapa',
            'saya',
            'kamu',
            'kami',
            'bisa',
            'untuk',
            'ya',
            'dong',
            'tolong',
            'mau',
            'ingin',
            'nih',
            'itu',
            'ini'
        ];

        return array_values(array_filter(
            explode(' ', $text),
            fn($w) => !in_array($w, $stopwords) && strlen($w) > 2
        ));
    }
     //COSINE SIMILARITYMenentukan FAQ mana yang paling relevan
    private function cosineSimilarity($vecA, $vecB)
    {
        $dot = $magA = $magB = 0;

        foreach ($vecA as $key => $val) {
            $dot += $val * ($vecB[$key] ?? 0);
            $magA += $val * $val;
        }

        foreach ($vecB as $val) {
            $magB += $val * $val;
        }

        return ($magA && $magB) ? $dot / (sqrt($magA) * sqrt($magB)) : 0;
    }

     //TF-IDF ENGINE Menghitung bobot setiap kata di FAQ/Kata unik diberi bobot lebih tinggi
    private function buildTfIdf($documents)
    {
        $tf = [];
        $df = [];
        $totalDocs = count($documents);

        foreach ($documents as $i => $doc) {
            $words = $this->normalize($doc);
            $counts = array_count_values($words);
            $tf[$i] = [];

            foreach ($counts as $word => $count) {
                $tf[$i][$word] = $count / max(count($words), 1);
                $df[$word] = ($df[$word] ?? 0) + 1;
            }
        }

        $tfidf = [];
        foreach ($tf as $i => $words) {
            foreach ($words as $word => $tfVal) {
                $idf = log($totalDocs / ($df[$word] ?? 1));
                $tfidf[$i][$word] = $tfVal * $idf;
            }
        }

        return $tfidf;
    }
     //SEMANTIC FAQ MATCHMencari FAQ dengan makna paling mendekati
    private function semanticFaqMatch($query, $faqs)
    {
        if ($faqs->isEmpty())
            return null;

        $documents = $faqs->pluck('question')->toArray();
        $tfidfDocs = $this->buildTfIdf($documents);

        $queryVec = [];
        foreach ($this->normalize($query) as $w) {
            $queryVec[$w] = ($queryVec[$w] ?? 0) + 1;
        }

        $bestScore = 0;
        $bestIndex = null;

        foreach ($tfidfDocs as $i => $docVec) {
            $score = $this->cosineSimilarity($queryVec, $docVec);
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestIndex = $i;
            }
        }
        // threshold = confidence
        return ($bestScore >= 0.25) ? $faqs[$bestIndex] : null;
    }
     //CONTROLLER REPLYMengirim jawaban ke frontend
    public function reply(Request $request)
    {
        $message = strtolower($request->message);
        // FAQ suggestion (random)
        $faqSuggestions = Faq::inRandomOrder()
            ->take(3)
            ->get()
            ->map(fn($f) => [
                'label' => $f->question,
                'value' => strtolower($f->question)
            ]);

          //INTENT: DETAIL PRODUK
        if (str_contains($message, 'detail')) {
            $nama = trim(str_replace('detail', '', $message));

            $produk = Produk::all()->sortByDesc(function ($p) use ($nama) {
                similar_text($nama, strtolower($p->nama), $percent);
                return $percent;
            })->first();

            if ($produk) {
                return response()->json([
                    'answer' =>
                        "📦 *Detail Produk*\n\n" .
                        "Nama: {$produk->nama}\n" .
                        "Harga: Rp" . number_format($produk->harga, 0, ',', '.') . "\n" .
                        "Deskripsi: {$produk->detail}",
                    'quick_replies' => [],
                    'faq_suggestions' => $faqSuggestions
                ]);
            }
        }
         //INTENT: LIST PRODUK
        if (str_contains($message, 'produk') || str_contains($message, 'list')) {
            $produk = Produk::all();

            return response()->json([
                'answer' => "📦 Produk tersedia:\n- " . implode("\n- ", $produk->pluck('nama')->toArray()),
                'quick_replies' => $produk->map(fn($p) => [
                    'label' => "Detail {$p->nama}",
                    'value' => "detail " . strtolower($p->nama)
                ]),
                'faq_suggestions' => $faqSuggestions
            ]);
        }
         //INTENT: HARGA PRODUK
        foreach (Produk::all() as $p) {
            if (str_contains($message, strtolower($p->nama))) {
                return response()->json([
                    'answer' => "💰 Harga {$p->nama} adalah Rp" .
                        number_format($p->harga, 0, ',', '.'),
                    'quick_replies' => [
                        [
                            'label' => "Detail {$p->nama}",
                            'value' => "detail " . strtolower($p->nama)
                        ]
                    ],
                    'faq_suggestions' => $faqSuggestions
                ]);
            }
        }
         //SEMANTIC FAQ (SMART)
        $faq = $this->semanticFaqMatch($message, Faq::all());

        if ($faq) {
            return response()->json([
                'answer' => $faq->answer,
                'quick_replies' => [],
                'faq_suggestions' => $faqSuggestions
            ]);
        }
         //FALLBACK
        return response()->json([
            'answer' =>
                "Maaf, saya belum bisa menjawab pertanyaan itu 🙏<br>" .
                "<a href='https://wa.me/6285645075556' target='_blank' class='text-blue-600 underline'>" .
                "Klik di sini untuk chat Admin WhatsApp</a>",
            'quick_replies' => [],
            'faq_suggestions' => $faqSuggestions
        ]);
    }
}
