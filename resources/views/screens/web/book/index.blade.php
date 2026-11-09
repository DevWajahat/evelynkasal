@extends('layouts.web.app')

@section('content')
@php
    use App\Models\Cms;

    // 1. Fetch all books page CMS records with their meta data
    // (Using 'books' as defined in your CMS controller)
    $booksCms = Cms::with('meta')->where('page', 'book')->get()->keyBy('type');

    // 2. Helper function to safely retrieve meta values or return a fallback default
    $getMeta = function($type, $key, $default = '') use ($booksCms) {
        if (!$booksCms->has($type)) return $default;
        $meta = $booksCms->get($type)->meta->firstWhere('meta_key', $key);
        return $meta && !empty($meta->meta_value) ? $meta->meta_value : $default;
    };

    // --- Process Specific Variables ---
    $bannerTitle = $getMeta('storytelling_section', 'banner_title', 'Books');

    // Images
    $featuredCover = $getMeta('storytelling_section', 'featured_image', asset('assets/web/book-evelyn.png'));
    $galleryJson = $getMeta('storytelling_section', 'gallery_images');
    $galleryImages = $galleryJson ? json_decode($galleryJson, true) : [asset('assets/web/images/book/book-back.jpg')];
    $allBookImages = array_merge([$featuredCover], $galleryImages);

    $authorPhoto = $getMeta('storytelling_section', 'author_photo', asset('assets/web/evelyn-kasal.jpg'));

    // Ratings
    $bookRating = (int) $getMeta('storytelling_section', 'rating', 5);
@endphp

    <section class="bg-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold text-[#145072] font-heavitas tracking-wide">
                    {{ $bannerTitle }}
                </h1>
            </div>
        </div>
    </section>

    <section class="bg-[#F5F5F5] py-16 md:py-24 antialiased font-poppins">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start justify-center">

                <!-- Left Side: Gallery -->
                <div class="flex flex-row gap-4 w-full lg:w-auto shrink-0 justify-center h-[400px] sm:h-[500px] lg:h-[550px]"
                    id="books-page-gallery">

                    <!-- Main Image Swiper -->
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper booksMainSwiper w-[280px] sm:w-[380px] lg:w-[450px] h-full rounded-sm overflow-hidden bg-[#262626] shadow-xl">
                        <div class="swiper-wrapper h-full">
                            @foreach($allBookImages as $imgSrc)
                            <div class="swiper-slide h-full flex justify-center items-center bg-[#fff]">
                                <a href="{{ $imgSrc }}" class="h-full w-full flex justify-center items-center pswp-link">
                                    <img src="{{ $imgSrc }}" class="h-full w-auto object-contain drop-shadow-2xl" alt="Book Cover View" />
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Thumbnails Swiper (Vertical) -->
                    <div thumbsSlider="" class="swiper booksThumbSwiper bg-[#F5F5F5] w-20 sm:w-24 h-full shrink-0">
                        <div class="swiper-wrapper bg-[#F5F5F5] flex flex-col h-full">
                            @foreach($allBookImages as $imgSrc)
                            <div class="swiper-slide !h-auto aspect-[3/4] mb-3 cursor-pointer rounded-sm overflow-hidden border-2 border-transparent swiper-slide-thumb-active:border-[#145072] bg-white p-1 flex justify-center items-center transition-all opacity-70 swiper-slide-thumb-active:opacity-100 shadow-sm">
                                <img src="{{ $imgSrc }}" class="w-full h-full object-contain" alt="Thumb Cover" />
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Right Side: Details & CTA -->
                <div class="flex flex-col space-y-5 pt-2 w-full lg:max-w-lg text-center lg:text-left">
                    <span class="text-sm font-bold tracking-widest text-gray-500 uppercase">
                        {{ $getMeta('storytelling_section', 'badge', 'Biographies & Memoirs') }}
                    </span>

                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold font-heavitas text-[#145072] leading-tight tracking-wide">
                        {{ $getMeta('storytelling_section', 'book_title', 'Rare Edition: How Many Unusual Events in One Life?') }}
                    </h2>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 border-2 border-[#145072]">
                                <img src="{{ $authorPhoto }}" class="object-cover w-full h-full" alt="Author" />
                            </div>
                            <span class="font-bold text-lg text-[#333] whitespace-nowrap">
                                {{ $getMeta('storytelling_section', 'author_name', 'Evelyn Kasal') }}
                            </span>
                        </div>

                        <!-- Star Ratings -->
                        <div class="flex items-center text-[#ff6b00] gap-1">
                            @for($i = 0; $i < $bookRating; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            @endfor
                            @for($i = $bookRating; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-gray-300" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            @endfor
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-4 w-full">
                        <a href="{{ $getMeta('storytelling_section', 'button_link', 'https://www.amazon.com/Rare-Many-Unusual-Events-Life/dp/B0BSRHG1MC') }}" target="_blank"
                            class="bg-[#145072] text-white rounded-full h-14 px-8 text-sm md:text-base font-bold uppercase tracking-widest shadow-xl hover:bg-opacity-90 transition-all w-full sm:w-auto flex items-center justify-center">
                            {{ $getMeta('storytelling_section', 'button_text', 'Buy Now') }}
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Required PhotoSwipe CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe.min.css">

    <script type="module">
        import PhotoSwipeLightbox from 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe-lightbox.esm.min.js';
        import PhotoSwipe from 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe.esm.min.js';

        window.booksGalleryStore = window.booksGalleryStore || {
            main: null,
            thumbs: null,
            lightbox: null
        };

        window.initBooksPageGallery = function() {
            const galleryEl = document.getElementById('books-page-gallery');
            const thumbsEl = document.querySelector('.booksThumbSwiper');

            if (!galleryEl || !thumbsEl) return;

            // 1. Reliably set PhotoSwipe dimensions AFTER images actually load
            document.querySelectorAll('#books-page-gallery .pswp-link').forEach(link => {
                const img = link.querySelector('img');
                if (!img) return;

                const setDimensions = () => {
                    link.setAttribute('data-pswp-width', img.naturalWidth || 800);
                    link.setAttribute('data-pswp-height', img.naturalHeight || 1200);
                };

                if (img.complete) {
                    setDimensions();
                } else {
                    img.addEventListener('load', setDimensions);
                }
            });

            // 2. Cleanup previous instances (for Livewire navigation)
            if (galleryEl.swiper) galleryEl.swiper.destroy(true, true);
            if (thumbsEl.swiper) thumbsEl.swiper.destroy(true, true);
            if (window.booksGalleryStore.lightbox) {
                window.booksGalleryStore.lightbox.destroy();
                window.booksGalleryStore.lightbox = null;
            }

            // 3. Initialize Swiper
            const thumbSwiper = new Swiper(".booksThumbSwiper", {
                direction: 'vertical',
                spaceBetween: 10,
                slidesPerView: 3,
                freeMode: true,
                watchSlidesProgress: true,
                observer: true,
                observeParents: true,
            });

            const mainSwiper = new Swiper(".booksMainSwiper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                thumbs: {
                    swiper: thumbSwiper
                },
                observer: true,
                observeParents: true,
            });

            // 4. Initialize PhotoSwipe
            const lightbox = new PhotoSwipeLightbox({
                gallery: '#books-page-gallery',
                children: '.pswp-link',
                pswpModule: PhotoSwipe,
                initialZoomLevel: 'fit',
                secondaryZoomLevel: 2,
                maxZoomLevel: 4,
            });

            lightbox.init();

            window.booksGalleryStore.main = mainSwiper;
            window.booksGalleryStore.thumbs = thumbSwiper;
            window.booksGalleryStore.lightbox = lightbox;
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', window.initBooksPageGallery);
        } else {
            window.initBooksPageGallery();
        }

        document.addEventListener('livewire:navigated', () => {
            setTimeout(window.initBooksPageGallery, 50);
        });
    </script>
@endsection
