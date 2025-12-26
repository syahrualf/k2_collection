@extends('user/layouts/app')
@section('content')
  <section class="relative w-full h-[85vh] overflow-hidden">

    <div id="carousel" class="absolute inset-0">
      <div class="slide absolute inset-0 bg-cover bg-center opacity-100 transition-opacity duration-1000"
        style="background-image: url('/images/banner1.jpg');"></div>
      <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000"
        style="background-image: url('/images/banner2.jpg');"></div>
      <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000"
        style="background-image: url('/images/banner3.jpg');"></div>
    </div>

    <div class="absolute inset-0 bg-black/75"></div>

    <div class="relative z-10 flex flex-col justify-center items-center text-center text-white px-6 h-full">
      <h1 class="text-4xl sm:text-5xl font-bold tracking-tight ">K2 Collection</h1>
      <p class="mt-4 max-w-2xl text-lg sm:text-xl opacity-90">
        Jasa Konveksi & Custom Clothing Berkualitas.
        Menerima pembuatan pakaian custom untuk kebutuhan komunitas, sekolah, perusahaan, event, dan instansi lainnya.
      </p>

      <form action="{{ route('cariProduk') }}" method="GET"
        class="mt-8 flex flex-row items-center justify-center gap-3 w-full max-w-md flex-wrap sm:flex-nowrap">
        <input name="cari" type="text" placeholder="Cari Produk..."
          class="flex-1 rounded-md bg-white/10 px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500" />
        <button type="submit"
          class=" bg-violet-600 hover:bg-violet-700 text-white text-sm transition px-6 py-3 rounded-md font-semibold transition-all duration-300 whitespace-nowrap">
          Cari
        </button>
      </form>

    </div>
  </section>
  <section class="relative bg-zinc-900 text-white py-24 px-6">
    <div class="max-w-7xl mx-auto text-center mb-14">
      <h2 class="text-4xl font-bold mb-3">Produk <span class="text-violet-500">K2 Collection</span></h2>
      <p class="text-gray-400 max-w-2xl mx-auto">
        Pilihan produk konveksi terbaik dengan kualitas bahan premium dan pengerjaan rapi.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-7xl mx-auto">

      <!-- CARD TEMPLATE -->
      @foreach ($produk as $item)
        <div class="relative rounded-2xl overflow-hidden group cursor-pointer">
          <img src="{{ asset('storage/fotoProduk/' . $item->foto) }}"
            class="w-full h-80 object-cover transition-all duration-500 group-hover:scale-105" />

          <!-- overlay gelap -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

          <!-- content -->
          <div class="absolute bottom-0 p-6">
            <p class="text-sm text-gray-300 mb-1">{{ $item->nama }}</p>
            <h3 class="text-2xl font-semibold mb-3">Rp{{ number_format($item->harga, 0, ',', '.') }}</h3>
            <a href="{{ route('detailProduk', $item->slug) }}"
              class="inline-block bg-violet-600 hover:bg-violet-700 px-4 py-2 rounded-md text-sm font-semibold transition">
              Lihat Detail
            </a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="text-center mt-8">
      <a href="{{ route('produkKami') }}"
        class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-5 py-2 rounded-md transition">
        Lihat Semua Produk
        <i class="ri-arrow-right-line text-lg"></i>
      </a>
    </div>
  </section>
  <!-- Tentang Kami -->
  <section class="relative bg-gradient-to-b from-zinc-900 to-black text-white py-20 px-6">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-4">Tentang <span class="text-violet-500">K2 Collection</span></h2>
      <p class="text-gray-400 max-w-3xl mx-auto text-lg leading-relaxed">
        <span class="text-white font-semibold">K2 Collection</span> adalah usaha konveksi lokal
        yang bergerak di bidang pembuatan pakaian custom untuk komunitas, sekolah, perusahaan,
        event, hingga instansi. Kami dikenal karena kualitas jahitan rapi, pilihan bahan lengkap,
        konsultasi desain gratis, dan proses pengerjaan cepat sesuai estimasi.
      </p>

      <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div class="flex flex-col items-center">
          <i class="ri-t-shirt-air-line text-violet-500 text-5xl mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Bahan & Sablon Lengkap</h3>
          <p class="text-gray-400 text-sm">Tersedia bahan cotton, fleece, drill & sablon DTF, rubber, plastisol, bordir.
          </p>
        </div>

        <div class="flex flex-col items-center">
          <i class="ri-lightbulb-flash-line  text-violet-500 text-5xl mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Pengerjaan Cepat</h3>
          <p class="text-gray-400 text-sm">Estimasi 3–10 hari untuk 12–50 pcs. Bisa express.</p>
        </div>

        <div class="flex flex-col items-center">
          <i class="ri-earth-line text-violet-500 text-5xl mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Bahan & Sablon Lengkap</h3>
          <p class="text-gray-400 text-sm">Tersedia bahan cotton, fleece, drill & sablon DTF, rubber, plastisol, bordir.
          </p>
        </div>
      </div>

      <div class="mt-14">
        <a href="{{ route('tentangKami') }}"
          class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 px-6 py-3 rounded-md font-semibold text-white transition">
          Selengkapnya
          <i class="ri-arrow-right-line text-lg"></i>
        </a>
      </div>
    </div>
  </section>
  <!-- Floating Chatbot -->
  <div id="chatbot-btn"
    class="fixed bottom-6 right-6 bg-violet-600 hover:bg-violet-700 text-white px-5 py-3 rounded-full shadow-xl cursor-pointer transition transform hover:scale-105 z-50 flex items-center gap-2">
    <i class="ri-chat-3-line text-xl"></i> Chat Kami
  </div>
  <!-- Chatbox -->
  <div id="chatbox"
    class="fixed bottom-20 right-6 bg-white rounded-xl shadow-2xl border border-gray-200 hidden flex-col overflow-hidden z-50"
    style="width: 420px;">

    <!-- Header -->
    <div class="bg-violet-600 text-white px-4 py-3 flex justify-between items-center">
      <h3 class="font-semibold">K2 Chatbot</h3>
      <button id="closeChat" class="text-white text-lg hover:text-gray-200">
        ✕
      </button>
    </div>
    <!-- Quick Replies -->
    <div id="quickReplies" class="p-3 flex gap-2 flex-wrap">
      <button class="qr-btn bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded-full text-xs"
        onclick="sendQuick('produk apa saja')">Ada produk apa saja</button>

      <button class="qr-btn bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded-full text-xs"
        onclick="sendQuick('Buka jam berapa?')">Buka jam berapa?</button>

      <button class="qr-btn bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded-full text-xs"
        onclick="sendQuick('Apakah bisa order satuan?')">Apakah bisa order satuan?</button>
    </div>

    <!-- Chat Messages -->
    <div id="messages" class="p-4 h-80 overflow-y-auto space-y-3 text-sm bg-gray-50"></div>
    <!-- Input -->
    <div class="p-3 border-t border-gray-200 bg-white flex">
      <input id="chatInput" type="text" placeholder="Tulis pesan..."
        class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-violet-400 focus:outline-none" />
      <button id="sendBtn" class="ml-2 bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-md text-sm">
        Send
      </button>
    </div>
  </div>


@endsection
@section('script')
  <script>
    const slides = document.querySelectorAll('#carousel .slide');
    let current = 0;
    let interval;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.style.opacity = (i === index) ? '1' : '0';
      });
    }
    function nextSlide() {
      current = (current + 1) % slides.length;
      showSlide(current);
    }
    function resetInterval() {
      clearInterval(interval);
      interval = setInterval(nextSlide, 5000);
    }
    interval = setInterval(nextSlide, 5000);
    // ANIMASI JUDUL SECTION
    gsap.from(".max-w-7xl h2, .max-w-7xl p", {
      scrollTrigger: {
        trigger: ".max-w-7xl",
        start: "top 80%"
      },
      opacity: 0,
      y: 40,
      duration: 1.2,
      ease: "power3.out"
    });

    // ICON CARD
    gsap.utils.toArray(".grid div").forEach((box) => {
      gsap.from(box, {
        scrollTrigger: {
          trigger: box,
          start: "top 85%"
        },
        opacity: 0,
        y: 50,
        duration: 1,
        ease: "power3.out"
      });
    });

    // BUTTON ANIMASI HALUS
    gsap.utils.toArray("a").forEach((btn) => {
      btn.addEventListener("mouseenter", () => {
        gsap.to(btn, { scale: 1.06, duration: 0.2 });
      });
      btn.addEventListener("mouseleave", () => {
        gsap.to(btn, { scale: 1, duration: 0.2 });
      });
    });

    //chatbot
    const chatbotBtn = document.getElementById("chatbot-btn");
    const chatbox = document.getElementById("chatbox");
    const closeChat = document.getElementById("closeChat");
    const sendBtn = document.getElementById("sendBtn");
    const input = document.getElementById("chatInput");
    const messages = document.getElementById("messages");

    // BUKA CHAT
    chatbotBtn.onclick = () => {
      chatbox.classList.remove("hidden");
      chatbotBtn.classList.add("hidden");
    };

    // TUTUP CHAT
    closeChat.onclick = () => {
      chatbox.classList.add("hidden");
      chatbotBtn.classList.remove("hidden");
    };

    // QUICK REPLY
    function sendQuick(text) {
      addMessage(text, "user");
      processMessage(text);
    }
    // KIRIM MANUAL
    sendBtn.addEventListener("click", () => {
      let message = input.value.trim();
      if (!message) return;

      addMessage(message, "user");
      input.value = "";

      processMessage(message);
    });
    // KIRIM PAKAI ENTER
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter") {
        e.preventDefault(); 
        sendBtn.click(); 
      }
    });

    // PROSES PESAN
    async function processMessage(message) {
      // Loading bubble
      addMessage("Sebentar ya...", "bot");

      const res = await fetch("/api/chatbot", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        body: JSON.stringify({ message })
      });
      const data = await res.json();
      // Hapus loading
      messages.lastChild.remove();
      // tampilkan jawaban bot
      addMessage(data.answer ?? "Maaf, saya belum punya jawabannya 😊", "bot");
      // RENDER QUICK REPLIES JIKA ADA
      if (data.quick_replies && data.quick_replies.length > 0) {
        const qrElements = renderQuickReplies(data.quick_replies);
        messages.appendChild(qrElements);
      }

      // RENDER FAQ SUGGESTION
      if (data.faq_suggestions && data.faq_suggestions.length > 0) {
        const faqContainer = renderFaqSuggestions(data.faq_suggestions);
        messages.appendChild(faqContainer);
      }
      // scroll ke bawah
      messages.scrollTop = messages.scrollHeight;
    }
    // TAMBAH CHAT BUBBLE
    function addMessage(text, sender) {
      const msg = document.createElement("div");
      msg.className = sender === "user" ? "text-right" : "text-left";

      msg.innerHTML = `
          <div class="inline-block px-3 py-2 rounded-lg ${sender === "user"
          ? "bg-violet-600 text-white"
          : "bg-white border"
        }">
              ${text}
          </div>
        `;
      messages.appendChild(msg);
      messages.scrollTop = messages.scrollHeight;
    }

    // RENDER TOMBOL QUICK REPLY
    function renderQuickReplies(quickReplies) {
      const container = document.createElement("div");
      container.classList.add("flex", "gap-2", "flex-wrap", "mt-2");

      quickReplies.forEach(q => {
        let btn = document.createElement("button");
        btn.textContent = q.label;
        btn.className =
          "qr-btn bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded-full text-xs";
        btn.onclick = () => sendQuick(q.value);

        container.appendChild(btn);
      });

      return container;
    }
    // RENDER REKOMENDASI FAQ
    function renderFaqSuggestions(faqList) {
      const wrap = document.createElement("div");
      wrap.classList.add("mt-2", "flex", "flex-wrap", "gap-2");

      faqList.forEach(f => {
        const btn = document.createElement("button");
        btn.textContent = f.label;
        btn.className =
          "bg-blue-100 hover:bg-blue-200 px-2 py-1 rounded-full text-xs border border-blue-300";
        btn.onclick = () => sendQuick(f.value);

        wrap.appendChild(btn);
      });

      return wrap;
    }

  </script>
@endsection