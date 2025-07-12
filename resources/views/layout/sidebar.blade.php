<style>
    .metismenu {
        background: #08137a !important;
        color: #fff !important;
    }

    .simplebar-content-wrapper {
        background: #08137a !important;
        color: #fff !important;
    }

    .navbar-brand-box {
        background: #08137a !important;
    }

    .metismenu li a {
        color: white !important;
    }

    .mm-active {
        background: #fff !important;
        color: #08137a !important;
    }

    .mm-active .active {
        background: #fff !important;
        color: #08137a !important;
    }

    #side-menu .has-arrow[aria-expanded="true"] {
        background: #fff !important;
        color: #08137a !important;
    }

    ul.sub-menu.mm-collapse.mm-show li a {
        background: #fff !important;
        color: #08137a !important;
    }

    #sidebar-menu {
        padding: 10px 0 0 0;
    }
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ url('/') }}">
                        <i data-feather="home"></i>
                        <span class="badge rounded-pill bg-success-subtle text-success float-end">9+</span>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/sale/index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-badge-dollar-sign-icon lucide-badge-dollar-sign">
                            <path
                                d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                            <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                            <path d="M12 18V6" />
                        </svg>
                        <span data-key="t-dashboard">Sales</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/order/view') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag">
                            <path d="M16 10a4 4 0 0 1-8 0" />
                            <path d="M3.103 6.034h17.794" />
                            <path
                                d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z" />
                        </svg>
                        <span data-key="t-dashboard">Orders</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-bookmark-check-icon lucide-bookmark-check">
                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2Z" />
                            <path d="m9 10 2 2 4-4" />
                        </svg>
                        <span data-key="t-email">Bookings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/painter-booking/view') }}" data-key="t-inbox">Painter Booking</a></li>
                        <li><a href="{{ url('/consulting/view') }}" data-key="t-inbox">Color Consultation Booking</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-package-search-icon lucide-package-search">
                            <path
                                d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                            <path d="m7.5 4.27 9 5.15" />
                            <polyline points="3.29 7 12 12 20.71 7" />
                            <line x1="12" x2="12" y1="22" y2="12" />
                            <circle cx="18.5" cy="15.5" r="2.5" />
                            <path d="M20.27 17.27 22 19" />
                        </svg>
                        <span data-key="t-email">Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/product/view') }}" data-key="t-inbox">All Products</a></li>
                        <li><a href="{{ url('/category/view') }}" data-key="t-inbox">Categories</a></li>
                        <li><a href="{{ url('/subcategory/view') }}" data-key="t-inbox">Sub-Categories</a></li>
                        <li><a href="{{ url('/colorshade/view') }}" data-key="t-inbox">Color Shades</a></li>
                        <li><a href="{{ url('/hotdeals/view') }}" data-key="t-inbox">Offers/Hot Deals</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-server-icon lucide-server">
                            <rect width="20" height="8" x="2" y="2" rx="2" ry="2" />
                            <rect width="20" height="8" x="2" y="14" rx="2" ry="2" />
                            <line x1="6" x2="6.01" y1="6" y2="6" />
                            <line x1="6" x2="6.01" y1="18" y2="18" />
                        </svg>
                        <span data-key="t-email">Services</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/painter/view') }}" data-key="t-inbox">Painters</a></li>
                        <li><a href="{{ url('/contractor/view') }}" data-key="t-inbox">Contractors</a></li>
                        <li><a href="{{ url('/painter/category/view') }}" data-key="t-inbox">Painter Category</a>
                        </li>
                        <li><a href="{{ url('/vendor/view') }}" data-key="t-inbox">Painter Offer</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/blog/view') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-blocks-icon lucide-blocks">
                            <path
                                d="M10 22V7a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5a1 1 0 0 0-1-1H2" />
                            <rect x="14" y="2" width="8" height="8" rx="1" />
                        </svg>
                        <span data-key="t-dashboard">Blogs</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="user"></i>
                        <span data-key="t-email">Vendors</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/vendor/view') }}" data-key="t-inbox">Vendor details</a></li>
                        {{-- <li><a href="apps-email-read.html" data-key="t-read-email">Read Email</a></li> --}}
                    </ul>
                </li>
                @if (Auth::user()->role === 'VENDOR')
                    <li>
                        <a href="{{ url('/vendor/productstock') }}">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span data-key="t-dashboard">Product Stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/vendor/orders') }}">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            <span data-key="t-dashboard">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/vendor/offers') }}">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                            <span data-key="t-dashboard">Offers</span>
                        </a>
                    </li>
                @endif


                <li class="menu-title" data-key="t-apps"></li>

                {{-- @if (Auth::user()->role === 'ADMIN')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="shopping-cart"></i>
                            <span data-key="t-ecommerce">Website</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/category/view') }}" key="t-products">Categories</a></li>
                            <li><a href="{{ url('/subcategory/view') }}" data-key="t-product-detail">Sub
                                    Categories</a>
                            </li>
                            <li><a href="{{ url('/product/view') }}" data-key="t-orders">Products</a></li>
                            <li><a href="#" data-key="t-customers">Customers</a></li>
                            <li><a href="{{ url('/consulting/view') }}" data-key="t-customers">Color Consultation</a>
                            </li>
                            <li><a href="{{ url('/painter-booking/view') }}" data-key="t-customers">Painter
                                    Bookings</a>
                            </li>
                            <li><a href="{{ url('/colorshade/view') }}" data-key="t-customers">Color Shade</a></li>
                            <li><a href="{{ url('/painter/view') }}" data-key="t-customers">Painters</a></li>
                            <li><a href="{{ url('/painter/category/view') }}" data-key="t-customers">Painter
                                    Category</a></li>
                            <li><a href="{{ url('/contractor/view') }}" data-key="t-customers">Contractors</a></li>
                            <li><a href="{{ url('/hotdeals/view') }}" data-key="t-customers">Hot Deals</a></li>
                            <li><a href="{{ url('/projects/view') }}" data-key="t-customers">Projects</a></li>
                            <li><a href="{{ url('/order/view') }}" data-key="t-customers">Orders</a></li>
                            <li><a href="{{ url('/blog/view') }}" data-key="t-customers">Blog</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="user"></i>
                            <span data-key="t-email">Vendors</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/vendor/view') }}" data-key="t-inbox">Vendor details</a></li>
                        </ul>
                    </li>
                @endif --}}

                @if (Auth::user()->role === 'PAINTER')
                    <li>
                        <a href="{{ url('/painter/projectview') }}">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span data-key="t-dashboard">Project Images</span>
                        </a>
                    </li>
                @endif

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
