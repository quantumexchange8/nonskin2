<header id="page-topbar" class="isvertical-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span class="logo-txt">@lang('translation.Nonskin')</span>
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span class="logo-txt">@lang('translation.Nonskin')</span>
                    </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- Search -->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    {{-- <input type="text" class="form-control" placeholder="Search...">
                    <span class="bx bx-search"></span> --}}
                </div>
            </form>

        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none">
                <button type="button" class="btn header-item"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-sm" data-feather="search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0" placeholder="Search...">
                                <i class="mdi mdi-magnify search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @switch(Session::get('lang'))
                        @case('ru')
                            <img src="{{ URL::asset('/assets/images/flags/russia.jpg')}}" alt="Header Language" height="16">
                        @break
                        @case('it')
                            <img src="{{ URL::asset('/assets/images/flags/italy.jpg')}}" alt="Header Language" height="16">
                        @break
                        @case('de')
                            <img src="{{ URL::asset('/assets/images/flags/germany.jpg')}}" alt="Header Language" height="16">
                        @break
                        @case('es')
                            <img src="{{ URL::asset('/assets/images/flags/spain.jpg')}}" alt="Header Language" height="16">
                        @break
                        @default
                            <img src="{{ URL::asset('/assets/images/flags/us.jpg')}}" alt="Header Language" height="16">
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item language" data-lang="eng">
                        <img src="{{ URL::asset ('/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>
                    <!-- item-->
                    <a href="{{ url('index/es') }}" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="{{ URL::asset ('/assets/images/flags/spain.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/de') }}" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="{{ URL::asset ('/assets/images/flags/germany.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/it') }}" class="dropdown-item notify-item language" data-lang="it">
                        <img src="{{ URL::asset ('/assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/ru') }}" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="{{ URL::asset ('/assets/images/flags/russia.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div> --}}


            <div class="dropdown d-inline-block">
                @unlessrole('superadmin|admin')
                <button class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-cart'></i>
                    <span class="noti-dot bg-danger rounded-pill">
                        @php
                            $cart = App\Models\Cart::where('user_id', auth()->id())->with(['product'])->first();

                            $cartItemsCount = $cart->items->count()

                        @endphp
                        {{ $cartItemsCount }}

                    </span>
                </button>
                @endunlessrole
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> Cart </h5>
                            </div>
                            {{-- <div class="col-auto">
                                <a href="#!" class="small"> Mark all as read</a>
                            </div> --}}
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
                        <h6 class="dropdown-header bg-light">Recently added products</h6>
                        <div id="ajax-data">
                        </div>
                        @hasanyrole('user')
                        @php
                            $userItem = App\Models\CartItem::where('cart_id', Auth::user()->cart->id)->get();

                        @endphp
                        @foreach($userItem as $row)
                            <div>
                                <a href="" class="text-reset notification-item">
                                    <div class="d-flex border-bottom align-items-start">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $row->product->image_1 !== null ? asset('images/products/' . $row->product->image_1) : asset('assets/images/nonskin/non-logo.jpg') }}"
                                            class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div style="display: flex;align-items: center;justify-content: space-between;">
                                                <h6 class="mb-1">{{ Str::limit($row->product->name,25,'...') }}</h6>
                                                <h6 class="mb-1">x {{$row->quantity}}</h6>
                                            </div>
                                            <div class="text-muted">
                                                <p class="mb-1 font-size-13">RM {{$row->product->price}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @endhasanyrole
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ route('member.cart') }}">
                            <i class="uil-arrow-circle-right me-1"></i> <span>@lang('translation.View_cart')</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item light-dark" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-sm layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-sm layout-mode-light"></i>
                </button>
            </div> --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '')  ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->full_name)}}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    @hasanyrole('user')
                    <a class="dropdown-item" href="{{ route('userprofile') }}"><i class='bx bx-user-circle text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.My_Account') </span></a>
                    <a class="dropdown-item" href="{{ route('changepassword') }}"><i class='bx bx-lock text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.Change Password') </span></a>
                    <a class="dropdown-item" href="{{ route('shippingaddress') }}"><i class='bx bx-map-pin text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.Shipping Address') </span></a>
                    @endhasanyrole
                    @hasanyrole('superadmin|admin')
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class='bx bx-user-circle text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.My_Account') </span></a>
                    <a class="dropdown-item" href="{{ route('admin.changePassword') }}"><i class='bx bx-lock text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.Change Password') </span></a>
                    @endhasanyrole
                    {{-- <a class="dropdown-item" href="apps-chat"><i class='bx bx-chat text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.Chat')</span></a> --}}
                    {{-- <a class="dropdown-item" href="pages-faqs"><i class='bx bx-buoy text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.Support')</span></a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item d-flex align-items-center" href="#"><i class='bx bx-cog text-muted font-size-18 align-middle me-1'></i> <span class="align-middle me-3">@lang('translation.Settings')</span><span class="badge badge-soft-success ms-auto">@lang('translation.New')</span></a> --}}
                    {{-- <a class="dropdown-item" href="auth-lock-screen"><i class='bx bx-lock text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">@lang('translation.Lock_screen') </span></a> --}}
                    <a class="dropdown-item " href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
@section('script')
    {{-- <script>
        $(document).ready(function () {
        getCartCount();

        // Function to get the cart count using AJAX
        function getCartCount() {
            $.ajax({
                url: "{{ route('cart.count') }}",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        updateCartCount(response.cartCount);
                    } else {
                        console.error("Failed to get cart count:", response.error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }

        // Function to update the cart count in the HTML
        function updateCartCount(count) {
            $("#cart-item-count").text(count);
        }
        console.log(response);

    });

    </script> --}}
@endsection

