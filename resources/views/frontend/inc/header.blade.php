<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="d-inline-flex align-items-center h-100">
          <a class="text-body mr-3" href="">Contact</a>
          <a class="text-body mr-3" href="">FAQs</a>
        </div>
      </div>
      <div class="col-lg-6 text-center text-lg-right">
        <div class="d-inline-flex align-items-center">
          <div class="btn-group">
            <button
              type="button"
              class="btn btn-sm btn-light dropdown-toggle"
              data-toggle="dropdown"
            >
              My Account
            </button>
            <div class="dropdown-menu dropdown-menu-right">
            @auth
                <a href="{{ route('adminDashboard') }}" class="dropdown-item" type="button">Go to Dashboard</a>
                <div class="dropdown-divider"></div>
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-out"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
            @guest
                <a href="{{ route('admin.login') }}" class="dropdown-item" type="button">Sign in</a>
                <a href="{{ route('register') }}" class="dropdown-item" type="button">Sign up</a>
            @endguest
            </div>
          </div>
          <div class="btn-group">
            <a href="{{ route('admin.login') }}" type="button" class="btn btn-sm btn-light">
              Want to Sell?
            </a>
          </div>

          <div class="btn-group">
            <button
              type="button"
              class="btn btn-sm btn-light dropdown-toggle"
              data-toggle="dropdown"
            >
              {{ strtoupper(app()->getLocale()) }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                  @foreach ($languages as $language)
                      <form action="{{ route('changeLocale') }}" method="post">
                          @csrf
                          <input type="hidden" name="lang" value="{{ $language->slug }}">
                          <button class="dropdown-item">{{ strtoupper($language->name) }}</button>
                      </form>
                  @endforeach
              {{-- <button class="dropdown-item" type="button">FR</button>
              <button class="dropdown-item" type="button">AR</button>
              <button class="dropdown-item" type="button">RU</button> --}}
            </div>
          </div>
        </div>
        <div class="d-inline-flex align-items-center d-block d-lg-none">
          <a href="" class="btn px-0 ml-2">
            <i class="fas fa-heart text-dark"></i>
            <span
              class="badge text-dark border border-dark rounded-circle"
              style="padding-bottom: 2px"
              >0</span
>
          </a>
          <a href="" class="btn px-0 ml-2">
            <i class="fas fa-shopping-cart text-dark"></i>
            <span
              class="badge text-dark border border-dark rounded-circle"
              style="padding-bottom: 2px"
              >0</span
            >
          </a>
        </div>
      </div>
    </div>
    <div
      class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex"
    >
      <div class="col-lg-4">
        <a href="" class="text-decoration-none logo">
          <span class="h1 text-uppercase text-primary bg-dark px-2"
            >How to</span
          >
          <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1"
            >Sell?</span
          >
        </a>
      </div>
      <div class="col-lg-4 col-6 text-left">
      <form action="{{ route('products') }}" method="GET">
        <div class="input-group">
            <input
                type="text"
                class="form-control"
                name="q"
                placeholder="Search for products"
                value="{{ $query }}"
            />
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
      </div>
      <div class="col-lg-4 col-6 text-right">
        <p class="m-0">{{ webTranslation('customerservice') }}</p>
        <h5 class="m-0">+012 345 6789</h5>
      </div>
    </div>
  </div>
  <!-- Topbar End -->

  <!-- Navbar Start -->
  <div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
      <div class="col-lg-3 d-none d-lg-block">
        <a
          class="btn d-flex align-items-center justify-content-between bg-primary w-100"
          data-toggle="collapse"
          href="#navbar-vertical"
          style="height: 65px; padding: 0 30px"
        >
          <h6 class="text-dark m-0">
            <i class="fa fa-bars mr-2"></i>{{ webTranslation('categories') }}
          </h6>
          <i class="fa fa-angle-down text-dark"></i>
        </a>
        <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
          id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999">
          <div class="navbar-nav w-100">
{{--            <div class="nav-item dropdown dropright">--}}
{{--              <a--}}
{{--                href="#"--}}
{{--                class="nav-link dropdown-toggle"--}}
{{--                data-toggle="dropdown"--}}
{{--                >Dresses <i class="fa fa-angle-right float-right mt-1"></i--}}
{{--              ></a>--}}
{{--              <div--}}
{{--                class="dropdown-menu position-absolute rounded-0 border-0 m-0"--}}
{{--              >--}}
{{--                <a href="" class="dropdown-item">Men's Dresses</a>--}}
{{--                <a href="" class="dropdown-item">Women's Dresses</a>--}}
{{--                <a href="" class="dropdown-item">Baby's Dresses</a>--}}
{{--              </div>--}}
{{--            </div>--}}
            @foreach($all_categories as $category)
                <a href="{{url('products')}}?category={{$category->slug}}" class="nav-item nav-link">{{$category->name}}</a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="col-lg-9">
        <nav
          class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0"
        >
          <a href="" class="text-decoration-none d-block d-lg-none">
            <span class="h1 text-uppercase text-dark bg-light px-2"
              >How to</span
            >
            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1"
              >Sell?</span
            >
          </a>
          <button
            type="button"
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="collapse navbar-collapse justify-content-between"
            id="navbarCollapse"
          >
            <div class="navbar-nav mr-auto py-0">
              <a href="{{url('/')}}" class="nav-item nav-link active">{{ webTranslation('home') }}</a>
              <a href="{{url('/products')}}" class="nav-item nav-link">{{ webTranslation('shop') }}</a>
{{--              <div class="nav-item dropdown">--}}
{{--                <a--}}
{{--                  href="#"--}}
{{--                  class="nav-link dropdown-toggle"--}}
{{--                  data-toggle="dropdown"--}}
{{--                  >Pages <i class="fa fa-angle-down mt-1"></i--}}
{{--                ></a>--}}
{{--                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">--}}
{{--                  <a href="cart.html" class="dropdown-item">Shopping Cart</a>--}}
{{--                  <a href="checkout.html" class="dropdown-item">Checkout</a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <a href="contact.html" class="nav-item nav-link">Contact</a>--}}
            </div>
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
              <a href="" class="btn px-0">
                <i class="fas fa-heart text-primary"></i>
                <span
                  class="badge text-secondary border border-secondary rounded-circle"
                  style="padding-bottom: 2px"
                  >0</span
                >
              </a>
              <a href="{{url('cart')}}" class="btn px-0 ml-3">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span
                  class="badge text-secondary border border-secondary rounded-circle"
                  style="padding-bottom: 2px"
                  >{{CountCart()}}</span
                >
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar End -->

