@extends('user/layouts/app')
@section('content')
    <section class="bg-zinc-950 text-gray-100 min-h-screen py-24 px-6">
        <div class="max-w-5xl mx-auto">

            <!-- Header -->
            <div class="mb-10 border-b border-zinc-800 pb-4">
                <h2 class="text-3xl font-semibold tracking-tight">Detail Produk</h2>
                <p class="text-sm text-gray-400 mt-1">Cool Cloth <span
                        class="text-violet-600 font-medium">#{{ $produk->slug }}</span> · {{ now()->format('F d, Y') }}</p>
            </div>

            <div
                class="bg-zinc-900 rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row md:items-center md:justify-between">

                <div class="md:w-1/2 bg-zinc-800 p-6 flex items-center justify-center">
                    <img src="{{ asset('storage/fotoProduk/' . $produk->foto) }}" alt="{{ $produk->nama }}"
                        class="w-120 h-85 max-w-md rounded-sm object-cover shadow-lg" />
                </div>

                <div class="md:w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-3">{{ $produk->nama }}</h1>
                        <p class="text-xl text-violet-600 font-semibold mb-2">
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                            {!! nl2br(e($produk->detail ?? 'Tidak ada deskripsi produk.')) !!}
                        </p>
                    </div>

                    <!-- Info Tambahan -->
                    <div class="border-t border-zinc-800 pt-4 mt-4 text-sm text-gray-400">
                        <p class="mt-1">Kategori: <span
                                class="text-gray-300">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                        </p>
                    </div>

                    <!-- Tombol Beli -->
                    <a href="https://wa.me/62859175727576?text=Halo%20saya%20ingin%20menanyakan%20pesanan%20#{{ $produk->slug }}"
                        class="mt-8 bg-violet-600 hover:bg-violet-700 transition-all duration-300 text-white py-3 rounded-lg text-base font-semibold shadow-md block text-center">
                        Hubungi Admin
                    </a>
                </div>

            </div>
            <!-- Footer / Informasi Pembaruan -->
            <div class="mt-12 text-sm text-gray-400 border-t border-zinc-800 pt-6">
                <p>Terakhir diperbarui:
                    <span class="text-gray-300 font-medium">
                        {{ $produk->updated_at->translatedFormat('d F Y, H:i') }} WIB
                    </span>
                </p>
            </div>

        </div>
    </section>
@endsection