@extends('layouts.web.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
@php
    use App\Models\Cms;

    // 1. Fetch contact page CMS records with their meta data
    $contactCms = Cms::with('meta')->where('page', 'contact')->get()->keyBy('type');

    // 2. Safe retrieval helper function
    $getMeta = function($type, $key, $default = '') use ($contactCms) {
        if (!$contactCms->has($type)) return $default;
        $meta = $contactCms->get($type)->meta->firstWhere('meta_key', $key);
        return $meta && !empty($meta->meta_value) ? $meta->meta_value : $default;
    };

    // --- Core Section Variables ---
    $pageTitle = $getMeta('get_in_touch_section', 'page_title', 'CONTACT');
    $pageSubtitle = $getMeta('get_in_touch_section', 'page_subtitle', 'Have a question about the book, or just want to say hello? I\'d love to hear from you.');

    $sectionHeading = $getMeta('get_in_touch_section', 'section_heading', 'GET IN TOUCH');
    $sectionDesc = $getMeta('get_in_touch_section', 'section_description', 'Whether you are interested in a reading, a signed copy of How Many Unusual Events in One Life? or simply want to share your thoughts, feel free to reach out.');

    // Contact Details
    $emailLabel = $getMeta('get_in_touch_section', 'email_label', 'Email');
    $emailValue = $getMeta('get_in_touch_section', 'email_value', 'info@evelynkasal.com');
    $emailIcon = $getMeta('get_in_touch_section', 'email_icon', 'fa-regular fa-envelope');

    $locLabel = $getMeta('get_in_touch_section', 'location_label', 'Location');
    $locValue = $getMeta('get_in_touch_section', 'location_value', 'Duxbury, MA, USA');
    $locIcon = $getMeta('get_in_touch_section', 'location_icon', 'fa-solid fa-location-dot');

    // Socials
    $instagram = $getMeta('get_in_touch_section', 'social_instagram');
    $xTwitter = $getMeta('get_in_touch_section', 'social_x');
    $facebook = $getMeta('get_in_touch_section', 'social_facebook');
@endphp

    <section class="bg-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-bold text-[#145072] font-heavitas tracking-wide mb-6">
                    {{ $pageTitle }}
                </h1>
                @if($pageSubtitle)
                <p class="text-gray-600 text-lg md:text-xl font-['Poppins']">
                    {{ $pageSubtitle }}
                </p>
                @endif
            </div>
        </div>
    </section>

    <section class="bg-[#F5F5F5] w-full py-16 px-6 md:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">

            <!-- Left Side: Contact Information & Blurb -->
            <div class="flex flex-col space-y-10">

                <div>
                    <h2 class="text-3xl md:text-4xl font-bold font-heavitas text-[#145072] mb-6 tracking-wide">
                        {{ $sectionHeading }}
                    </h2>
                    <p class="text-gray-600 text-lg leading-loose font-['Poppins']">
                        {!! nl2br(e($sectionDesc)) !!}
                    </p>
                </div>

                <div class="space-y-8 font-['Poppins']">
                    <!-- Email Block -->
                    <div class="flex items-start gap-5 group">
                        <div class="w-14 h-14 rounded-full bg-white shadow-md flex items-center justify-center text-[#145072] text-xl group-hover:-translate-y-1 transition-transform">
                            <i class="{{ $emailIcon }}"></i>
                        </div>
                        <div>
                            <h4 class="text-[#145072] font-bold text-lg mb-1">{{ $emailLabel }}</h4>
                            <a href="mailto:{{ $emailValue }}" class="text-gray-600 hover:text-[#145072] transition-colors">
                                {{ $emailValue }}
                            </a>
                        </div>
                    </div>

                    <!-- Location Block -->
                    <div class="flex items-start gap-5 group">
                        <div class="w-14 h-14 rounded-full bg-white shadow-md flex items-center justify-center text-[#145072] text-xl group-hover:-translate-y-1 transition-transform">
                            <i class="{{ $locIcon }}"></i>
                        </div>
                        <div>
                            <h4 class="text-[#145072] font-bold text-lg mb-1">{{ $locLabel }}</h4>
                            <p class="text-gray-600">{{ $locValue }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h4 class="text-[#145072] font-bold text-lg mb-4 font-['Poppins']">Follow Me</h4>
                    <div class="flex items-center gap-4">
                        @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#145072] hover:text-[#145072] transition-all text-xl hover:-translate-y-1">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        @endif

                        @if($xTwitter)
                        <a href="{{ $xTwitter }}" target="_blank" class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#145072] hover:text-[#145072] transition-all text-xl hover:-translate-y-1">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        @endif

                        @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#145072] hover:text-[#145072] transition-all text-xl hover:-translate-y-1">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        @endif

                        @if(!$instagram && !$xTwitter && !$facebook)
                        <span class="text-xs text-gray-400 italic">No social profiles configured.</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="bg-white rounded-xl shadow-2xl p-8 md:p-10 font-['Poppins']">

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-md p-4 text-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-[#145072] mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Jane"
                                class="w-full px-4 py-3 border {{ $errors->has('first_name') ? 'border-red-500' : 'border-gray-200' }} rounded-md focus:outline-none focus:border-[#145072] focus:ring-1 focus:ring-[#145072] transition-colors bg-gray-50 focus:bg-white">
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#145072] mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe"
                                class="w-full px-4 py-3 border {{ $errors->has('last_name') ? 'border-red-500' : 'border-gray-200' }} rounded-md focus:outline-none focus:border-[#145072] focus:ring-1 focus:ring-[#145072] transition-colors bg-gray-50 focus:bg-white">
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#145072] mb-2">Email Address</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="jane@example.com"
                            class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-md focus:outline-none focus:border-[#145072] focus:ring-1 focus:ring-[#145072] transition-colors bg-gray-50 focus:bg-white">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#145072] mb-2">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Speaking Engagement, Book Inquiry, etc."
                            class="w-full px-4 py-3 border {{ $errors->has('subject') ? 'border-red-500' : 'border-gray-200' }} rounded-md focus:outline-none focus:border-[#145072] focus:ring-1 focus:ring-[#145072] transition-colors bg-gray-50 focus:bg-white">
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#145072] mb-2">Message</label>
                        <textarea name="message" rows="5" placeholder="Write your message here..."
                            class="w-full px-4 py-3 border {{ $errors->has('message') ? 'border-red-500' : 'border-gray-200' }} rounded-md focus:outline-none focus:border-[#145072] focus:ring-1 focus:ring-[#145072] transition-colors bg-gray-50 focus:bg-white resize-y">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full px-8 py-4 bg-[#145072] text-white rounded-full uppercase tracking-widest font-bold shadow-xl hover:bg-opacity-90 transition-all hover:-translate-y-1">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </section>
@endsection
