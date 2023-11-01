
<li class="nav-item-header pt-0">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
        <i class="ph-house"></i>
        <span>Dashboard</span>
    </a>
</li>
@canany(['roles-list', 'users-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Access Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('roles-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
        <i class="ph-atom"></i>
        <span>Roles</span>
    </a>
</li>
@endcan
@can('users-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
        <i class="ph-users"></i>
        <span>Users</span>
    </a>
</li>
@endcan
@canany(['banks-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Catalog Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('banks-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('banks*') ? 'active' : ''}}" href="{{ route('banks.index') }}">
        <i class="ph-bank"></i>
        <span>Banks</span>
    </a>
</li>
@endcan
@canany(['accounts-list','transfers-list','transactions-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Banking Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('accounts-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('accounts*') ? 'active' : ''}}" href="{{ route('accounts.index') }}">
        <i class="ph-bank"></i>
        <span>Accounts</span>
    </a>
</li>
@endcan
@can('transfers-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('transfer*') ? 'active' : ''}}" href="{{ route('transfers.index') }}">
        <i class="ph-arrows-left-right"></i>
        <span>Transfer</span>
    </a>
</li>
@endcan
@can('transactions-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('transactions*') ? 'active' : ''}}" href="{{ route('transactions.index') }}">
        <i class="ph-arrows-out-line-horizontal"></i>
        <span>Transactions</span>
    </a>
</li>
@endcan
@canany(['notifications-list','audits-list', 'logs-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Configuration</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}" href="{{ route('notifications.index') }}">
        <i class="ph-bell"></i>
        <span>Notifications</span>
    </a>
</li>
@endcan
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}" href="{{ route('audits.index') }}">
        <i class="ph-diamonds-four"></i>
        <span>Audit</span>
    </a>
</li>
@endcan
@can('logs-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}" href="{{ route('logs') }}" target="_blank">
        <i class="ph-bug"></i>
        <span>Errors</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('settings*') ? 'active' : ''}}" href="{{ route('settings.index') }}">
        <i class="ph-gear"></i>
        <span>Settings</span>
    </a>
</li>
