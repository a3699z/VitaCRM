<nav class="navbar-wrapper">
    <form class="navbar-search" onsubmit="return false;">
        <button type="submit" class="navbar-search__btn">
            <i class="las la-search"></i>
        </button>
        <input type="search" name="navbar-search__field" id="navbar-search__field"
               placeholder="Search...">
        <button type="button" class="navbar-search__close"><i class="las la-times"></i></button>

        <div id="navbar_search_result_area">
            <ul class="navbar_search_result"></ul>
        </div>
    </form>

    <div class="navbar__left">
        <button class="res-sidebar-open-btn"><i class="las la-bars"></i></button>
        <button type="button" class="fullscreen-btn">
            <i class="fullscreen-open las la-compress" onclick="openFullscreen();"></i>
            <i class="fullscreen-close las la-compress-arrows-alt" onclick="closeFullscreen();"></i>
        </button>
    </div>

    <div class="navbar__right">
        <ul class="navbar__action-list">
            <!-- <li>
                <button type="button" class="navbar-search__btn-open">
                    <i class="las la-search"></i>
                </button>
            </li>
 -->

            <li class="dropdown">
                <!-- <button type="button" class="primary--layer" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <i class="las la-bell text--primary"></i>
                </button> -->
                <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right">
                  <div class="dropdown-menu__header">
                    <span class="caption">@lang('Notification')</span>
                        <p>@lang('No unread notification found')</p>
                  </div>
                  <div class="dropdown-menu__body">
                  </div>
                  <div class="dropdown-menu__footer">
                    <a href="{{ route('admin.users') }}" class="view-all-message">@lang('View all notification')</a>
                  </div>
                </div>
            </li>


            <li class="dropdown">
                <button type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <span class="navbar-user">
                    <span class="navbar-user__info">
                      <span class="navbar-user__name"></span>
                    </span>
                    <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                  </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <a href="{{ route('profile.index') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a href="{{ route('logout') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->
