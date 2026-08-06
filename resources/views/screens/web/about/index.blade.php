@extends('layouts.web.app')

@section('content')

    <section class="bg-white w-full py-16 px-6 md:px-12 lg:px-24 flex flex-col items-center justify-center">
        <h2
            class="text-4xl md:text-5xl lg:text-6xl font-bold font-heavitas text-[#145072] mb-16 text-center tracking-wide">
            About the Author
        </h2>

        <div class="w-full max-w-7xl flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-24">

            <div class="shrink-0">
                <div
                    class="border-4 border-[#145072] rounded-xl p-2 md:p-3 shadow-xl bg-white transition-transform hover:scale-105 duration-300">
                    <img src="{{ asset('assets/web/evelyn-kasal.jpg') }}" alt="Evelyn Kasal"
                        class="w-72 md:w-80 lg:w-96 h-auto rounded-lg object-cover">
                </div>
            </div>

            <div
                class="w-full lg:w-3/5 flex flex-col space-y-8 text-[#222] font-['Poppins'] text-lg md:text-xl lg:text-2xl italic leading-loose text-center lg:text-left">
                <p>
Writer Evelyn Kasal brings a profound perspective to her storytelling, shaped by 20 years as an educator, 32 years in sales, and sixty years of life on the farm.
<br><br>
She has navigated a tapestry of unusual life events, a 36-year marriage, and six significant long-term relationships.
<br> <br>
Today, she embraces her next chapter as a proudly independent matriarch to three children, six grandchildren, and three great-grandchildren.


            </p>

                <!-- <p> -->
                <!--     Blending a diverse background in Industrial and Civil Engineering, Journalism and Communications, and -->
                <!--     Applied Sociology, she earned a Graduate Certificate in Creative Writing from Humber College in Toronto, -->
                <!--     Canada. -->
                <!-- </p> -->
                <!---->
                <!-- <p> -->
                <!--     She is based in Duxbury, MA, USA. -->
                <!-- </p> -->
            </div>

        </div>

    </section>





@endsection

