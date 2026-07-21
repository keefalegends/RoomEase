<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomEase — Stay beautifully</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f2] text-[#18221d] antialiased">
    <div class="min-h-screen overflow-hidden">
        <header class="relative z-10 mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="/" class="flex items-center gap-3" aria-label="RoomEase home">
                <span class="grid h-10 w-10 place-items-center rounded-full bg-[#1d3b2a] text-lg font-bold text-[#d8f36b]">R</span>
                <span class="text-xl font-semibold tracking-[-0.04em]">RoomEase</span>
            </a>
            <nav class="hidden items-center gap-9 text-sm font-medium text-[#526057] md:flex" aria-label="Main navigation">
                <a class="transition hover:text-[#18221d]" href="#stays">Our stays</a>
                <a class="transition hover:text-[#18221d]" href="#experience">The experience</a>
                <a class="transition hover:text-[#18221d]" href="#about">About us</a>
                <a class="transition hover:text-[#18221d]" href="{{ route('booking.lookup') }}">Cek Reservasi</a>
            </nav>
            <a href="{{ route('rooms.index') }}" class="rounded-full border border-[#d7ddd2] bg-white px-5 py-2.5 text-sm font-semibold transition hover:border-[#1d3b2a] hover:bg-[#1d3b2a] hover:text-white">Find a room</a>
        </header>

        <main>
            {{-- ═══ HERO ═══ --}}
            <section class="mx-auto grid max-w-7xl items-center gap-12 px-6 pb-20 pt-10 lg:grid-cols-[0.9fr_1.1fr] lg:px-10 lg:pb-28 lg:pt-16">
                <div class="max-w-xl">
                    <p class="mb-6 flex items-center gap-3 text-xs font-bold uppercase tracking-[0.24em] text-[#77847a]"><span class="h-px w-8 bg-[#a7b69d]"></span> Hospitality, made simple</p>
                    <h1 class="max-w-lg text-5xl font-semibold leading-[0.98] tracking-[-0.07em] text-[#1d3b2a] sm:text-6xl lg:text-7xl">A better way to <span class="font-serif italic font-normal text-[#7c946a]">stay.</span></h1>
                    <p class="mt-7 max-w-md text-base leading-7 text-[#627067]">Find a place that feels like yours. Thoughtfully designed rooms, warm service, and an easy booking experience from start to finish.</p>
                    <a href="{{ route('rooms.index') }}" class="mt-9 inline-flex items-center gap-3 rounded-full bg-[#1d3b2a] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#1d3b2a]/15 transition hover:-translate-y-0.5 hover:bg-[#31583f]">Explore rooms <span aria-hidden="true">↗</span></a>
                    <div class="mt-14 flex items-center gap-8 border-t border-[#dce2d8] pt-6 text-sm text-[#68766d]"><span><strong class="block text-xl font-semibold text-[#1d3b2a]">12+</strong> room styles</span><span><strong class="block text-xl font-semibold text-[#1d3b2a]">4.9/5</strong> guest rating</span></div>
                </div>
                <div class="relative min-h-[480px] overflow-hidden rounded-[2rem] bg-[#dce5d5] shadow-2xl shadow-[#1d3b2a]/10 lg:min-h-[610px]">
                    <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1400&q=85" alt="Interior kamar hotel yang hangat dan modern">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#18221d]/45 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 flex items-end justify-between text-white"><div><p class="text-xs uppercase tracking-[0.2em] text-white/70">Room 204</p><p class="mt-1 text-2xl font-medium tracking-tight">The Garden Suite</p></div><span class="rounded-full bg-white/15 px-4 py-2 text-sm backdrop-blur-md">From Rp 1.250.000</span></div>
                </div>
            </section>

            {{-- ═══ SEARCH BAR ═══ --}}
            <section id="search" class="relative z-10 mx-auto -mt-3 max-w-5xl px-6 lg:px-10">
                <form class="grid gap-3 rounded-2xl border border-[#e2e6df] bg-white p-3 shadow-xl shadow-[#1d3b2a]/10 md:grid-cols-[1.3fr_1fr_1fr_auto] md:items-center md:rounded-full md:p-2" action="{{ route('rooms.index') }}" method="get">
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 text-left hover:bg-[#f5f7f2]"><span class="text-xl">⌖</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Location</small><span class="text-sm font-medium">RoomEase Hotel</span></span></label>
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 text-left hover:bg-[#f5f7f2]"><span class="text-xl">↘</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check in</small><span class="text-sm font-medium text-[#849087]">Add dates</span></span></label>
                    <label class="flex items-center gap-3 rounded-full px-4 py-2.5 text-left hover:bg-[#f5f7f2]"><span class="text-xl">↗</span><span><small class="block text-[10px] font-bold uppercase tracking-widest text-[#849087]">Check out</small><span class="text-sm font-medium text-[#849087]">Add dates</span></span></label>
                    <button class="rounded-full bg-[#d8f36b] px-6 py-3.5 text-sm font-bold text-[#1d3b2a] transition hover:bg-[#c7e65c]" type="submit">Search stays</button>
                </form>
            </section>

            {{-- ═══ OUR STAYS ═══ --}}
            <section id="stays" class="mx-auto max-w-7xl px-6 py-24 lg:px-10">
                <div class="mb-10 flex items-end justify-between"><div><p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Stay your way</p><h2 class="text-4xl font-semibold tracking-[-0.06em] text-[#1d3b2a]">Rooms with room to breathe.</h2></div><a href="{{ route('rooms.index') }}" class="hidden text-sm font-semibold text-[#526057] underline decoration-[#a7b69d] underline-offset-8 md:block">View all rooms ↗</a></div>
                <div class="grid gap-6 md:grid-cols-3">
                    <article class="group"><div class="mb-5 aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=80" alt="Standard room"></div><div class="flex justify-between gap-3"><div><h3 class="text-xl font-semibold text-[#1d3b2a]">The Essential</h3><p class="mt-1 text-sm text-[#748078]">1–2 guests · King bed</p></div><p class="text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp 850k</strong><span class="text-[#8a958c]">/ night</span></p></div></article>
                    <article class="group"><div class="mb-5 aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=900&q=80" alt="Deluxe room"></div><div class="flex justify-between gap-3"><div><h3 class="text-xl font-semibold text-[#1d3b2a]">The Garden</h3><p class="mt-1 text-sm text-[#748078]">1–3 guests · King bed</p></div><p class="text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp 1.1jt</strong><span class="text-[#8a958c]">/ night</span></p></div></article>
                    <article class="group"><div class="mb-5 aspect-[4/3] overflow-hidden rounded-2xl bg-[#e2e9de]"><img class="h-full w-full object-cover transition duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=900&q=80" alt="Suite room"></div><div class="flex justify-between gap-3"><div><h3 class="text-xl font-semibold text-[#1d3b2a]">The Garden Suite</h3><p class="mt-1 text-sm text-[#748078]">1–4 guests · King bed</p></div><p class="text-right text-sm"><strong class="block text-base text-[#1d3b2a]">Rp 1.25jt</strong><span class="text-[#8a958c]">/ night</span></p></div></article>
                </div>
            </section>

            {{-- ═══ THE EXPERIENCE ═══ --}}
            <section id="experience" class="bg-[#1d3b2a] text-white">
                <div class="mx-auto max-w-7xl px-6 py-24 lg:px-10 lg:py-32">
                    <div class="grid gap-16 lg:grid-cols-2 lg:items-center">
                        <div>
                            <p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#d8f36b]">The RoomEase feeling</p>
                            <h2 class="max-w-lg text-4xl font-semibold leading-tight tracking-[-0.06em] sm:text-5xl">Small details. <span class="font-serif italic font-normal text-[#d8f36b]">Big comfort.</span></h2>
                            <p class="mt-6 max-w-md text-base leading-7 text-[#bfd0c1]">Dari sapaan pertama hingga kopi terakhir, kami menciptakan ruang untuk momen yang berarti. Nikmati waktu luang dengan cara Anda sendiri — semua yang Anda butuhkan selalu dekat.</p>
                        </div>
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="rounded-3xl bg-white/10 p-6 backdrop-blur-sm">
                                <span class="mb-4 inline-block rounded-2xl bg-[#d8f36b]/20 p-3 text-xl">☕</span>
                                <h3 class="text-lg font-bold">Morning Coffee</h3>
                                <p class="mt-2 text-sm leading-6 text-[#bfd0c1]">Kopi segar dan pilihan sarapan lokal tersedia setiap pagi dari pukul 06:00 — langsung di kamar Anda.</p>
                            </div>
                            <div class="rounded-3xl bg-white/10 p-6 backdrop-blur-sm">
                                <span class="mb-4 inline-block rounded-2xl bg-[#d8f36b]/20 p-3 text-xl">🛏️</span>
                                <h3 class="text-lg font-bold">Premium Linens</h3>
                                <p class="mt-2 text-sm leading-6 text-[#bfd0c1]">Linen hotel premium, tirai blackout, dan king-size bed dengan bantal premium untuk tidur yang nyenyak.</p>
                            </div>
                            <div class="rounded-3xl bg-white/10 p-6 backdrop-blur-sm">
                                <span class="mb-4 inline-block rounded-2xl bg-[#d8f36b]/20 p-3 text-xl">📶</span>
                                <h3 class="text-lg font-bold">Fast Wi-Fi</h3>
                                <p class="mt-2 text-sm leading-6 text-[#bfd0c1]">Koneksi internet cepat dan stabil di seluruh area hotel. Workspace nyaman di setiap kamar untuk Anda yang bekerja.</p>
                            </div>
                            <div class="rounded-3xl bg-white/10 p-6 backdrop-blur-sm">
                                <span class="mb-4 inline-block rounded-2xl bg-[#d8f36b]/20 p-3 text-xl">🤝</span>
                                <h3 class="text-lg font-bold">Warm Service</h3>
                                <p class="mt-2 text-sm leading-6 text-[#bfd0c1]">Tim kami siap membantu 24/7 dengan keramahan khas Indonesia. Layanan yang tulus, bukan sekadar formalitas.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Strip --}}
                    <div class="mt-20 grid gap-8 border-t border-white/15 pt-12 sm:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <p class="text-3xl font-bold text-[#d8f36b]">500+</p>
                            <p class="mt-1 text-sm text-[#bfd0c1]">Tamu puas yang sudah menginap bersama kami</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-[#d8f36b]">4.9/5</p>
                            <p class="mt-1 text-sm text-[#bfd0c1]">Rating rata-rata dari review tamu kami</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-[#d8f36b]">12+</p>
                            <p class="mt-1 text-sm text-[#bfd0c1]">Pilihan kamar dengan desain unik</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-[#d8f36b]">24/7</p>
                            <p class="mt-1 text-sm text-[#bfd0c1]">Layanan concierge dan bantuan tamu</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ═══ GUEST TESTIMONIALS ═══ --}}
            <section class="mx-auto max-w-7xl px-6 py-24 lg:px-10">
                <div class="mb-12 text-center">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Kata Mereka</p>
                    <h2 class="text-4xl font-semibold tracking-[-0.06em] text-[#1d3b2a]">Cerita dari tamu <span class="font-serif italic font-normal text-[#7c946a]">kami.</span></h2>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    <div class="rounded-3xl border border-[#e5ebe0] bg-white p-8 shadow-sm">
                        <div class="mb-4 text-[#d8f36b]">★★★★★</div>
                        <p class="text-sm leading-7 text-[#526057]">"Kamarnya bersih, nyaman, dan desainnya bikin betah. Stafnya ramah banget. Pasti balik lagi kalau ke sini!"</p>
                        <div class="mt-6 flex items-center gap-3 border-t border-[#edf1eb] pt-5">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#eef3ea] text-sm font-bold text-[#1d3b2a]">AR</span>
                            <div><p class="text-sm font-bold text-[#1d3b2a]">Andi Rahmawan</p><p class="text-xs text-[#748078]">The Garden Suite · Juli 2026</p></div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-[#e5ebe0] bg-white p-8 shadow-sm">
                        <div class="mb-4 text-[#d8f36b]">★★★★★</div>
                        <p class="text-sm leading-7 text-[#526057]">"Booking-nya gampang banget, tinggal pilih kamar dan bayar. Check-in cepat, kamarnya sesuai ekspektasi. Recommended!"</p>
                        <div class="mt-6 flex items-center gap-3 border-t border-[#edf1eb] pt-5">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#eef3ea] text-sm font-bold text-[#1d3b2a]">SP</span>
                            <div><p class="text-sm font-bold text-[#1d3b2a]">Sarah Putri</p><p class="text-xs text-[#748078]">The Essential · Juni 2026</p></div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-[#e5ebe0] bg-white p-8 shadow-sm">
                        <div class="mb-4 text-[#d8f36b]">★★★★★</div>
                        <p class="text-sm leading-7 text-[#526057]">"Hotelnya tenang, cocok buat yang butuh istirahat. Sarapannya enak dan Wi-Fi kencang. Worth it banget!"</p>
                        <div class="mt-6 flex items-center gap-3 border-t border-[#edf1eb] pt-5">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#eef3ea] text-sm font-bold text-[#1d3b2a]">BW</span>
                            <div><p class="text-sm font-bold text-[#1d3b2a]">Budi Wicaksono</p><p class="text-xs text-[#748078]">The Corner Suite · Mei 2026</p></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ═══ ABOUT US ═══ --}}
            <section id="about" class="mx-auto max-w-7xl px-6 pb-8 pt-8 lg:px-10">
                <div class="overflow-hidden rounded-[2.5rem] bg-[#eef3ea]">
                    <div class="grid lg:grid-cols-2">
                        <div class="p-10 sm:p-14 lg:p-16">
                            <p class="mb-4 text-xs font-bold uppercase tracking-[0.24em] text-[#7c946a]">Tentang Kami</p>
                            <h2 class="text-4xl font-semibold tracking-[-0.06em] text-[#1d3b2a] sm:text-5xl">
                                Bukan sekadar hotel. <span class="font-serif italic font-normal text-[#7c946a]">Rumah kedua.</span>
                            </h2>
                            <p class="mt-6 max-w-lg text-sm leading-7 text-[#526057]">
                                RoomEase lahir dari keyakinan sederhana: menginap di hotel seharusnya terasa mudah, hangat, dan personal. Kami bukan hotel besar dengan ribuan kamar — kami adalah boutique hotel yang percaya bahwa perhatian pada detail kecil menciptakan pengalaman besar.
                            </p>
                            <p class="mt-4 max-w-lg text-sm leading-7 text-[#526057]">
                                Setiap kamar kami dirancang dengan sentuhan natural — tekstur kayu, cahaya alami, dan tanaman hijau — untuk menciptakan suasana tenang yang jauh dari kebisingan kota. Kami ingin Anda merasa pulang, bukan sekadar check-in.
                            </p>

                            <div class="mt-10 grid gap-6 sm:grid-cols-2">
                                <div>
                                    <span class="mb-2 block text-2xl">🌿</span>
                                    <h3 class="text-sm font-bold text-[#1d3b2a]">Desain Natural</h3>
                                    <p class="mt-1 text-xs leading-5 text-[#68766d]">Material alami dan tanaman hidup di setiap sudut kamar untuk nuansa segar dan tenang.</p>
                                </div>
                                <div>
                                    <span class="mb-2 block text-2xl">🏡</span>
                                    <h3 class="text-sm font-bold text-[#1d3b2a]">Lokasi Strategis</h3>
                                    <p class="mt-1 text-xs leading-5 text-[#68766d]">Terletak di jantung kota, dekat dengan pusat bisnis, kuliner, dan destinasi wisata.</p>
                                </div>
                                <div>
                                    <span class="mb-2 block text-2xl">👨‍🍳</span>
                                    <h3 class="text-sm font-bold text-[#1d3b2a]">Kuliner Lokal</h3>
                                    <p class="mt-1 text-xs leading-5 text-[#68766d]">Sarapan dengan menu lokal segar yang disiapkan oleh koki kami setiap pagi.</p>
                                </div>
                                <div>
                                    <span class="mb-2 block text-2xl">♻️</span>
                                    <h3 class="text-sm font-bold text-[#1d3b2a]">Eco-Friendly</h3>
                                    <p class="mt-1 text-xs leading-5 text-[#68766d]">Komitmen kami pada keberlanjutan — dari amenities ramah lingkungan hingga pengelolaan energi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="relative min-h-[400px] lg:min-h-0">
                            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=85" alt="Lobby RoomEase Hotel dengan desain natural dan hangat">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#eef3ea]/40 to-transparent lg:block hidden"></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ═══ CTA BANNER ═══ --}}
            <section class="mx-auto max-w-7xl px-6 py-16 lg:px-10">
                <div class="rounded-[2.5rem] bg-[#1d3b2a] px-8 py-16 text-center text-white shadow-2xl shadow-[#1d3b2a]/20 sm:px-14 sm:py-20">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-[#d8f36b]">Siap untuk menginap?</p>
                    <h2 class="mx-auto max-w-2xl text-3xl font-semibold tracking-[-0.04em] sm:text-4xl lg:text-5xl">
                        Temukan kamar yang cocok untuk <span class="font-serif italic font-normal text-[#d8f36b]">Anda.</span>
                    </h2>
                    <p class="mx-auto mt-5 max-w-lg text-sm leading-7 text-[#bfd0c1]">Proses booking mudah dan cepat. Pilih kamar, isi data, bayar — dan Anda siap menginap dengan nyaman.</p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 rounded-full bg-[#d8f36b] px-7 py-4 text-sm font-bold text-[#1d3b2a] transition hover:bg-[#c7e65c]">
                            Jelajahi Kamar <span>↗</span>
                        </a>
                        <a href="{{ route('booking.lookup') }}" class="inline-flex items-center gap-2 rounded-full border border-white/25 px-7 py-4 text-sm font-bold text-white transition hover:bg-white/10">
                            Cek Reservasi Saya
                        </a>
                    </div>
                </div>
            </section>
        </main>

        {{-- ═══ FOOTER ═══ --}}
        <footer class="border-t border-[#dfe5dc] bg-white">
            <div class="mx-auto max-w-7xl px-6 py-12 lg:px-10">
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="grid h-9 w-9 place-items-center rounded-full bg-[#1d3b2a] text-sm font-bold text-[#d8f36b]">R</span>
                            <span class="text-lg font-bold tracking-tight text-[#1d3b2a]">RoomEase</span>
                        </div>
                        <p class="mt-3 text-xs leading-5 text-[#748078]">Boutique hotel dengan desain natural dan layanan personal. Menginap dengan nyaman, pulang dengan kenangan.</p>
                    </div>
                    <div>
                        <h4 class="mb-3 text-xs font-bold uppercase tracking-wider text-[#1d3b2a]">Hotel</h4>
                        <div class="space-y-2 text-sm text-[#748078]">
                            <a class="block transition hover:text-[#1d3b2a]" href="{{ route('rooms.index') }}">Kamar Kami</a>
                            <a class="block transition hover:text-[#1d3b2a]" href="#experience">Fasilitas</a>
                            <a class="block transition hover:text-[#1d3b2a]" href="#about">Tentang Kami</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-3 text-xs font-bold uppercase tracking-wider text-[#1d3b2a]">Tamu</h4>
                        <div class="space-y-2 text-sm text-[#748078]">
                            <a class="block transition hover:text-[#1d3b2a]" href="{{ route('booking.lookup') }}">Cek Reservasi</a>
                            <a class="block transition hover:text-[#1d3b2a]" href="{{ route('rooms.index') }}">Booking Kamar</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-3 text-xs font-bold uppercase tracking-wider text-[#1d3b2a]">Kontak</h4>
                        <div class="space-y-2 text-sm text-[#748078]">
                            <p>Jl. Ketenangan No. 12</p>
                            <p>Bandung, Jawa Barat 40115</p>
                            <p>info@roomease.id</p>
                            <p>+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex flex-col gap-4 border-t border-[#edf1eb] pt-6 text-xs text-[#748078] sm:flex-row sm:items-center sm:justify-between">
                    <p>© {{ date('Y') }} RoomEase. Stay beautifully.</p>
                    <div class="flex gap-6">
                        <a class="transition hover:text-[#1d3b2a]" href="#">Instagram</a>
                        <a class="transition hover:text-[#1d3b2a]" href="#">WhatsApp</a>
                        <a class="transition hover:text-[#1d3b2a]" href="#">Privacy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @include('components.chat-widget')
</body>
</html>
