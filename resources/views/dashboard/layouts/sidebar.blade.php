<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('storage/' . getSetting('logo')) }}" width="150px" alt="">
                </a>

            </li>

        </ul>
    </div>
    <div class="divider my-2"></div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main mb-4" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ isActiveRoute('admin.home') }}"><a class="d-flex align-items-center"
                    href="{{ route('admin.home') }}"><i class="fas fa-home"></i> <span
                        class="menu-title text-truncate">{{ transWord('الرئيسية') }}</span></a>
            </li>




            <li class="nav-item {{ areActiveRoutes(['admin.students.index', 'admin.students.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.students.index') }}"><i
                        class="fas fa-user-graduate"></i><span
                        class="menu-title text-truncate">{{ transWord('الطلاب') }}</span></a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.instructors.index', 'admin.instructors.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.instructors.index') }}"><i
                        class="fas fa-chalkboard-teacher"></i><span
                        class="menu-title text-truncate">{{ transWord('المدربين') }}</span></a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.categories.index', 'admin.categories.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.categories.index') }}"><i
                        class="fas fa-th-list"></i><span
                        class="menu-title text-truncate">{{ transWord('الاقسام') }}</span></a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.courses.index', 'admin.courses.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.courses.index') }}"><i
                        class="fas fa-book"></i><span
                        class="menu-title text-truncate">{{ transWord('الكورسات') }}</span></a>
            </li>


            <li class="nav-item {{ areActiveRoutes(['admin.topics.index', 'admin.topics.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.topics.index') }}">
                    <i class="fas fa-list-alt"></i><span
                        class="menu-title text-truncate">{{ transWord('مواضيع الكورس') }}</span></a>
            </li>


            <li class="nav-item {{ areActiveRoutes(['admin.lessons.index', 'admin.lessons.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.lessons.index') }}">
                    <i class="fas fa-book"></i><span
                        class="menu-title text-truncate">{{ transWord('الدروس') }}</span></a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.quizzes.index', 'admin.quizzes.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.quizzes.index') }}">
                    <i class="fas fa-clipboard"></i><span
                        class="menu-title text-truncate">{{ transWord('الامتحانات') }}</span></a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.certificates.index', 'admin.certificates.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.certificates.index') }}">
                    <i class="fas fa-certificate"></i><span
                        class="menu-title text-truncate">{{ transWord('الشهادات') }}</span></a>
            </li>
            <li class="nav-item {{ areActiveRoutes(['admin.coupons.index', 'admin.coupons.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.coupons.index') }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="menu-title text-truncate">{{ transWord('اكواد الخصم') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.payments.index', 'admin.payments.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.payments.index') }}">
                    <i class="fas fa-credit-card"></i>
                    <span class="menu-title text-truncate">{{ transWord('وسائل الدفع') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.reviews.index', 'admin.reviews.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.reviews.index') }}">
                    <i class="fas fa-comments"></i>
                    <span class="menu-title text-truncate">{{ transWord('اراء العملاء') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.blogs.index', 'admin.blogs.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.blogs.index') }}">
                    <i class="fas fa-blog"></i>
                    <span class="menu-title text-truncate">{{ transWord('الاخبار') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.orders.index', 'admin.orders.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="menu-title text-truncate">{{ transWord('الطلبات') }}</span>
                </a>
            </li>



            <li class="nav-item {{ areActiveRoutes(['admin.features.index', 'admin.features.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.features.index') }}">
                    <i class="fas fa-star"></i>
                    <span class="menu-title text-truncate">{{ transWord('المميزات') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.partners.index', 'admin.partners.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.partners.index') }}">
                    <i class="fas fa-handshake"></i>
                    <span class="menu-title text-truncate">{{ transWord('شركانا') }}</span>
                </a>
            </li>


            <li class="nav-item {{ areActiveRoutes(['admin.packages.index', 'admin.packages.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.packages.index') }}">
                    <i class="fas fa-box"></i>
                    <span class="menu-title text-truncate">{{ transWord('الباقات') }}</span>
                </a>
            </li>

            <li class="nav-item {{ areActiveRoutes(['admin.contacts.index', 'admin.contacts.edit']) }}">
                <a class="d-flex align-items-center" href="{{ route('admin.contacts.index') }}"><i
                        class="fa-solid fa-inbox"></i><span
                        class="menu-title text-truncate">{{ transWord('رسائل التواصل') }}</span></a>
            </li>



            {{-- @can('tools')
                <li class="nav-item {{ areActiveRoutes(['admin.tools.index', 'admin.tools.edit']) }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.tools.index') }}"><i
                            class="fas fa-network-wired"></i><span
                            class="menu-title text-truncate">{{ transWord('أدوات الربط') }}</span></a>
                </li>
            @endcan --}}

            <li class="nav-item {{ isActiveRoute('admin.settings.create') }}"><a class="d-flex align-items-center"
                    href="{{ route('admin.settings.create') }}"><i class="fa-solid fa-gear"></i><span
                        class="menu-title text-truncate">{{ transWord('الإعدادات') }}</span></a>
            </li>
        </ul>

    </div>
</div>
<!-- END: Main Menu-->
