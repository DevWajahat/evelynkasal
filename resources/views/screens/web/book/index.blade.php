@extends('layouts.web.app')

@section('content')
    <section class="bg-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold text-[#145072] font-heavitas tracking-wide">
                    Books
                </h1>
            </div>
        </div>
    </section>

    <section class="bg-[#F5F5F5] py-16 md:py-24 antialiased font-poppins">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start justify-center">

                <div class="flex flex-row gap-4 w-full lg:w-auto shrink-0 justify-center h-[400px] sm:h-[500px] lg:h-[550px]"
                    id="books-page-gallery">

                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper booksMainSwiper w-[280px] sm:w-[380px] lg:w-[450px] h-full rounded-sm overflow-hidden bg-[#262626] shadow-xl">
                        <div class="swiper-wrapper h-full">

                            <div class="swiper-slide h-full flex justify-center items-center bg-[#fff]">
                                <a href="{{ asset('assets/web/images/book/rare-edition-book.jpg') }}" target="_blank" data-pswp-width=""
                                    data-pswp-height="" class="h-full w-full flex justify-center items-center pswp-link">
                                    <img src="{{ asset('assets/web/images/book/rare-edition-book.jpg') }}"
                                        class="h-full w-auto object-contain drop-shadow-2xl"
                                        alt="Eureka And The Magical Trio Cover"
                                        onload="this.parentElement.setAttribute('data-pswp-width', this.naturalWidth); this.parentElement.setAttribute('data-pswp-height', this.naturalHeight);" />
                                </a>
                            </div>

                            <div class="swiper-slide h-full flex justify-center items-center bg-white">
                                <a href="{{ asset('assets/web/images/book/book-back.jpg') }}" target="_blank" data-pswp-width=""
                                    data-pswp-height="" class="h-full w-full flex justify-center items-center pswp-link">
                                    <img src="{{ asset('assets/web/images/book/book-back.jpg') }}"
                                        class="h-full w-auto object-contain drop-shadow-2xl" alt="Gallery Image 1"
                                        onload="this.parentElement.setAttribute('data-pswp-width', this.naturalWidth); this.parentElement.setAttribute('data-pswp-height', this.naturalHeight);" />
                                </a>
                            </div>

                            <!-- <div class="swiper-slide h-full flex justify-center items-center bg-white"> -->
                            <!--     <a href="assets/web/book-gallery-2.jpg" target="_blank" data-pswp-width="" -->
                            <!--         data-pswp-height="" class="h-full w-full flex justify-center items-center pswp-link"> -->
                            <!--         <img src="assets/web/book-gallery-2.jpg" -->
                            <!--             class="h-full w-auto object-contain drop-shadow-2xl" alt="Gallery Image 2" -->
                            <!--             onload="this.parentElement.setAttribute('data-pswp-width', this.naturalWidth); this.parentElement.setAttribute('data-pswp-height', this.naturalHeight);" /> -->
                            <!--     </a> -->
                            <!-- </div> -->

                        </div>
                    </div>

                    <div thumbsSlider="" class="swiper booksThumbSwiper bg-white w-20 sm:w-24 h-full shrink-0">
                        <div class="swiper-wrapper bg-white flex flex-col h-full">

                            <div
                                class="swiper-slide !h-auto aspect-[3/4] mb-3 cursor-pointer rounded-sm overflow-hidden border-2 border-transparent swiper-slide-thumb-active:border-[#145072] bg-white p-1 flex justify-center items-center transition-all opacity-70 swiper-slide-thumb-active:opacity-100">
                                <img src="{{ asset('assets/web/book-evelyn.png') }}" class="w-full h-full object-contain"
                                    alt="Thumb Cover" />
                            </div>

                            <div
                                class="swiper-slide !h-auto aspect-[3/4] mb-3 cursor-pointer rounded-sm overflow-hidden border-2 border-transparent swiper-slide-thumb-active:border-[#145072] bg-white p-1 flex justify-center items-center transition-all opacity-70 swiper-slide-thumb-active:opacity-100">
                                <img src="{{ asset('assets/web/images/book/book-back.jpg') }}"
                                    class="w-full h-full object-contain" alt="Thumb Gallery 1" />
                            </div>

                            <!-- <div -->
                            <!--     class="swiper-slide !h-auto aspect-[3/4] mb-3 cursor-pointer rounded-sm overflow-hidden border-2 border-transparent swiper-slide-thumb-active:border-[#145072] bg-white p-1 flex justify-center items-center transition-all opacity-70 swiper-slide-thumb-active:opacity-100"> -->
                            <!--     <img src="assets/web/book-gallery-2.jpg" class="w-full h-full object-contain" -->
                            <!--         alt="Thumb Gallery 2" /> -->
                            <!-- </div> -->

                        </div>
                    </div>

                </div>

                <div class="flex flex-col space-y-5 pt-2 w-full lg:max-w-lg text-center lg:text-left">
                    <span class="text-sm font-bold tracking-widest text-gray-500 uppercase">
                        Biographies & Memoirs
                    </span>

                    <h2
                        class="text-3xl sm:text-4xl md:text-5xl font-bold font-heavitas text-[#145072] leading-tight tracking-wide">
                        Rare Edition: How Many Unusual Events in One Life?
                    </h2>

                    <div class="flex items-baseline justify-center lg:justify-start gap-3 mt-1">
                        <span class="text-3xl font-black text-[#145072]">$51</span>
                        <!-- <span class="text-2xl text-gray-400 line-through font-bold decoration-[3px]">$13</span> -->
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 border-2 border-[#145072]">
                                <img src="{{ asset('assets/web/evelyn-kasal.jpg') }}" class="object-cover w-full h-full"
                                    alt="Evelyn Kasal" />
                            </div>
                            <span class="font-bold text-lg text-[#333] whitespace-nowrap">Evelyn Kasal</span>
                        </div>
                        <div class="flex items-center text-[#ff6b00] gap-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-4 w-full">
                        <a href="https://www.amazon.com/Rare-Many-Unusual-Events-Life/dp/B0BSRHG1MC/ref=mp_s_a_1_1?s=books&sr=1-1"
                            class="bg-[#145072] text-white rounded-full h-14 px-8 text-sm md:text-base font-bold uppercase tracking-widest shadow-xl hover:bg-opacity-90 transition-all w-full sm:w-auto flex items-center justify-center">
                            Buy Now
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

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

            if (galleryEl.swiper) galleryEl.swiper.destroy(true, true);
            if (thumbsEl.swiper) thumbsEl.swiper.destroy(true, true);
            if (window.booksGalleryStore.lightbox) {
                window.booksGalleryStore.lightbox.destroy();
                window.booksGalleryStore.lightbox = null;
            }

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
