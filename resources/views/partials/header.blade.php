<!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <a class="nav-link" href="#">   <i class='bx bx-search'></i>
                                </a>
                            </li>
                            
                            <li class="nav-item dropdown dropdown-large">
                               
                                <div class="dropdown-menu dropdown-menu-end">
                                    
                                    <div class="header-notifications-list">
                                    
                                    </div>
                                    
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                               
                                <div class="dropdown-menu dropdown-menu-end">
                                    
                                    <div class="header-message-list">
                                     
                                    </div>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <?php 
                        $user = Auth::user();
                        $user_role = '';
                        $role = $user->roles->pluck('title','id')->toArray();
                        
                        if(in_array('Admin',$role)){ $user_role = 'Admin'; }
                        if(in_array('User',$role)){ $user_role = 'User'; }
                    ?>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/profile.png') }}" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                                <p class="designattion mb-0">{{$user_role}}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                            </li>
                           
                            <li><a class="dropdown-item" href="{{ route("admin.home") }}"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" href="javascript:;"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->