<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Produk;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $message = strtolower($request->message);
        // Ambil FAQ untuk rekomendasi 
        $faqList = Faq::inRandomOrder()->take(2)->get()->map(function ($f) {
            return [
                "label" => $f->question,
                "value" => strtolower($f->question)
            ];
        });

        // INTENT: DETAIL PRODUK
        if (str_contains($message, 'detail')) {

            $nama = trim(str_replace('detail', '', $message));

            $produk = Produk::all()->filter(function ($p) use ($nama) {
                return similar_text($nama, strtolower($p->nama), $percent) && $percent > 50;
            })->first();

            if ($produk) {
                return response()->json([
                    "answer" =>
                        "-Detail Produk-\n\n" .
                        "Nama: {$produk->nama}\n" .
                        "Harga: Rp" . number_format($produk->harga, 0, ',', '.') . "\n" .
                        "Detail: {$produk->detail}",
                    "quick_replies" => [],
                    "faq_suggestions" => $faqList
                ]);
            }
            return response()->json([
                "answer" => "Produk tidak ditemukan, coba ketik nama produk lain ya 😊",
                "quick_replies" => [],
                "faq_suggestions" => $faqList
            ]);
        }

        // INTENT: LIST PRODUK
        if (str_contains($message, 'produk') || str_contains($message, 'list')) {

            $produk = Produk::all();
            $qr = [];

            foreach ($produk as $p) {
                $qr[] = [
                    "label" => "Detail " . $p->nama,
                    "value" => "detail " . strtolower($p->nama)
                ];
            }

            return response()->json([
                "answer" => "Berikut produk yang tersedia:\n- " . implode("\n- ", $produk->pluck('nama')->toArray()),
                "quick_replies" => $qr,
                "faq_suggestions" => $faqList
            ]);
        }

        // INTENT: HARGA + FUZZY
        $produk = Produk::all();

        foreach ($produk as $p) {
            if (similar_text($message, strtolower($p->nama), $percent) && $percent > 50) {

                return response()->json([
                    "answer" =>
                        "Harga {$p->nama} adalah Rp" . number_format($p->harga, 0, ',', '.'),
                    "quick_replies" => [
                        [
                            "label" => "Detail {$p->nama}",
                            "value" => "detail " . strtolower($p->nama)
                        ]
                    ],
                    "faq_suggestions" => $faqList
                ]);
            }
        }

        // INTENT: FAQ
        $faqs = Faq::all();

        foreach ($faqs as $f) {
            if (similar_text($message, strtolower($f->question), $percent) && $percent > 60) {
                return response()->json([
                    "answer" => $f->answer,
                    "quick_replies" => [],
                    "faq_suggestions" => $faqList
                ]);
            }
        }
        // FALLBACK
        return response()->json([
            "answer" => 'Maaf, saya belum punya jawabannya. 
                <br><a href="https://wa.me/6285645075556" target="_blank" class="text-blue-600 underline">
                Klik di sini untuk chat Admin WhatsApp
                </a> 😊',
            "quick_replies" => [],
            "faq_suggestions" => $faqList
        ]);
    }
}
