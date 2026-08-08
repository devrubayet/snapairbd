 <nav class=" bg-red-600 shadow-lg outline-none fixed w-full z-20 top-0 start-0 border-b text-gray-300">
     <div class="max-w-6xl flex flex-wrap items-center justify-between mx-auto py-1 px-4">
         <a href="https://snapairbd.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
             <img src="{{ asset('storage/' . $settings->logo) }}" class="h-10" alt="Snapairbd" />
         </a>
         <button id="menu-btn" type="button"
    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-lg md:hidden hover:bg-slate-200 hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-300"
    aria-controls="navbar-default" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    
    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
        <path id="top-line" d="M4 6h16" class="transition-all duration-300"></path>
        <path id="middle-line" d="M4 12h16" class="transition-all duration-300"></path>
        <path id="bottom-line" d="M4 18h16" class="transition-all duration-300"></path>
    </svg>
</button>
         <div class="max-h-0 opacity-0 overflow-hidden transition-all duration-300 ease-in-out w-full md:max-h-screen md:opacity-100 md:block md:w-auto"
             id="navbar-default">
             <ul
                 class="font-medium flex flex-col md:p-0 mt-2 bg-indigo-950 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent">
                 <li>
                     <a href="{{ route('home') }}"
                         class="block py-2 px-3 {{ request()->routeIs('home') ? 'text-white' : '' }} rounded md:bg-transparent md:text-fg-brand md:p-0"
                         aria-current="page">Home</a>
                 </li>
                 <li>
                     <a href="{{ route('about') }}"
                         class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary {{ request()->routeIs('about') ? 'text-white' : '' }} hover:text-white md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">About</a>
                 </li>
                 <li>
                     <a href="#"
                         class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Services</a>
                 </li>
                 <li>
                     <a href="#"
                         class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Pricing</a>
                 </li>
                 <li>
                     <a href="#"
                         class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Contact</a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
