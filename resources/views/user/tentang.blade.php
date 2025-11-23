@extends('user/layouts/app')
@section('content')
  <section class="relative w-full h-[60vh] overflow-hidden py-20">
    <!-- Background carousel -->
    <div id="carousel" class="absolute inset-0">
      <div class="slide absolute inset-0 bg-cover bg-center opacity-100 transition-opacity duration-1000"
        style="background-image: url('/images/banner4.jpg');"></div>
      <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000"
        style="background-image: url('/images/banner5.jpg');"></div>
      <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000"
        style="background-image: url('/images/banner6.jpg');"></div>
    </div>

    <div class="absolute inset-0 bg-black/75"></div>

    <div class="relative z-10 flex flex-col justify-center items-center text-center text-white px-6 h-full">
      <h2 class="text-4xl font-bold mb-4">Tentang <span class="text-violet-500">K2 Collection</span></h2>
      <p class="text-gray-400 max-w-3xl mx-auto text-lg leading-relaxed">
        <span class="text-white font-semibold">K2 Collection</span> adalah usaha konveksi lokal
        yang bergerak di bidang pembuatan pakaian custom untuk komunitas, sekolah, perusahaan,
        event, hingga instansi. Kami dikenal karena kualitas jahitan rapi, pilihan bahan lengkap,
        konsultasi desain gratis, dan proses pengerjaan cepat sesuai estimasi.
      </p>
    </div>
  </section>

  <!-- Tentang Kami -->
  <section class="relative bg-gradient-to-b from-zinc-900 to-black text-white py-20 px-6">
    <div class="max-w-5xl mx-auto text-center">
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
    </div>
  </section>

  <section class="relative bg-zinc-950 text-white py-20 px-6">
    <div class="max-w-5xl mx-auto">


      <div class="text-center mb-10">
        <h2 class="text-3xl sm:text-4xl font-bold mb-3">Lokasi & Kontak Kami</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">
          Hubungi atau kunjungi kami di Kantor produksi  K2 Collection untuk informasi dan pemesanan order.
        </p>
      </div>

      <div class="bg-white/5 border border-white/10 backdrop-blur-lg rounded-md overflow-hidden shadow-xl">

        <div class="w-full h-[350px]">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.1111851608962!2d112.5014549615759!3d-6.956748662930368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77e773b21c7d75%3A0xbfb16d05b6122dc5!2sK2%20Collection!5e0!3m2!1sid!2sid!4v1763558437595!5m2!1sid!2sid"
            class="w-full h-full" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="p-8 grid grid-cols-1 sm:grid-cols-3 gap-8">

          <div class="flex items-start gap-4">
            <i class="ri-map-pin-2-line text-violet-500 text-3xl"></i>
            <div>
              <h3 class="text-lg font-semibold mb-1">Kantor Produksi</h3>
              <p class="text-gray-400 text-sm">
                Rt.1b RW.1 Doudo, Panceng, Gresik
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <i class="ri-phone-line text-violet-500 text-3xl"></i>
            <div>
              <h3 class="text-lg font-semibold mb-1">Kontak Kami</h3>
              <p class="text-gray-400 text-sm">
                0856-4507-5556
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <i class="ri-mail-line text-violet-500 text-3xl"></i>
            <div>
              <h3 class="text-lg font-semibold mb-1">Email</h3>
              <p class="text-gray-400 text-sm">
                k2colletion@gmail.com
              </p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

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
    // =========== ICON CARD (Tentang Kami) ================
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

    // =========== BUTTON ANIMASI HALUS ================
    gsap.utils.toArray("a").forEach((btn) => {
      btn.addEventListener("mouseenter", () => {
        gsap.to(btn, { scale: 1.06, duration: 0.2 });
      });
      btn.addEventListener("mouseleave", () => {
        gsap.to(btn, { scale: 1, duration: 0.2 });
      });
    });

  </script>
@endsection