<nav class="sidebar">
    <div class="sidebar-header">
        <a href="" class="text-decoration-none logo">
            <span class="h4 text-uppercase text-primary bg-dark px-2" style="background-color: #3D464D !important">How to</span>
            <span class="h4 text-uppercase text-dark bg-primary px-2 ml-n1" style="background-color: #FFD333 !important">Sell?</span>
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
            @can('dashboard')
                <li class="nav-item <?php if ($page == "dashboard") {
                                        echo "active";
                                    } ?>">
                    <a href="{{url('admin/dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item nav-category">Manage</li>
            @can('product')
                @if($page == "product")
                <li class="nav-item active">
                    <a href="{{url('admin/product')}}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Products</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/product')}}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Product</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('category')
                @if($page == "category")
                <li class="nav-item active">
                    <a href="{{url('admin/category')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Categories</span>
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
            @endcan
            @can('company')
                @if($page == "company")
                <li class="nav-item active">
                    <a href="{{url('admin/company')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-bag"></i>
                        <span class="link-title">Companies</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/company')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-bag"></i>
                        <span class="link-title">Company</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('coupon')
                @if($page == "coupon")
                <li class="nav-item active">
                    <a href="{{url('admin/coupon')}}" class="nav-link">
                        <i class="link-icon" data-feather="percent"></i>
                        <span class="link-title">Coupon</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/coupon')}}" class="nav-link">
                        <i class="link-icon" data-feather="percent"></i>
                        <span class="link-title">Coupons</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('role')
                @if($page == "role")
                <li class="nav-item active">
                    <a href="{{url('admin/role')}}" class="nav-link">
                        <i class="link-icon" data-feather="key"></i>
                        <span class="link-title">Roles</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/role')}}" class="nav-link">
                        <i class="link-icon" data-feather="key"></i>
                        <span class="link-title">Role</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('order')
                @if($page == "order")
                <li class="nav-item active">
                    <a href="{{url('admin/order')}}" class="nav-link">
                        <i class="link-icon" data-feather="briefcase"></i>
                        <span class="link-title">Orders</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/order')}}" class="nav-link">
                        <i class="link-icon" data-feather="briefcase"></i>
                        <span class="link-title">Order</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('permission')
                @if($page == "permission")
                <li class="nav-item active">
                    <a href="{{url('admin/permission')}}" class="nav-link">
                        <i class="link-icon" data-feather="lock"></i>
                        <span class="link-title">Permissions</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/permission')}}" class="nav-link">
                        <i class="link-icon" data-feather="lock"></i>
                        <span class="link-title">Permission</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('stock')
                @if($page == "stock")
                <li class="nav-item active">
                    <a href="{{url('admin/stock')}}" class="nav-link">
                        <i class="link-icon" data-feather="database"></i>
                        <span class="link-title">Stocks</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/stock')}}" class="nav-link">
                        <i class="link-icon" data-feather="database"></i>
                        <span class="link-title">Stock</span>
                    </a>
                </li>
                @endif
            @endcan
            @can('color')
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
            @endcan
            @can('size')
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
            @endcan
            @can('setting')
                @if($page == "setting")
                <li class="nav-item active">
                    <a href="{{url('admin/setting')}}" class="nav-link">
                        <i class="link-icon" data-feather="tool"></i>
                        <span class="link-title">Settings</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{url('admin/setting')}}" class="nav-link">
                        <i class="link-icon" data-feather="tool"></i>
                        <span class="link-title">Setting</span>
                    </a>
                </li>
                @endif
            @endcan
        </ul>
    </div>
</nav>