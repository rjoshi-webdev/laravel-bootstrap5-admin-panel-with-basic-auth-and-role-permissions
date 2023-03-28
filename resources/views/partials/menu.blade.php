
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/favicon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Imenso</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route("admin.home") }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">{{ trans('global.dashboard') }}</div>
            </a>
        </li>
        @can('user_management_access')
        <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
           
            <ul>
                @can('permission_access')
                <li> <a href="{{ route("admin.permissions.index") }}"><i class="bx bx-right-arrow-alt"></i>{{ trans('cruds.permission.title') }}</a>
                </li>      
                @endcan
                
                @can('role_access')
                <li > <a href="{{ route("admin.roles.index") }}" class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"><i class="bx bx-right-arrow-alt "></i>{{ trans('cruds.role.title') }}</a>
                </li>
                @endcan
                @can('user_access')
                <li> <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"><i class="bx bx-right-arrow-alt"></i>{{ trans('cruds.user.title') }}</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan 

        <li>
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <div class="parent-icon"><i class='bx bx-log-out-circle'></i>
                </div>
                <div class="menu-title">{{ trans('global.logout') }}</div>
            </a>
        </li>
       
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->