@extends('layouts.web.app')

@section('content')
@php
    use App\Models\Cms;

    // 1. Fetch all about page CMS records with their meta data
    $aboutCms = Cms::with('meta')->where('page', 'about')->get()->keyBy('type');

    // 2. Helper function to safely retrieve meta values or return a fallback default
    $getMeta = function($type, $key, $default = '') use ($aboutCms) {
        if (!$aboutCms->has($type)) return $default;
        $meta = $aboutCms->get($type)->meta->firstWhere('meta_key', $key);
        return $meta && !empty($meta->meta_value) ? $meta->meta_value : $default;
    };

    // --- Process Specific Variables ---
    $aboutImage = $getMeta('about_section', 'author_image', asset('assets/web/evelyn-kasal.jpg'));
    $title = $getMeta('about_section', 'title', 'ABOUT THE AUTHOR');

    // Default fallback text if database is completely empty
    $defaultDesc = "Writer Evelyn Kasal brings a profound perspective to her storytelling, shaped by 20 years as an educator, 32 years in sales, and sixty years of life on the farm.\n\nShe has navigated a tapestry of unusual life events, a 36-year marriage, and six significant long-term relationships.\n\nToday, she embraces her next chapter as a proudly independent matriarch to three children, six grandchildren, and three great-grandchildren.";

    $description = $getMeta('about_section', 'description', $defaultDesc);
@endphp

    <section class="bg-white w-full py-16 px-6 md:px-12 lg:px-24 flex flex-col items-center justify-center">
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold font-heavitas text-[#145072] mb-16 text-center tracking-wide uppercase">
            {{ $title }}
        </h2>

        <div class="w-full max-w-7xl flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-24">

            <!-- Author Image -->
            <div class="shrink-0">
                <div class="border-4 border-[#145072] rounded-xl p-2 md:p-3 shadow-xl bg-white transition-transform hover:scale-105 duration-300">
                    <img src="{{ $aboutImage }}" alt="Author Image"
                        class="w-72 md:w-80 lg:w-96 h-auto rounded-lg object-cover">
                </div>
            </div>

            <!-- Author Biography -->
            <div class="w-full lg:w-3/5 flex flex-col space-y-8 text-[#222] font-['Poppins'] text-lg md:text-xl lg:text-2xl italic leading-loose text-center lg:text-left">
                <p>
                    {!! nl2br(e($description)) !!}
                </p>
            </div>

        </div>

    </section>

@endsection
