<style>
    .os-scrollbar-horizontal {
        display: none
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <a href="{{ url('/dashboard') }}" class="brand-link">
            <img src="https://imgs.search.brave.com/jjizMxNTRgX8Jd1PNu7XXsh0-_jVVpSJF-bVeHWJZ_c/rs:fit:860:900:1/g:ce/aHR0cHM6Ly93d3cu/a2luZHBuZy5jb20v/cGljYy9tLzc4LTc4/NjIwN191c2VyLWF2/YXRhci1wbmctdXNl/ci1hdmF0YXItaWNv/bi1wbmctdHJhbnNw/YXJlbnQucG5n"
                alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">CA Super Manager</span>
        </a>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  ">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- users --}}
                <li
                    class="nav-item {{ Request::is('users') || Request::is('users/edit') || Request::is('users/add') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{ url('users') }}"
                        class="nav-link {{ Request::is('leads/demoid') || Request::is('leads/callback') || Request::is('leads/idcreated') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                {{-- projects --}}
                <li class="nav-item">
                    <a target="_blank" href="{{ env('PROJECT_LEADS') }}"
                        class="nav-link {{ Request::is('leads/demoid') || Request::is('leads/callback') || Request::is('leads/idcreated') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-arrow-left"></i>
                        <p>
                            Goto Leads Project
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a target="_blank" href="{{ env('PROJECT_CUSTOMER') }}"
                        class="nav-link {{ Request::is('leads/demoid') || Request::is('leads/callback') || Request::is('leads/idcreated') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-arrow-left"></i>
                        <p>
                            Goto Customer Project
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a target="_blank" href="{{ env('PROJECT_EXPENSE') }}"
                        class="nav-link {{ Request::is('leads/demoid') || Request::is('leads/callback') || Request::is('leads/idcreated') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-arrow-left"></i>
                        <p>
                            Goto Expense Project
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
