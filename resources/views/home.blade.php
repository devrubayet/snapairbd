@extends('layouts.layouts')

@section('content')
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">

        <div class="bg-white rounded-2xl shadow-xl w-96 p-6">

            <p class="text-red-900 border font-thin border-red-950 rounded-xl p-1 bg-red-600 bg-opacity-20 mb-6">
                No Data Found
            </p>

            <div class="flex justify-end gap-2">
                <button onclick="closeModal()" class="px-4 py-2 rounded bg-gray-200">
                    Close
                </button>
                <button class="px-4 py-2 rounded bg-indigo-600 text-white">
                    Download
                </button>
            </div>
        </div>
    </div>
    <!-- hero section -->
    <section class="relative bg-gray-100">
        <div class="herro-wrapper absolute top-0 left-0 right-0 bottom-0 max-h-85.5">
            <div class="overlaping absolute top-0 bottom-0 left-0 right-0 z-10 "></div>
            <video class="block bg-cover bg-no-repeat bg-center saturate-200  relative w-full h-full object-cover object-center z-1"
                src="https://www.pexels.com/download/video/29713296/" type=" video/mp4" muted loop autoplay></video>
        </div>
        <div class="content max-w-7xl pt-17.5 md:pt-37.5 pb-15 px-4 w-full mx-auto my-0 relative z-10">
            <div class="title flex flex-col gap-3 mb-8">
                <div class="title">
                    <h1 class="text-white -tracking-wide text-3xl md:text-4xl leading-[48px] font-semibold mb-4">
                        Welcome To
                        <strong class="font-semibold italic text-4xl md:text-5xl">SnapAir</strong>
                    </h1>
                </div>
                <div class="description text-white font-normal leading-6 text-lg m-0 p-0">
                    <p>Find Flights, Hotels, Visa & Holidays</p>
                </div>
            </div>
            <x-frontend.visatrack-card/>
        </div>
    </section>

    <!-- exclusive-offer -->
    <section class="exlusive-offer bg-gray-100 py-20">
        <div class="wrapper max-w-7xl mx-auto p-4">
            <h2 class="text-xl md:text-3xl font-bold p-2">Exclusive Offer</h2>

            <div class="crousal m-2 p-4 text-white">
                <div class="swiper mySwiper w-full">
                    <div class="swiper-wrapper">
                        @foreach ($offers as $offer)
                            <div class="swiper-slide h-[168px] w-[357.333px]">
                                <a class="group block" href="#" target="_blank">
                                    <div class="relative h-[168px] rounded-lg overflow-hidden">
                                        <!-- Background Image -->
                                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $offer->img) }}"
                                            alt="" />

                                        <!-- Indigo Slide-up Overlay -->
                                        <div
                                            class="absolute inset-0 bg-indigo-900 text-white translate-y-full group-hover:translate-y-0 transition-all duration-500 ease-out px-5 py-4 flex flex-col justify-center">
                                            <!-- LEFT TOP SVG -->
                                            <div class="absolute top-0 left-0">
                                                <svg width="133" height="108" viewBox="0 0 133 108" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_14_14749)">
                                                        <path
                                                            d="M130.555 16.6804C130.555 65.2815 91.1556 104.68 42.554 104.68C-6.04747 104.68 -45.4468 65.2815 -45.4468 16.6804C-45.4468 -31.9206 -6.04747 -71.3196 42.554 -71.3196C91.1556 -71.3196 130.555 -31.9206 130.555 16.6804ZM-19.0465 16.6804C-19.0465 50.7012 8.53299 78.2804 42.554 78.2804C76.5751 78.2804 104.155 50.7012 104.155 16.6804C104.155 -17.3403 76.5751 -44.9196 42.554 -44.9196C8.53299 -44.9196 -19.0465 -17.3403 -19.0465 16.6804Z"
                                                            fill="url(#paint0_linear_14_14749)"></path>
                                                    </g>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_14_14749" x1="-1.44636"
                                                            y1="-43.8196" x2="77.5533" y2="97.681"
                                                            gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="white" stop-opacity="0.16"></stop>
                                                            <stop offset="1" stop-color="white" stop-opacity="0.04">
                                                            </stop>
                                                            <stop offset="1" stop-color="white" stop-opacity="0">
                                                            </stop>
                                                        </linearGradient>
                                                        <clipPath id="clip0_14_14749">
                                                            <rect width="132.001" height="108" fill="white"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>

                                            <!-- RIGHT BOTTOM SVG -->
                                            <div class="absolute bottom-0 right-0">
                                                <svg width="90" height="90" viewBox="0 0 90 90" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_14_14745)">
                                                        <circle cx="55.8447" cy="111.899" r="58.7617"
                                                            fill="url(#paint0_linear_14_14745)" fill-opacity="0.7">
                                                        </circle>
                                                        <circle cx="100.246" cy="66.2156" r="63.972"
                                                            fill="url(#paint1_linear_14_14745)" fill-opacity="0.7">
                                                        </circle>
                                                    </g>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_14_14745" x1="26.4639"
                                                            y1="71.5005" x2="79.2159" y2="165.987"
                                                            gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="white" stop-opacity="0.08"></stop>
                                                            <stop offset="1" stop-color="white" stop-opacity="0">
                                                            </stop>
                                                        </linearGradient>
                                                        <linearGradient id="paint1_linear_14_14745" x1="68.2604"
                                                            y1="22.2349" x2="125.69" y2="125.099"
                                                            gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="white" stop-opacity="0.08"></stop>
                                                            <stop offset="1" stop-color="white" stop-opacity="0">
                                                            </stop>
                                                        </linearGradient>
                                                        <clipPath id="clip0_14_14745">
                                                            <rect width="90" height="90" fill="white"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>

                                            <!-- DETAILS -->
                                            <h4 class="font-bold text-xl title">{{ $offer->title }}</h4>
                                            <p class="text-sm mt-1 desc">
                                                {{ $offer->short_desc }}
                                            </p>
                                            <div class="text-xs mt-2 opacity-80 underline">
                                                View Details
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                    <div class="swiper-pagination custom-pagination relative"></div>
                </div>
            </div>

            <div class="offer-add mt-8 mx-3 p-7">
                <div class="ads-img w-full h-32 rounded-md overflow-hidden">
                    <img class="w-full h-full object-f" src="img/showcase" alt="" />
                </div>
            </div>
        </div>
    </section>

    <!-- airlines list -->
    <section class="airlines bg-slate-200 py-24">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-center text-4xl font-semibold mb-4">
                Top Airlines Are With Us
            </h2>

            <p class="max-w-3xl mx-auto text-center text-gray-500 leading-tight mb-10">
                Snapairbd's user-friendly platform connects you to top airlines
                instantly. Enjoy a comfortable and hassle-free journey on any
                destination.
            </p>

            <!-- GRID -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2">
                <!-- CARD -->
                @foreach ($airlines as $airline)
                    <div
                        class="card group hover:bg-white rounded-lg border-x-2 shadow border-indigo-900 px-4 py-2 flex items-center gap-2 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                        <img class="w-5 h-5 sm:w-8 sm:h-8" src="{{ asset('storage/' . $airline->image) }}"
                            alt="" />

                        <h2 class="text-xs md:text-sm font-thin flex-1">
                            {{ $airline->name }}
                        </h2>

                        <i
                            class="fa-solid fa-greater-than transition-all duration-300 group-hover:translate-x-2 group-hover:text-indigo-500 text-slate-400 text-sm"></i>
                    </div>
                @endforeach



            </div>
        </div>
    </section>

    <!-- testimonial -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-center text-3xl font-bold">What Our Clients Say's</h2>
            <div class="crousal my-6 p-10">
                <div class="swiper testimonialSwiper  w-full">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <x-frontend.testimonial-card :testimonial="$testimonial" />
                        @endforeach




                    </div>
                    <div class="swiper-pagination custom-pagination relative"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- fotter -->
    
@endsection
