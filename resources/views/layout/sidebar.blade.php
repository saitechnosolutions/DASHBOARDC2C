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

                @if (Auth::user()->role === 'ADMIN')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="shopping-cart"></i>
                            <span data-key="t-ecommerce">Website</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            {{-- <li><a href="{{ url('/banner/view') }}" key="t-products">Categories</a></li> --}}
                            <li><a href="{{ url('/category/view') }}" key="t-products">Categories</a></li>
                            <li><a href="{{ url('/subcategory/view') }}" data-key="t-product-detail">Sub Categories</a>
                            </li>
                            <li><a href="{{ url('/product/view') }}" data-key="t-orders">Products</a></li>
                            <li><a href="#" data-key="t-customers">Customers</a></li>
                            <li><a href="{{ url('/consulting/view') }}" data-key="t-customers">Color Consultation</a>
                            </li>
                            <li><a href="{{ url('/painter-booking/view') }}" data-key="t-customers">Painter Bookings</a>
                            </li>
                            <li><a href="{{ url('/colorshade/view') }}" data-key="t-customers">Color Shade</a></li>
                            <li><a href="{{ url('/painter/view') }}" data-key="t-customers">Painters</a></li>
                            <li><a href="{{ url('/painter/category/view') }}" data-key="t-customers">Painter
                                    Category</a></li>
                            <li><a href="{{ url('/contractor/view') }}" data-key="t-customers">Contractors</a></li>
                            <li><a href="{{ url('/hotdeals/view') }}" data-key="t-customers">Hot Deals</a></li>
                            <li><a href="{{ url('/order/view') }}" data-key="t-customers">Orders</a></li>

                            {{-- <li><a href="ecommerce-cart.html" data-key="t-cart">Cart</a></li>
                        <li><a href="ecommerce-checkout.html" data-key="t-checkout">Checkout</a></li>
                        <li><a href="ecommerce-shops.html" data-key="t-shops">Shops</a></li>
                        <li><a href="ecommerce-add-product.html" data-key="t-add-product">Add Product</a></li>
                        <li><a href="ecommerce-seller.html" data-key="t-seller">Seller
                                <span class="badge rounded-pill bg-danger-subtle text-danger float-end">New</span>
                            </a></li>
                        <li><a href="ecommerce-sale-details.html" data-key="t-sale-details">Sale details
                                <span class="badge rounded-pill bg-danger-subtle text-danger float-end">New</span>
                            </a></li> --}}
                        </ul>
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
                @endif

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
