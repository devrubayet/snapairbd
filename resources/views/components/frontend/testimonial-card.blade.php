<div class="swiper-slide">
    <figure class="md:flex bg-slate-100 rounded-xl p-8 md:p-0 dark:bg-red-800 dark:text-white h-full overflow-hidden">
        <img class="w-24 h-24 smw-1/4 md:w-full md:h-auto md:rounded-none rounded-full mx-auto overflow-hidden"
            src="{{ $testimonial->image_url }}" alt="" width="384" height="512" />
        <div class="pt-6 md:p-8 text-center md:text-left space-y-4">
            <blockquote>
                <p class="text-lg  dark:text-white font-light leading-5">
                    “{{ $testimonial->message }}”
                </p>
            </blockquote>
            <figcaption class="font-medium">
                <div class="text-red-950 dark:text-red-950">
                    {{ $testimonial->name }}
                </div>
                <div class="text-slate-700 dark:text-slate-500">
                    {{ $testimonial->bio }}
                </div>
            </figcaption>
        </div>
    </figure>
</div>
