@extends('user/layouts/app')
@section('content')

    <section class="relative bg-zinc-900 text-white py-30 px-6">
        <div class="max-w-7xl mx-auto text-center mb-14">
            <h2 class="text-4xl font-bold mb-3">
                Produk <span class="text-violet-500">K2 Collection</span>
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                 Pilihan produk konveksi terbaik dengan kualitas bahan premium dan pengerjaan rapi.
            </p>

            <!-- Form Cari Produk -->
            <div class="mt-8 flex justify-center">
                <form action="{{ route('cariProduk') }}" method="GET"
                    class="flex items-center gap-3 w-full max-w-md flex-wrap sm:flex-nowrap justify-center">
                    <input name="cari" type="text" placeholder="Cari Produk..."
                        class="flex-1 rounded-md bg-white/10 px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500" />
                    <button type="submit"
                        class="bg-violet-600 hover:bg-violet-700 text-white text-sm transition px-6 py-3 rounded-md font-semibold transition-all duration-300 whitespace-nowrap">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        @if(isset($pesan))
            <p class="text-center text-gray-300 text-lg mb-10">{{ $pesan }}</p>
        @endif

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
    </section>
@endsection
@section('script')
  <script>
   
    // =========== ANIMASI JUDUL SECTION ================
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