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
            @if($page == "city")
                <li class="nav-item active">
                    <a href="{{url('city')}}" class="nav-link">
                        <i class="link-icon" data-feather="map-pin"></i>
                        <span class="link-title">Cities</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{url('city')}}" class="nav-link">
                        <i class="link-icon" data-feather="map-pin"></i>
                        <span class="link-title">City</span>
                    </a>
                </li>
            @endif

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
        </ul>
    </div>
</nav>
