<style>
   .vertical-nav-menu a{
    text-decoration: none;
   }
    </style>

<div class="app-main">
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Dashboard</li>
                    <li class="{{ request()->is('admin') ? 'mm-active' : '' }}">
                        <a href="{{url('admin')}}">
                            <i class="metismenu-icon fa fa-book"></i>Dashboard
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Menu</li>

                    <li>
                        <a>
                            <i class="metismenu-icon fa fa-book"></i>Danh mục sản phẩm
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li class="{{ request()->is('admin/category/*') ? 'mm-active' : '' }}">
                                <a href="{{route('category.create')}}">
                                    <i class="metismenu-icon"></i>Thêm danh mục
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/category') ? 'mm-active' : '' }}">
                                <a href="{{route('category.index')}}">
                                    <i class="metismenu-icon"></i>Liệt kê danh mục
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-flag"></i>Thương hiệu
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li class="{{ request()->is('admin/brand/*') ? 'mm-active' : '' }}">
                                <a href="{{route('brand.create')}}">
                                    <i class="metismenu-icon"></i>Thêm thương hiệu
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/brand') ? 'mm-active' : '' }}">
                                <a href="{{route('brand.index')}}">
                                    <i class="metismenu-icon"></i>Liệt kê thương hiệu
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('admin/size') ? 'mm-active' : '' }}">
                        <a href="{{route('size.index')}}">
                            <i class="metismenu-icon fa fa-i-cursor"></i>Size
                        </a>
                    </li>

                    <li class="{{ request()->is('admin/size') ? 'mm-active' : '' }}">
                        <a href="{{route('color.index')}}">
                            <i class="metismenu-icon fa fa-i-cursor"></i>Color
                        </a>
                    </li>

                    <li class="{{ request()->is('admin/slider') ? 'mm-active' : '' }}">
                        <a href="">
                            <i class="metismenu-icon fa fa-i-cursor"></i>Slider
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-universal-access"></i>Sản phẩm
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li class="{{ request()->is('admin/product/*') ? 'mm-active' : '' }}">
                                <a href="{{route('product.create')}}">
                                    <i class="metismenu-icon"></i>Thêm sản phẩm
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/product') ? 'mm-active' : '' }}">
                                <a href="{{route('product.index')}}">
                                    <i class="metismenu-icon"></i>Liệt kê sản phẩm
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('admin/order') ? 'mm-active' : '' }}">
                        <a href="">
                            <i class="metismenu-icon fa fa-shopping-cart"></i>Đơn hàng <span class="badge badge-danger">12 <sup>new</sup></span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="metismenu-icon fa fa-list-alt"></i>Blog
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li class="{{ request()->is('admin/blog/*') ? 'mm-active' : '' }}">
                                <a href="">
                                    <i class="metismenu-icon"></i>Thêm blog
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/blog') ? 'mm-active' : '' }}">
                                <a href="">
                                    <i class="metismenu-icon"></i>Liệt kê blog
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="app-sidebar__heading">Quản lý cửa hàng</li>
                    <li class="{{ request()->is('admin/store') ? 'mm-active' : '' }}">
                        <a href="">
                            <i class="metismenu-icon fa fa-info"></i>Thông tin cửa hàng
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/user') ? 'mm-active' : '' }}">
                        <a href="">
                            <i class="metismenu-icon fa fa-user-circle"></i>Admin, User
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="app-main__outer">

        @yield('main')

        <div class="app-wrapper-footer">
            <div class="app-footer">
                <div class="app-footer__inner">

                    <div class="app-footer-right">
                        <ul class="header-megamenu nav">
                            <li class="nav-item">
                                <a data-placement="top" rel="popover-focus" data-offset="300"
                                    data-toggle="popover-custom" class="nav-link">
                                    Footer Menu
                                    <i class="fa fa-angle-up ml-2 opacity-8"></i>
                                </a>
                                <div class="rm-max-width rm-pointers">
                                    <div class="d-none popover-custom-content">
                                        <div class="dropdown-mega-menu dropdown-mega-menu-sm">
                                            <div class="grid-menu grid-menu-2col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6 col-xl-6">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item">Overview</li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <i class="nav-link-icon lnr-inbox"></i>
                                                                    <span>Contacts</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <i class="nav-link-icon lnr-book"></i>
                                                                    <span>Incidents</span>
                                                                    <div
                                                                        class="ml-auto badge badge-pill badge-danger">
                                                                        5</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">
                                                                    <i class="nav-link-icon lnr-picture"></i>
                                                                    <span>Companies</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a disabled="" class="nav-link disabled">
                                                                    <i class="nav-link-icon lnr-file-empty"></i>
                                                                    <span>Dashboards</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-6">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item-header nav-item">Sales &amp;
                                                                Marketing</li>
                                                            <li class="nav-item"><a class="nav-link">Queues</a>
                                                            </li>
                                                            <li class="nav-item"><a class="nav-link">Resource
                                                                    Groups</a></li>
                                                            <li class="nav-item">
                                                                <a class="nav-link">Goal Metrics
                                                                    <div class="ml-auto badge badge-warning">3
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item"><a
                                                                    class="nav-link">Campaigns</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-placement="top" rel="popover-focus" data-offset="300"
                                    data-toggle="popover-custom" class="nav-link">
                                    Grid Menu
                                    <div class="badge badge-dark ml-0 ml-1">
                                        <small>NEW</small>
                                    </div>
                                    <i class="fa fa-angle-up ml-2 opacity-8"></i>
                                </a>
                                <div class="rm-max-width rm-pointers">
                                    <div class="d-none popover-custom-content">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-tempting-azure">
                                                <div class="menu-header-image opacity-1"
                                                    style="background-image: url('assets/images/dropdown-header/city5.jpg');">
                                                </div>
                                                <div class="menu-header-content text-dark">
                                                    <h5 class="menu-header-title">Two Column Grid</h5>
                                                    <h6 class="menu-header-subtitle">Easy grid navigation inside
                                                        popovers</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid-menu grid-menu-2col">
                                            <div class="no-gutters row">
                                                <div class="col-sm-6">
                                                    <button
                                                        class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                        <i
                                                            class="lnr-lighter text-dark opacity-7 btn-icon-wrapper mb-2"></i>Automation
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button
                                                        class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                        <i
                                                            class="lnr-construction text-danger opacity-7 btn-icon-wrapper mb-2"></i>Reports
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button
                                                        class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">
                                                        <i
                                                            class="lnr-bus text-success opacity-7 btn-icon-wrapper mb-2"></i>Activity
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button
                                                        class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-focus">
                                                        <i
                                                            class="lnr-gift text-focus opacity-7 btn-icon-wrapper mb-2"></i>Settings
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item-divider nav-item"></li>
                                            <li class="nav-item-btn clearfix nav-item">
                                                <div class="float-left">
                                                    <button class="btn btn-link btn-sm">Link Button</button>
                                                </div>
                                                <div class="float-right">
                                                    <button class="btn-shadow btn btn-info btn-sm">Info
                                                        Button</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
