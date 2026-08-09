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
                        <img class="img-xs rounded-circle" src="{{ asset('admin-end/assets/images/faces/face15.jpg') }}" alt="">
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

        <!-- Dashboard -->
        <li class="nav-item menu-items {{ request()->routeIs('dashboard', 'admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-icon"><i class="mdi mdi-home"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Our Slider -->
        <li class="nav-item menu-items {{ request()->routeIs('all-slider', 'service-create') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#slider-menu"
                aria-expanded="{{ request()->routeIs('all-slider', 'service-create') ? 'true' : 'false' }}"
                aria-controls="slider-menu">
                <span class="menu-icon"><i class="mdi mdi-image"></i></span>
                <span class="menu-title">Our Slider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('all-slider', 'service-create') ? 'show' : '' }}" id="slider-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('all-slider') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('all-slider') }}">
                            <span class="menu-icon"><i class="mdi mdi-image-multiple"></i></span>
                            All Sliders
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('service-create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('service-create') }}">
                            <span class="menu-icon"><i class="mdi mdi-library-plus"></i></span>
                            Add Slider
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Clients -->
        <li class="nav-item menu-items {{ request()->routeIs('clients.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#client-menu"
                aria-expanded="{{ request()->routeIs('clients.*') ? 'true' : 'false' }}"
                aria-controls="client-menu">
                <span class="menu-icon"><i class="mdi mdi-account-multiple"></i></span>
                <span class="menu-title">Clients</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('clients.*') ? 'show' : '' }}" id="client-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('clients.index') }}">
                            <span class="menu-icon"><i class="mdi mdi-account-multiple"></i></span>
                            All Clients
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('clients.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('clients.create') }}">
                            <span class="menu-icon"><i class="mdi mdi-account-multiple-plus"></i></span>
                            Add client
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Airlines List -->
        <li class="nav-item menu-items {{ request()->routeIs('showAirlines', 'create-airline') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#airlines-menu"
                aria-expanded="{{ request()->routeIs('showAirlines', 'create-airline') ? 'true' : 'false' }}"
                aria-controls="airlines-menu">
                <span class="menu-icon"><i class="mdi mdi-airplane"></i></span>
                <span class="menu-title">Airlines List</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('showAirlines', 'create-airline') ? 'show' : '' }}" id="airlines-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('showAirlines') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('showAirlines') }}">
                            <span class="menu-icon"><i class="mdi mdi-airplane"></i></span>
                            All Airlines
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('create-airline') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('create-airline') }}">
                            <span class="menu-icon"><i class="mdi mdi-plus-circle"></i></span>
                            Add Airline
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Feedback -->
        <li class="nav-item menu-items {{ request()->routeIs('all-testi', 'create-testi') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#feedback-menu"
                aria-expanded="{{ request()->routeIs('all-testi', 'create-testi') ? 'true' : 'false' }}"
                aria-controls="feedback-menu">
                <span class="menu-icon"><i class="mdi mdi-message"></i></span>
                <span class="menu-title">Feedback</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('all-testi', 'create-testi') ? 'show' : '' }}" id="feedback-menu">
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
                            Add Feedback
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Site Settings -->
        <li class="nav-item menu-items {{ request()->routeIs('settings-edit') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#siteinfo-menu"
                aria-expanded="{{ request()->routeIs('settings-edit') ? 'true' : 'false' }}"
                aria-controls="siteinfo-menu">
                <span class="menu-icon"><i class="mdi mdi-information"></i></span>
                <span class="menu-title">Site Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('settings-edit') ? 'show' : '' }}" id="siteinfo-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('settings-edit') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('settings-edit') }}">
                            <span class="menu-icon"><i class="mdi mdi-settings"></i></span>
                            Settings 
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Bank Details -->
        <li class="nav-item menu-items {{ request()->routeIs('all-bank', 'bank-create') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#bank-menu"
                aria-expanded="{{ request()->routeIs('all-bank', 'bank-create') ? 'true' : 'false' }}"
                aria-controls="bank-menu">
                <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                <span class="menu-title">Bank Details</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('all-bank', 'bank-create') ? 'show' : '' }}" id="bank-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('all-bank') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <span class="menu-icon"><i class="mdi mdi-bank"></i></span>
                            All Bank Details
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('bank-create') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <span class="menu-icon"><i class="mdi mdi-plus-circle"></i></span>
                            Add bank Details
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        
        <!-- Invoices -->
        <li class="nav-item menu-items {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#invoice-menu"
                aria-expanded="{{ request()->routeIs('invoices.*') ? 'true' : 'false' }}"
                aria-controls="invoice-menu">
                <span class="menu-icon"><i class="mdi mdi-file-document"></i></span>
                <span class="menu-title">Invoices</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('invoices.*') ? 'show' : '' }}" id="invoice-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <span class="menu-icon"><i class="mdi mdi-file-document-box"></i></span>
                            Invoices
                        </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</nav>