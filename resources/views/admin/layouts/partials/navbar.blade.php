<style media="screen">
    .navbar .navbar-content .navbar-nav .nav-item .nav-link .indicator {
        position: absolute;
        top: -7px;
        right: 0;
        background-color: red;
        border-radius: 4em;
        padding: 0 4px 0;
        color: white;
        font-size: 10px;
    }
</style>
<nav class="navbar">
    <a href="#" class="sidebar-toggler" id="toggleSidebar" style="visibility: hidden;">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                My Balance
                <a href="#" data-toggle="modal" data-target="#staticBackdrop" style="padding: 2px 10px" >
                    <span class="pl-3 pr-3">{{ $balance }}</span>
                </a>
            </li>
            @php
                $Profile = \Illuminate\Support\Facades\DB::table('users')->where('id', '=', \Illuminate\Support\Facades\Auth::id())->get();
                $ProfilePic = asset('public/storage/logo/logo.jpg');
                $Name = $Profile[0]->name;
            @endphp
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{$ProfilePic}}" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                            <p class="email text-muted mb-3">{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <!-- <li class="nav-item">
                                <a href="{{url('edit-profile')}}" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('changePassword') }}">
                                    <i data-feather="lock"></i>
                                    {{ __('Change Password') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.WithdrawalFunds') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Withdraw Payment</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="destination" class="form-label">Destination Account</label>
                                <input type="text" class="form-control" name="destination">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="amount" class="form-label">Withdrawal Amount</label>
                                <input type="number" class="form-control" name="amount" max="{{ $balance }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
