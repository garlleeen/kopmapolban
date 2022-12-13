<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Master Data</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="{{ asset('images/logo.png') }}" alt="">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

            @hasrole('Administrator')
                <li class="menu-header">Management Data</li>
                <li class=""><a class="nav-link" href=""><i class="fas fa-users"></i><span>Management User</span></a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i><span>Management Product</span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="nav-link" href="">Product Category</a></li>
                        <li class=""><a class="nav-link" href="">Product</a></li>
                    </ul>
                </li>
            @else
                I am not a writer...
            @endhasrole
        </ul>
    </aside>
</div>
