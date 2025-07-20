<!-- Sidemenu Area -->
<div class="ecaps-sidemenu-area">
    <!-- Desktop Logo -->
    <div class="ecaps-logo">
        <a href="index-2.html"> <span style="font-size:18px;font-weight:bold;color:white">سیم و کابل آمل</span></a>
    </div>

    <!-- Side Nav -->
    <div class="ecaps-sidenav" id="ecapsSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
            <!-- Sidebar Menu -->
            <nav>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="active"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-view-dashboard"></i><span>داشبورد</span></a></li>
                    <li><a href="{{ route('admin.users.index') }}"><i class="zmdi zmdi-accounts"></i><span>مدیریت کاربران</span></a></li>
                    <li><a href="{{ route('admin.posts.index') }}"><i class="zmdi zmdi-label"></i><span>مدیریت سمت‌ها</span></a></li>
                    <li><a href="{{ route('admin.user-hierarchy.manage') }}"><i class="zmdi zmdi-collection-item"></i><span>مدیریت زیرمجموعه کاربران</span></a></li>
                    <li><a href="{{ route('admin.locations.manage') }}"><i class="zmdi zmdi-pin"></i><span>مدیریت مکان‌ها</span></a></li>
                    <li><a href="{{ route('admin.positions.manage') }}"><i class="zmdi zmdi-city"></i><span>مدیریت جایگاه‌ها</span></a></li>
                    <li><a href="{{ route('admin.regions') }}"><i class="zmdi zmdi-map"></i><span>مدیریت مناطق</span></a></li>
                    <li class="nav-item has-sub">
                        <a href="#" class="nav-link">
                            <i class="fa fa-tree"></i> <span>مدیریت درختان</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.tree-groups') }}">مدیریت گروه‌های درختی</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.trees') }}">مدیریت گونه‌های درختی</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.planted-trees') }}">ثبت و مدیریت درختان خیابان</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.qr-generator.index') }}"><i class="zmdi zmdi-qrcode"></i> تولید انبوه کدهای QR</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.tree-reports.index') }}"><i class="zmdi zmdi-flag"></i> لیست گزارشات درختان</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user-posts.index') }}">
                           
                            <span>مدیریت پست کاربران</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user-posts.tree') }}">
                          
                            <span>درخت کاربران و پست‌ها (Vue)</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.citizens.index') }}"><i class="zmdi zmdi-accounts-alt"></i> لیست شهروندان</a></li>
                    <li class="nav-item has-sub">
                        <a href="#" class="nav-link">
                            <i class="zmdi zmdi-shield-security"></i> <span>مدیریت دسترسی‌ها</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.roles.index') }}">مدیریت نقش‌ها</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.permissions.index') }}">مدیریت مجوزها</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.user-roles.index') }}">اختصاص نقش به کاربر</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div> 