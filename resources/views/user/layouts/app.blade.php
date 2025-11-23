<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>K2 Collection | {{ $title }}</title>
    <link rel="icon" href="{{ asset('images/favicon.jpg') }}" type="image/png" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}" type="image/png" />
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <nav class="bg-gray-900/90 backdrop-blur supports-[backdrop-filter]:bg-gray-900/70 fixed w-full z-50 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6 w-auto">
                    </a>
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('home') }}"
                            class="nav-item rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white {{ $menuHome ?? '' }}">
                            Home
                        </a>
                        <a href="{{ route('produkKami') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white {{ $menuProduk ?? '' }}">Produk</a>
                        <a href="{{ route('tentangKami') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white {{ $menuTentang ?? '' }} ">Tentang
                            Kami</a>
                    </div>

                </div>

                <div class="hidden md:flex items-center">
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 rounded-full bg-violet-600 hover:bg-violet-700 text-white text-sm transition">
                        Login
                    </a>
                </div>

                <!-- Tombol Mobile -->
                <div class="md:hidden">
                    <button id="menu-toggle" class="text-gray-400 hover:text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2 bg-gray-900 border-t border-gray-700">
            <a href="{{ route('home') }}"
                class="block text-gray-300 hover:text-white py-2 font-medium {{ $menuHome ?? '' }}">Home</a>
            <a href="{{ route('produkKami') }}"
                class="block text-gray-300 hover:text-white py-2 font-medium {{ $menuProduk ?? '' }}">Produk</a>
            <a href="{{ route('tentangKami') }}"
                class="block text-gray-300 hover:text-white py-2 font-medium {{ $menuTentang ?? '' }}">Tentang
                Kami</a>
            <a href="{{ route('login') }}"
                class="block text-center py-2 mt-2 rounded-full  bg-violet-600 hover:bg-violet-700 text-white transition">
                Login
            </a>
        </div>
    </nav>



    <main>
        @yield('content')
    </main>
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Brand -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Cool Cloth Logo" class="h-7">
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Jasa Konveksi & Custom Clothing Berkualitas.
                        Menerima pembuatan pakaian custom untuk kebutuhan komunitas, sekolah, perusahaan, event, dan
                        instansi lainnya.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition">Beranda</a></li>
                        <li><a href="{{ route('produkKami') }}" class="hover:text-indigo-400 transition">Produk</a></li>
                        <li><a href="{{ route('tentangKami') }}" class="hover:text-indigo-400 transition">Tentang
                                Kami</a></li>
                    </ul>
                </div>

                <!-- Contact / Sosial -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="ri-map-pin-line text-indigo-400 mr-2"></i> Rt.1b RW.1 Doudo, Panceng, Gresik</li>
                        <li><i class="ri-mail-line text-indigo-400 mr-2"></i> k2colletion@gmail.com</li>
                        <li><i class="ri-phone-line text-indigo-400 mr-2"></i> 0856-4507-5556</li>
                    </ul>

                    <!-- Social Media -->
                    <div class="flex space-x-4 mt-4">
                        <a href="#"
                            class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-600 hover:bg-indigo-500 hover:border-indigo-500 hover:text-white transition">
                            <i class="ri-facebook-line"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-600 hover:bg-indigo-500 hover:border-indigo-500 hover:text-white transition">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-600 hover:bg-indigo-500 hover:border-indigo-500 hover:text-white transition">
                            <i class="ri-whatsapp-line"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} K2 Collection. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Toggle menu mobile
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.js')}}"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#4F46E5"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonColor: "#4F46E5"
            });
        </script>
    @endif


</body>

</html>
@yield('script')