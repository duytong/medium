<header class="m-grid__item m-header" data-minimize-offset="200" data-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">
            <div class="m-stack__item m-brand m-brand--skin-dark">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="{{ route('dashboard') }}" class="m-brand__logo-wrapper">
                            <img src="assets/administrator/images/logo_default_dark.png">
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                        <a id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                            <span></span>
                        </a>
                        <a id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <a id="m_aside_header_menu_mobile_toggle" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <a id="m_aside_header_topbar_mobile_toggle" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <button class="m-aside-header-menu-mobile-close m-aside-header-menu-mobile-close--skin-dark" id="m_aside_header_menu_mobile_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark">
                    <ul class="m-menu__nav m-menu__nav--submenu-arrow">
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--rel" data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-add"></i>
                                <span class="m-menu__link-text">Actions</span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item" aria-haspopup="true">
                                        <a href="{{ route('categories.create') }}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-tabs"></i>
                                            <span class="m-menu__link-text">Create a category</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item" aria-haspopup="true">
                                        <a href="{{ route('topics.create') }}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-book"></i>
                                            <span class="m-menu__link-text">Add a topic</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item" aria-haspopup="true">
                                        <a href="{{ route('posts.create') }}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-list"></i>
                                            <span class="m-menu__link-text">Write a post</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item" aria-haspopup="true">
                                        <a href="{{ route('tags.create') }}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-interface"></i>
                                            <span class="m-menu__link-text">Assign a tag</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item" data-redirect="true" aria-haspopup="true">
                                        <a href="{{ route('users.create') }}" class="m-menu__link">
                                            <i class="m-menu__link-icon flaticon-users"></i>
                                            <span class="m-menu__link-text">Register a member</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="m_header_topbar" class="m-topbar m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="
                                m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light m-list-search m-list-search--skin-light" 
                                data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch" data-search-type="dropdown">
                                    <a href="javascript:;" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-nav__link-icon">
                                            <i class="flaticon-search-1"></i>
                                        </span>
                                    </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header">
                                            <form class="m-list-search__form">
                                                <div class="m-list-search__form-wrapper">
                                                    <span class="m-list-search__form-input-wrapper">
                                                        <input type="text" class="m-list-search__form-input" placeholder="Search" autocomplete="off">
                                                    </span>
                                                    <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                                        <i class="la la-remove"></i>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
                                                <div class="m-dropdown__content"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
                                <a href="javascript:;" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-music-2"></i>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/administrator/images/bg_notification.jpg); background-size: cover;">
                                            <span class="m-dropdown__header-title">Notifications</span>
                                            <span class="m-dropdown__header-subtitle">System</span>
                                        </div>
                                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                                            <div class="m-dropdown__content">
                                                <div class="m-scrollable" data-scrollable="false" data-max-height="380" data-mobile-max-height="200">
                                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                                        <div class="m-nav-grid__row">
                                                            <a href="{{ route('welcome') }}" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-multimedia"></i>
                                                                <span class="m-nav-grid__text">Redirect to read</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                <a href="javascript:;" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-share"></i>
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/administrator/images/bg_quick_actions.jpg); background-size: cover;">
                                            <span class="m-dropdown__header-title">Quick actions</span>
                                            <span class="m-dropdown__header-subtitle">Shortcuts</span>
                                        </div>
                                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                                            <div class="m-dropdown__content">
                                                <div class="m-scrollable" data-scrollable="false" data-max-height="380" data-mobile-max-height="200">
                                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                                        <div class="m-nav-grid__row">
                                                            <a href="{{ route('welcome') }}" class="m-nav-grid__item">
                                                                <i class="m-nav-grid__icon flaticon-placeholder-1"></i>
                                                                <span class="m-nav-grid__text">User interface</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                <a href="javascript:;" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic">
                                        <img src="{{ auth()->user()->pathImage() }}" class="m--img-rounded m--marginless m--img-centered">
                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background: url(assets/administrator/images/bg_user_profile.jpg); background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__pic">
                                                    <img src="{{ auth()->user()->pathImage() }}" class="m--img-rounded m--marginless">
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">{{ auth()->user()->name }}</span>
                                                    <a href="javascript:;" class="m-card-user__email m--font-weight-300 m-link">{{ auth()->user()->email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('posts.create') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-list"></i>
                                                            <span class="m-nav__link-text">Posts</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('bookmarks') }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-interface-7"></i>
                                                            <span class="m-nav__link-text">Bookmarks</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ auth()->user()->path() }}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-text">Profile</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="javascript:;" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-settings"></i>
                                                            <span class="m-nav__link-text">Settings</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="javascript:;" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">Help</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('signout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                <a href="javascript:;" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon">
                                        <i class="flaticon-grid-menu"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>