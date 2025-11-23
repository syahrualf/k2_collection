<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login | Cool Cloth</title>
      <link rel="icon" href="{{ asset('images/favicon.jpg') }}" type="image/png" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}" type="image/png" />
</head>

<body class="bg-black text-white">
    <section class="min-h-screen flex flex-col lg:flex-row items-stretch">
        <!-- Left Image Section -->
        <div class="lg:flex w-full lg:w-1/2 bg-gray-500 bg-no-repeat bg-cover relative items-center justify-center"
            style="background-image: url('{{ asset('images/banner1.jpg') }}');">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="relative z-10 text-center px-6 lg:px-24 py-16">
                <img src="{{ asset('images/logo.png') }}" alt="Cool Cloth Logo"
                    class="mx-auto w-80 md:w-76 mb-6 drop-shadow-lg">
                <p class="text-xl md:text-2xl">  Jasa Konveksi & Custom Clothing Berkualitas.
        Menerima pembuatan pakaian custom untuk kebutuhan komunitas, sekolah, perusahaan, event, dan instansi lainnya.</p>
            </div>
        </div>
        <!-- Right Login Form Section -->
        <div class="flex w-full lg:w-1/2 items-center justify-center relative bg-[#161616]">
            <div class="w-full max-w-md px-6 py-12">
                <!-- Social Icons -->
                <div class="flex justify-center items-center space-x-5 mb-6">
                    <a href="#"
                        class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-white text-white text-2xl hover:bg-white hover:text-black transition">
                        <i class="ri-whatsapp-line"></i>
                    </a>
                    <a href="#"
                        class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-white text-white text-2xl hover:bg-white hover:text-black transition">
                        <i class="ri-instagram-line"></i>
                    </a>
                    <a href="#"
                        class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-white text-white text-2xl hover:bg-white hover:text-black transition">
                        <i class="ri-facebook-line"></i>
                    </a>
                </div>
                <p class="text-gray-300 text-center mb-6">Masukkan username dan password</p>
                <!-- Form -->
                <form class="user" method="POST" action="{{ route('loginProses') }}">
                    @csrf
                    <div class="mb-4">
                        <input  type="text" name="username" id="username" placeholder="Username"  value="{{ old('username') }}"
                            class="block w-full p-4 text-lg rounded-md bg-black border 
                                @error('username') border-red-500 @else border-gray-700 @enderror 
                                focus:outline-none focus:border-violet-600 focus:ring-0 text-white">
                        @error('username')
                            <small class="text-red-400">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4 relative">
                        <input  type="password" name="password" id="password"placeholder="Password"
                            class="block w-full p-4 text-lg rounded-md bg-black border 
                                @error('password') border-red-500 @else border-gray-700 @enderror 
                                focus:outline-none focus:border-violet-600 focus:ring-0 text-white">

                        <!-- Icon Mata -->
                        <span 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400 hover:text-gray-200"
                            onclick="togglePassword()">
                            <i class="ri-eye-line" id="eyeIcon"></i>
                        </span>

                        @error('password')
                            <small class="text-red-400">{{ $message }}</small>
                        @enderror
                    </div>

    <!-- Back to Home -->
                        <div class="text-right mb-4">
                            <a href="{{ route('home') }}" 
                            class="text-gray-400 hover:underline hover:text-gray-200 text-sm">
                            Kembali ke Home ?
                            </a>
                        </div>
    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="uppercase w-full p-4 text-lg rounded-full  bg-violet-600 hover:bg-violet-700 focus:outline-none transition">
                        Login
                    </button>
                </form>

            </div>
        </div>
    </section>

     <script src="{{ asset('sweetalert2/dist/sweetalert2.all.js') }}"></script>

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


    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('ri-eye-line');
            eyeIcon.classList.add('ri-eye-off-line');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('ri-eye-off-line');
            eyeIcon.classList.add('ri-eye-line');
        }
    }
</script>
</body>

</html>