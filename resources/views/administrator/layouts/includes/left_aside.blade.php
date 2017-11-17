<button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item m-aside-left m-aside-left--skin-dark">
    <div id="m_ver_menu" class="m-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow">
            <li class="m-menu__item" aria-haspopup="true">
                <a href="{{ route('dashboard') }}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Dashboard</span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Navigation</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('categories.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-tabs"></i>
                    <span class="m-menu__link-text">Categories</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('topics.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-book"></i>
                    <span class="m-menu__link-text">Topics</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('posts.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-list"></i>
                    <span class="m-menu__link-text">Posts</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('tags.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-interface"></i>
                    <span class="m-menu__link-text">Tags</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="{{ route('users.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Users</span>
                </a>
            </li>
        </ul>
    </div>
</div>