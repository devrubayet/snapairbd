<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            <img class="img-fluid " src="{{ asset('admin-end/assets/favicon_io/favicon-32x32.png') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
            <img class="img-fluid w-100" src="{{ asset('admin-end/assets/favicon_io/favicon-32x32.png') }}" alt="logo" />
        </a>
    </div>

    <ul class="nav">

        <!-- Profile Section -->
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle" src="{{ asset('admin-end/assets/images/faces/face15.jpg') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Str::limit(Auth::user()->name, 12, '...') }}</h5>
                        <span>{{ Auth::user()->user_type }}</span>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item nav-category"><span class="nav-link">Navigation</span></li>

        <li class="nav-item menu-items {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-icon"><i class="mdi mdi-home"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item menu-items {{ request()->routeIs('our-slider.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#slider-menu"
                aria-expanded="{{ request()->routeIs('our-slider.*') ? 'true' : 'false' }}"
                aria-controls="slider-menu">
                <span class="menu-icon"><i class="mdi mdi-image"></i></span>
                <span class="menu-title">Our Slider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('all-slider') ? 'show' : '' }}" id="slider-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('all-slider') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('all-slider') }}">
                            <span class="menu-icon"><i class="mdi mdi-image-multiple"></i></span>

                            All Sliders</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('service-create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('service-create') }}">
                            <span class="menu-icon"><i class="mdi mdi-library-plus"></i></span>
                            Add Slider</a>
                    </li>

                </ul>
            </div>
        </li>

        <li class="nav-item menu-items {{ request()->routeIs('create-airline') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#airlines-menu"
                aria-expanded="{{ request()->routeIs('create-airline') ? 'true' : 'false' }}"
                aria-controls="airlines-menu">
                <span class="menu-icon"><i class="mdi mdi-airplane"></i></span>
                <span class="menu-title">Airlines List</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('create-airline') ? 'show' : '' }}" id="airlines-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('showAirlines') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('showAirlines') }}">
                            <span class="menu-icon"><i class="mdi mdi-airplane"></i></span>
                            All Airlines</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('create-airline') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('create-airline') }}">
                            <span class="menu-icon"> <i class="mdi mdi-plus-circle"></i></span>
                            Add Airline</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items {{ request()->routeIs('all-testi.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#feedback-menu"
                aria-expanded="{{ request()->routeIs('all-testi.*') ? 'true' : 'false' }}"
                aria-controls="feedback-menu">
                <span class="menu-icon"><i class="mdi mdi-message"></i></span>
                <span class="menu-title">Feedback</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('all-testi.*') ? 'show' : '' }}" id="feedback-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('all-testi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('all-testi') }}">
                            <span class="menu-icon"><i class="mdi mdi-message-text"></i></span>
                            All Feedback
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('create-testi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('create-testi') }}"> 
                            <span class="menu-icon"><i class="mdi mdi-message-plus"></i></span>
                            Add Feedback</a>
                    </li>
                </ul>
            </div>
        </li>

        
        <li class="nav-item menu-items {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#siteinfo-menu"
                aria-expanded="{{ request()->routeIs('settings.*') ? 'true' : 'false' }}"
                aria-controls="siteinfo-menu">
                <span class="menu-icon"><i class="mdi mdi-information"></i></span>
                <span class="menu-title">Site Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('settings.*') ? 'show' : '' }}" id="siteinfo-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('settings-edit') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('settings-edit') ? 'active' : '' }}"
                            href="{{ route('settings-edit') }}">
                            <span class="menu-icon"><i class="mdi mdi-settings"></i></span>
                            Settings 
                        </a>
                    </li>

                </ul>
            </div>
        </li>


        <li class="nav-item menu-items {{ request()->routeIs('bank.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#bank-menu"
                aria-expanded="{{ request()->routeIs('bank.*') ? 'true' : 'false' }}"
                aria-controls="bank-menu">
                <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                <span class="menu-title">Bank Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('bank.*') ? 'show' : '' }}" id="bank-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('all-bank') ? 'active' : '' }}">
                        {{-- <a class="nav-link" href="{{ route('all-bank') }}"> --}}
                            <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                            All Bank Details
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('bank-create') ? 'active' : '' }}">
                        {{-- <a class="nav-link" href="{{ route('bank-create') }}"> --}}
                            <span class="menu-icon"><i class="mdi mdi-plus-circle"></i></span>
                            Add bank Details
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items {{ request()->routeIs('client.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#client-menu"
                aria-expanded="{{ request()->routeIs('bank.*') ? 'true' : 'false' }}"
                aria-controls="bank-menu">
                <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                <span class="menu-title">Client Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('client.*') ? 'show' : '' }}" id="client-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('all-client') ? 'active' : '' }}">
                        {{-- <a class="nav-link" href="{{ route('client.index') }}"> --}}
                            <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                            All Client Details
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client-create') ? 'active' : '' }}">
                        {{-- <a class="nav-link" href="{{ route('client.create') }}"> --}}
                            <span class="menu-icon"><i class="mdi mdi-plus-circle"></i></span>
                            Add Client Details
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items {{ request()->routeIs('invoice.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#invoice-menu"
                aria-expanded="{{ request()->routeIs('bank.*') ? 'true' : 'false' }}"
                aria-controls="invoice-menu">
                <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                <span class="menu-title">Invoices </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('invoice.*') ? 'show' : '' }}" id="invoice-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                        {{-- <a class="nav-link" href="{{ route('invoices.index') }}"> --}}
                            <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                            Invoices
                        </a>
                    </li>
                    
                </ul>
            </div>
        </li>
    </ul>
</nav>
