@php
    $currentRoute = Route::currentRouteName();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ asset('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('images/gp_logo.png') }}" alt="gp logo" style="height: 28px">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2"
                style="text-transform: capitalize;font-size: 24px">BDGamers Club </span>
            <br />
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>


    <div class="menu-inner-shadow"></div>


    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if ($currentRoute == 'admin.dashboard' || $currentRoute == 'admin.dashboard') active open @endif">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i
                    class="menu-icon tf-icons bx bx-home-circle @if ($currentRoute == 'admin.dashboard') selectedIconPopup @endif"></i>
                <div data-i18n="Analytics" class="text-semibold">Dashboard</div>
            </a>
        </li>
        <li class="menu-item @if ($currentRoute == 'admin.user.index') active open @endif">
            <a href="{{ route('admin.user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user @if ($currentRoute == 'admin.user.index') selectedIconPopup @endif"></i>
                <div data-i18n="Analytics" class="text-semibold">Users</div>
            </a>
        </li>
        <li class="menu-item @if ($currentRoute == 'admin.subscribers') active open @endif">
            <a href="{{ route('admin.subscribers') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-account @if ($currentRoute == 'admin.subscribers') selectedIconPopup @endif"></i>
                <div data-i18n="Analytics" class="text-semibold">Subscribers</div>
            </a>
        </li>
        <li class="menu-item @if (
            $currentRoute == 'admin.campaigns' ||
                $currentRoute == 'admin.campaigns.create' ||
                $currentRoute == 'admin.campaigns.edit' ||
                $currentRoute == 'admin.campaigns.show' ||
                $currentRoute == 'admin.campaign-durations.index' ||
                $currentRoute == 'admin.campaign-durations.create' ||
                $currentRoute == 'admin.campaign-durations.edit' ||
                $currentRoute == 'admin.campaign-durations.show') active open @endif">
            <a href="{{ route('admin.campaigns') }}" class="menu-link">
                <i
                    class="menu-icon tf-icons bx bxl-dropbox @if (
                        $currentRoute == 'admin.campaigns' ||
                            $currentRoute == 'admin.campaigns.create' ||
                            $currentRoute == 'admin.campaigns.edit' ||
                            $currentRoute == 'admin.campaigns.show' ||
                            $currentRoute == 'admin.campaign-durations.index' ||
                            $currentRoute == 'admin.campaign-durations.create' ||
                            $currentRoute == 'admin.campaign-durations.edit' ||
                            $currentRoute == 'admin.campaign-durations.show') selectedIconPopup @endif"></i>
                <div data-i18n="Analytics" class="text-semibold">Campaigns</div>
            </a>
        </li>
        <li class="menu-item @if ($currentRoute == 'admin.campaign-score-logs.index') active open @endif">
            <a href="{{ route('admin.campaign-score-logs.index') }}" class="menu-link">
                <i
                    class="menu-icon tf-icons bx bxs-component @if ($currentRoute == 'admin.campaign-score-logs.index') selectedIconPopup @endif"></i>
                <div data-i18n="Analytics" class="text-semibold">Leaderboard</div>
            </a>
        </li>
        <li class="menu-item @if ($currentRoute == 'admin.score-logs.index') active open @endif">
            <a href="{{ route('admin.score-logs.index') }}" class="menu-link">
                <i
                    class="menu-icon tf-icons bx bxs-component @if ($currentRoute == 'admin.campaign-score-logs.index') selectedIconPopup @endif"></i>
                <div data-i18n="Analytics" class="text-semibold">Score Logs</div>
            </a>
        </li>


        <li class="menu-item @if ($currentRoute == 'admin.games.index') active open @endif">
            <a href="{{ route('admin.games.index') }}" class="menu-link">
                <i
                    class='menu-icon tf-icons bx bxs-game text-semibold @if ($currentRoute == 'admin.game.index') selectedIconPopup @endif'></i>
                <div data-i18n="Analytics" class="text-semibold">Games</div>
            </a>
        </li>


    </ul>
</aside>
