<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

        <li class="nav-item {{ Route::is('adminpanel/dashboard') ? 'menu-open' : '' }}">
            <a href="{{route('adminpanel/dashboard')}}" class="nav-link {{ Route::is('adminpanel/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item {{ Route::is('adminpanel/panel', 'adminpanel/server-information') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/panel', 'adminpanel/server-information') ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Server management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/panel')}}" class="nav-link {{ Route::is('adminpanel/panel') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin Panel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/server-information')}}" class="nav-link {{ Route::is('adminpanel/server-information') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Server Information</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ Route::is('adminpanel/announce', 'adminpanel/download', 'adminpanel/event', 'adminpanel/boss', 'adminpanel/slider') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/announce', 'adminpanel/download', 'adminpanel/event', 'adminpanel/boss', 'adminpanel/slider') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Website management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/announce')}}" class="nav-link {{ Route::is('adminpanel/announce') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Announce Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/download')}}" class="nav-link {{ Route::is('adminpanel/download') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Download Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/event')}}" class="nav-link {{ Route::is('adminpanel/event') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Event Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/boss')}}" class="nav-link {{ Route::is('adminpanel/boss') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Boss Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/slider')}}" class="nav-link {{ Route::is('adminpanel/slider') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Slider Settings</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ Route::is('adminpanel/character', 'adminpanel/reset', 'adminpanel/grand-reset', 'adminpanel/add-stats', 'adminpanel/pk-clear', 'adminpanel/rename', 'adminpanel/reset-stats', 'adminpanel/vip-pack') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/character', 'adminpanel/reset', 'adminpanel/grand-reset', 'adminpanel/add-stats', 'adminpanel/pk-clear', 'adminpanel/rename', 'adminpanel/reset-stats', 'adminpanel/vip-pack') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    User management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/character')}}" class="nav-link {{ Route::is('adminpanel/character') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Character Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/reset')}}" class="nav-link {{ Route::is('adminpanel/reset') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reset Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/grand-reset')}}" class="nav-link {{ Route::is('adminpanel/grand-reset') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grand Reset Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/add-stats')}}" class="nav-link {{ Route::is('adminpanel/add-stats') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Stats Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/pk-clear')}}" class="nav-link {{ Route::is('adminpanel/pk-clear') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PK Clear Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/rename')}}" class="nav-link {{ Route::is('adminpanel/rename') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rename Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/reset-stats')}}" class="nav-link {{ Route::is('adminpanel/reset-stats') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>ResetStats Settings</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/vip-pack')}}" class="nav-link {{ Route::is('adminpanel/vip-pack') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>VIP Settings</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-header">Add Systems</li>

        <li class="nav-item {{ Route::is('adminpanel/add-news', 'adminpanel/hall-of-fame', 'adminpanel/add-information', 'adminpanel/add-vote-reward') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/add-news', 'adminpanel/hall-of-fame', 'adminpanel/add-information', 'adminpanel/add-vote-reward') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Add News
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/news')}}" class="nav-link {{ Route::is('adminpanel/news') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add News</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/events')}}" class="nav-link {{ Route::is('adminpanel/events') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Event News</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/updates')}}" class="nav-link {{ Route::is('adminpanel/updates') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Update News</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ Route::is('adminpanel/hof') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/hof') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Hall Of Fame
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/hof')}}" class="nav-link {{ Route::is('adminpanel/hof') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hall of Fame</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ Route::is('adminpanel/information', 'adminpanel/add-information') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/information', 'adminpanel/add-information') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Add Information
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/information')}}" class="nav-link {{ Route::is('adminpanel/information') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Information Manage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/add-information')}}" class="nav-link {{ Route::is('adminpanel/add-information') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Information</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ Route::is('adminpanel/vote-reward') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/vote-reward') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Add Vote Reward
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/vote-reward')}}" class="nav-link {{ Route::is('adminpanel/vote-reward') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Vote Package</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-header">Payment System</li>
        <li class="nav-item {{ Route::is('adminpanel/paypal', 'adminpanel/paypal-pack') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Route::is('adminpanel/paypal', 'adminpanel/paypal-pack') ? 'active' : '' }}">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Paypal Manage
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('adminpanel/paypal')}}" class="nav-link {{ Route::is('adminpanel/paypal') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Paypal Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminpanel/paypal-pack')}}" class="nav-link {{ Route::is('adminpanel/paypal-pack') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Paypal Package</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
