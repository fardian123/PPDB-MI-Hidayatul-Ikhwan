<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>

            <div class="position-relative search-bar d-lg-none d-none" data-bs-toggle="modal"
                data-bs-target="#SearchModal">
                <input class="form-control px-5" disabled type="search" placeholder="Search">
                <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i
                        class='bx bx-search'></i></span>
            </div>


            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">

                    



                    <li class="nav-item dropdown dropdown-large d-none">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            data-bs-toggle="dropdown"><span class="alert-count">7</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">

                            <div class="header-notifications-list">
                            </div>

                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large d-none">
                        <div class="dropdown-menu dropdown-menu-end d-none">
                            <a href="javascript:;">

                            </a>
                            <div class="header-message-list"></div>

                        </div>
                    </li>
                </ul>
            </div>

            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp

            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{$profileData->sex == "wanita" ? asset('backend/assets/images/avatars/noavatar64f.png') : asset('backend/assets/images/avatars/noavatar64.png') }}  "
                        class="user-img" alt="user avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">{{$profileData->name}}</p>
                        <p class="designattion mb-0">{{$profileData->email}}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center" href="{{route('user.profile')}}"><i
                                class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{route('user.change.password')}}"><i
                                class="bx bx-cog fs-5"></i><span>Change Password</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{route('user.dashboard')}}"><i
                                class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                    </li>
                   
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a class="dropdown-item d-flex align-items-center" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>