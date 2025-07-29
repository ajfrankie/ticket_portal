<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-chat">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.ticket.index') }}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-chat">Tickets</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.replay.index') }}" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-chat">Replay</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
