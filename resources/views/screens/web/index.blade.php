@extends('layouts.web.app')

@section('content')
@php
    use App\Models\Cms;

    // 1. Fetch all home page CMS records with their meta data in one query
    $homeCms = Cms::with('meta')->where('page', 'home')->get()->keyBy('type');

    // 2. Helper function to safely retrieve meta values or return a fallback default
    $getMeta = function($type, $key, $default = '') use ($homeCms) {
        if (!$homeCms->has($type)) return $default;
        $meta = $homeCms->get($type)->meta->firstWhere('meta_key', $key);
        return $meta && !empty($meta->meta_value) ? $meta->meta_value : $default;
    };

    // --- Process Specific Complex Variables ---

    // Hero
    $heroBg = $getMeta('hero_section', 'background_image', asset('assets/web/hero-section.PNG'));

    // Featured Book
    $featuredCover = $getMeta('featured_book_section', 'featured_image', asset('assets/web/images/book/rare-edition-book.jpg'));
    $galleryJson = $getMeta('featured_book_section', 'gallery_images');
    // If no gallery images in DB, fallback to default back cover
    $galleryImages = $galleryJson ? json_decode($galleryJson, true) : [asset('assets/web/images/book/book-back.jpg')];
    // Combine main cover and gallery for the slider
    $allBookImages = array_merge([$featuredCover], $galleryImages);
    $bookRating = (int) $getMeta('featured_book_section', 'rating', 5);

    // About Author
    $aboutImage = $getMeta('about_section', 'author_image', asset('assets/web/evelyn-kasal.jpg'));
@endphp

<!-- HERO SECTION -->
<section
    class="relative w-full bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ $heroBg }}');">

    <!-- Overlay to ensure text and navbar remain readable -->
    <div class="absolute inset-0 "></div>

    <div class="relative z-10 w-full px-12 md:px-24 pt-40 pb-16 md:pb-24 flex flex-col-reverse lg:flex-row items-center justify-between max-w-screen-2xl mx-auto">

        <div class="w-full lg:w-1/2 pr-0 lg:pr-16 mt-12 lg:mt-0 flex flex-col items-start">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gray-600 mb-4 font-['Poppins']">
                {{ $getMeta('hero_section', 'badge', 'Memoir & Autobiography') }}
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#145072] mb-6 leading-tight font-heavitas drop-shadow-sm">
                {{ $getMeta('hero_section', 'title', 'How Many Unusual Events in One Life?') }}
            </h1>

            <p class="text-gray-700 mb-10 text-lg font-['Poppins'] leading-relaxed font-medium">
                {!! nl2br(e($getMeta('hero_section', 'description', 'Discover RARE EDITION, the compelling memoir by Evelyn Kasal. Explore six decades of farm life, resilient career transitions, and unexpected twists in this extraordinary true story.'))) !!}
            </p>

            <a href="{{ $getMeta('hero_section', 'button_link', 'https://www.amazon.com/Rare-Many-Unusual-Events-Life/dp/B0BSRHG1MC') }}"
                class="px-8 py-4 bg-[#145072] text-white rounded-full uppercase tracking-widest font-bold shadow-xl hover:bg-opacity-90 transition-all font-['Poppins']">
                {{ $getMeta('hero_section', 'button_text', 'Buy Now Amazon') }}
            </a>
        </div>
    </div>
</section>

<!-- FEATURED BOOK SECTION -->
<section class="bg-[#F5F5F5] w-full py-16 md:py-24 px-6 md:px-12 lg:px-24 font-['Poppins']">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

        <!-- Left Column: Gallery & Meta Information -->
        <div class="lg:col-span-5 flex flex-col w-full max-w-md mx-auto lg:mx-0">

            <!-- Gallery Container -->
            <div id="featured-book-gallery" class="w-full flex flex-col gap-4">

                <!-- Main Image Swiper -->
                <div style="--swiper-navigation-color: #145072; --swiper-pagination-color: #145072" class="swiper featuredMainSwiper w-full aspect-[4/5] rounded-sm overflow-hidden bg-white shadow-xl">
                    <div class="swiper-wrapper h-full">
                        @foreach($allBookImages as $imgSrc)
                        <div class="swiper-slide h-full flex justify-center items-center bg-gray-100 p-4">
                            <a href="{{ $imgSrc }}" class="h-full w-full flex justify-center items-center pswp-link">
                                <img src="{{ $imgSrc }}" class="h-full w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500" alt="Book Image" />
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Thumbnails Swiper -->
                <div thumbsSlider="" class="swiper featuredThumbSwiper w-full h-24 mt-2">
                    <div class="swiper-wrapper flex gap-4">
                        @foreach($allBookImages as $imgSrc)
                        <div class="swiper-slide w-1/2 h-full cursor-pointer rounded-sm overflow-hidden border-2 border-transparent swiper-slide-thumb-active:border-[#145072] bg-white p-2 flex justify-center items-center transition-all opacity-60 swiper-slide-thumb-active:opacity-100 shadow-sm">
                            <img src="{{ $imgSrc }}" class="w-full h-full object-contain" alt="Book Thumbnail" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Meta Information (Below Gallery) -->
            <div class="mt-8 border-t border-gray-300 pt-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-500 mb-2 block">
                    {{ $getMeta('featured_book_section', 'badge', 'Memoir & Autobiography') }}
                </span>
                <h4 class="text-xl md:text-2xl font-bold font-heavitas text-[#333] mb-3 leading-snug">
                    {{ $getMeta('featured_book_section', 'left_title', 'RARE EDITION: How Many Unusual Events in One Life?') }}
                </h4>

                <div class="flex items-center gap-6 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-gray-300">
                            <img src="{{ $getMeta('featured_book_section', 'author_photo', asset('assets/web/evelyn-kasal.jpg')) }}" class="object-cover w-full h-full" alt="Author" />
                        </div>
                        <span class="font-bold text-sm text-[#333]">{{ $getMeta('featured_book_section', 'author_name', 'Evelyn Kasal') }}</span>
                    </div>

                    <!-- Dynamic Stars -->
                    <div class="flex items-center text-[#ff6b00] gap-0.5">
                        @for($i = 0; $i < $bookRating; $i++)
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @endfor
                        @for($i = $bookRating; $i < 5; $i++)
                        <svg class="w-4 h-4 fill-gray-300" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @endfor
                    </div>
                </div>

                <a href="{{ $getMeta('featured_book_section', 'button_link', 'https://www.amazon.com/Rare-Many-Unusual-Events-Life/dp/B0BSRHG1MC') }}" target="_blank" class="block w-full text-center px-8 py-4 bg-[#145072] text-white rounded-full uppercase tracking-widest font-bold shadow-xl hover:bg-opacity-90 transition-all">
                    {{ $getMeta('featured_book_section', 'button_text', 'Buy Now') }}
                </a>
            </div>
        </div>

        <!-- Right Column: Book Details & Synopsis -->
        <div class="lg:col-span-7 flex flex-col justify-start pt-4 lg:pl-8">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heavitas text-[#333] leading-tight mb-8">
                {{ $getMeta('featured_book_section', 'right_title', 'RARE EDITION: How Many Unusual Events in One Life?') }}
            </h2>

            @if($intro = $getMeta('featured_book_section', 'right_intro', 'Dive into an intimate look at one woman\'s remarkable journey through the unexpected turns that shaped her extraordinary story.'))
            <p class="text-xl md:text-2xl italic text-gray-700 font-medium mb-8 leading-relaxed">
                {{ $intro }}
            </p>
            @endif

            <div class="text-gray-600 text-lg leading-loose space-y-6">
                {!! nl2br(e($getMeta('featured_book_section', 'right_description', "Drawing from six decades of rich experiences, Evelyn Kasal chronicles her path from a family farm to a 50-year career in education and sales leadership. Her narrative captures the resilience, humor, and wisdom gained from a life fully lived.\n\nThis captivating memoir offers an authentic personal odyssey. Kasal candidly explores her 36-year marriage, raising a growing family across three generations, and navigating six significant long-term relationships."))) !!}
            </div>
        </div>

    </div>
</section>

<!-- ABOUT AUTHOR SECTION -->
<section class="bg-white w-full py-16 px-6 md:px-12 lg:px-24 flex flex-col items-center justify-center">
    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heavitas text-[#145072] mb-16 text-center tracking-wide">
        {{ $getMeta('about_section', 'title', 'About the Author') }}
    </h2>

    <div class="w-full max-w-7xl flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-24">

        <div class="shrink-0">
            <div class="border-4 border-[#145072] rounded-xl p-2 md:p-3 shadow-xl bg-white transition-transform hover:scale-105 duration-300">
                <img src="{{ $aboutImage }}" alt="Author" class="w-72 md:w-80 lg:w-96 h-auto rounded-lg object-cover">
            </div>
        </div>

        <div class="w-full lg:w-3/5 flex flex-col space-y-8 text-[#222] font-['Poppins'] text-lg md:text-xl lg:text-2xl italic leading-loose text-center lg:text-left">
            <p>
                {!! nl2br(e($getMeta('about_section', 'description', "Writer Evelyn Kasal brings a profound perspective to her storytelling, shaped by 20 years as an educator, 32 years in sales, and sixty years of life on the farm.\n\nShe has navigated a tapestry of unusual life events, a 36-year marriage, and six significant long-term relationships.\n\nToday, she embraces her next chapter as a proudly independent matriarch to three children, six grandchildren, and three great-grandchildren."))) !!}
            </p>
        </div>

    </div>
</section>

<!-- NEWSLETTER SECTION -->
<section class="bg-white w-full py-20 px-6 md:px-12 lg:px-24 flex flex-col items-center justify-center text-center">
    <div class="max-w-2xl w-full">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-['heavitas'] text-[#145072] mb-4 tracking-wide">
            {{ $getMeta('newsletter_section', 'title', 'Subscribe to Newsletter') }}
        </h2>

        <p class="text-gray-500 font-['Poppins'] text-base md:text-lg mb-10">
            {{ $getMeta('newsletter_section', 'description', "Stay updated with Evelyn Kasal's latest book releases, blog posts, and exclusive news delivered straight to your inbox.") }}
        </p>

        <form action="#" method="POST" class="w-full flex flex-col sm:flex-row items-center justify-center gap-4">
            <input type="email" name="email" placeholder="Enter your email address" required
                class="w-full sm:flex-1 px-5 py-4 border border-gray-300 rounded-md focus:outline-none focus:border-[#145072] focus:ring-1 focus:ring-[#145072] font-['Poppins'] text-[#333] shadow-sm transition-colors">
            <button type="submit"
                class="w-full sm:w-auto px-10 py-4 bg-[#145072] text-white rounded-full uppercase tracking-widest font-bold shadow-xl hover:bg-opacity-90 transition-all font-['Poppins']">
                Subscribe
            </button>
        </form>
    </div>
</section>

<!-- Required PhotoSwipe CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe.min.css">

<!-- Script for initializing the 2-image gallery -->
<script type="module">
    import PhotoSwipeLightbox from 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe-lightbox.esm.min.js';
    import PhotoSwipe from 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.2/photoswipe.esm.min.js';

    window.featuredGalleryStore = window.featuredGalleryStore || { main: null, thumbs: null, lightbox: null };

    window.initFeaturedGallery = function() {
        const galleryEl = document.getElementById('featured-book-gallery');
        if (!galleryEl) return;

        document.querySelectorAll('.pswp-link').forEach(link => {
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

        const thumbsEl = document.querySelector('.featuredThumbSwiper');
        const mainEl = document.querySelector('.featuredMainSwiper');

        if (mainEl && mainEl.swiper) mainEl.swiper.destroy(true, true);
        if (thumbsEl && thumbsEl.swiper) thumbsEl.swiper.destroy(true, true);
        if (window.featuredGalleryStore.lightbox) {
            window.featuredGalleryStore.lightbox.destroy();
            window.featuredGalleryStore.lightbox = null;
        }

        const thumbSwiper = new Swiper(".featuredThumbSwiper", {
            spaceBetween: 16,
            slidesPerView: 2,
            freeMode: true,
            watchSlidesProgress: true,
            observer: true,
            observeParents: true,
        });

        const mainSwiper = new Swiper(".featuredMainSwiper", {
            spaceBetween: 10,
            thumbs: { swiper: thumbSwiper },
            observer: true,
            observeParents: true,
            effect: 'fade',
            fadeEffect: { crossFade: true }
        });

        const lightbox = new PhotoSwipeLightbox({
            gallery: '#featured-book-gallery',
            children: '.pswp-link',
            pswpModule: PhotoSwipe,
            initialZoomLevel: 'fit',
            secondaryZoomLevel: 2,
            maxZoomLevel: 4,
        });

        lightbox.init();

        window.featuredGalleryStore.main = mainSwiper;
        window.featuredGalleryStore.thumbs = thumbSwiper;
        window.featuredGalleryStore.lightbox = lightbox;
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', window.initFeaturedGallery);
    } else {
        window.initFeaturedGallery();
    }

    document.addEventListener('livewire:navigated', () => {
        setTimeout(window.initFeaturedGallery, 50);
    });
</script>
@endsection
