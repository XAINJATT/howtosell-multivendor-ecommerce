<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img src="{{ asset('public/storage/logo/logo.png')}}" alt="logo-small" style="width: 80px; height: 65px;">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item <?php if ($page == "dashboard") {
                echo "active";
            } ?>">
                <a href="{{url('dashboard')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Manage</li>
            @if($page == "category")
                <li class="nav-item active">
                    <a href="{{url('admin/category')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Category</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('admin/category')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Category</span>
                    </a>
                </li>
            @endif
            @if($page == "product")
                <li class="nav-item active">
                    <a href="{{url('admin/product')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Products</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('admin/product')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Product</span>
                    </a>
                </li>
            @endif
            @if($page == "color")
                <li class="nav-item active">
                    <a href="{{url('admin/color')}}" class="nav-link">
                        <i class="link-icon" data-feather="droplet"></i>
                        <span class="link-title">Colors</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('admin/color')}}" class="nav-link">
                        <i class="link-icon" data-feather="droplet"></i>
                        <span class="link-title">Color</span>
                    </a>
                </li>
            @endif

            @if($page == "size")
                <li class="nav-item active">
                    <a href="{{url('admin/size')}}" class="nav-link">
                        <i class="link-icon" data-feather="aperture"></i>
                        <span class="link-title">Sizes</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('admin/size')}}" class="nav-link">
                        <i class="link-icon" data-feather="aperture"></i>
                        <span class="link-title">Size</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>
