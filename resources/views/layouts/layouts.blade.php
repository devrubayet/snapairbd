<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin-end/assets/favicon_io/apple-touch-icon.png') }}">

    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('admin-end/assets/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('admin-end/assets/favicon_io/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js']) <title>{{ $settings->site_name }}</title>
</head>

<body>
    <x-frontend.navbar />
    @yield('content')





    <x-frontend.footer />
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('menu-btn');
        const navbar = document.getElementById('navbar-default');
        
        const topLine = document.getElementById('top-line');
        const middleLine = document.getElementById('middle-line');
        const bottomLine = document.getElementById('bottom-line');

        menuBtn.addEventListener('click', () => {
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', !isExpanded);

            if (isExpanded) {
                // 1. Menu close
                navbar.classList.remove('max-h-96', 'opacity-100');
                navbar.classList.add('max-h-0', 'opacity-0');

                // 2. Back to Hamburger (Normal ৩ টা সমান্তরাল দাগ)
                topLine.setAttribute('d', 'M4 6h16');
                middleLine.classList.remove('opacity-0');
                bottomLine.setAttribute('d', 'M4 18h16');
            } else {
                // 1. Menu open
                navbar.classList.remove('max-h-0', 'opacity-0');
                navbar.classList.add('max-h-96', 'opacity-100');

                // 2. Transform to PERFECT Cross (✕)
                // Uporer line take math kore exact corner to corner diagonal line banano holo
                topLine.setAttribute('d', 'M6 18L18 6M6 6l12 12');
                
                // Majher ar nicher line absolute invisible/shunno kore dewa hocche
                middleLine.classList.add('opacity-0');
                bottomLine.setAttribute('d', 'M12 12h0'); 
            }
        });
    });
    </script>
</body>

</html>
