<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
        <i class="ph-house"></i>
        <span>ڈیش بورڈ </span>
    </a>
</li>
@canany(['vendors-list','bills-list','purchasePayments'])
<li class="nav-item nav-item-submenu {{ request()->is('purchasing*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-shopping-bag-open"></i>
        <span> خام مال خریداری </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('purchasing*') ? 'show' : ''}}">
        @can('vendors-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('vendors.index') }}" 
                    class="nav-link {{ request()->routeIs('vendors*') ? 'active' : ''}}">
                    فروش کھاتا
                </a>
            </li>
        @endcan
        @can('bills-list')
            <li class="nav-item">
                <a 
                    href="{{ route('bills.index') }}"
                    class="nav-link {{ request()->routeIs('bills*') ? 'active' : ''}}">
                    خریداری بلز
                </a>
            </li>
        @endcan
        @can('purchasePayments-list')
            <li class="nav-item">
                <a 
                    href="{{ route('purchase-payments.index') }}"
                    class="nav-link {{ request()->routeIs('purchase-payments*') ? 'active' : ''}}">
                    خریداری رقم
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['customers-list','invoices-list','salePayments-list'])
<li class="nav-item nav-item-submenu {{ request()->is('selling*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-shopping-cart"></i>
        <span>فروخت </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('selling*') ? 'show' : ''}}">
        @can('customers-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('customers.index') }}" 
                    class="nav-link {{ request()->routeIs('customers*') ? 'active' : ''}}">
                    کسٹمرز
                </a>
            </li>
        @endcan
        @can('invoices-list')
            <li class="nav-item">
                <a 
                    href="{{ route('invoices.index') }}"
                    class="nav-link {{ request()->routeIs('invoices*') ? 'active' : ''}}">
                    کسٹمر بلز
                </a>
            </li>
        @endcan
        @can('salePayments-list')
            <li class="nav-item">
                <a 
                    href="{{ route('sale-payments.index') }}"
                    class="nav-link {{ request()->routeIs('sale-payments*') ? 'active' : ''}}">
                    کسٹمر رقم وصولی
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['workers-list','orders-list','productionPayments-list'])
<li class="nav-item nav-item-submenu {{ request()->is('production*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-activity"></i>
        <span>پیداوار </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('production*') ? 'show' : ''}}">
        @can('workers-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('workers.index') }}" 
                    class="nav-link {{ request()->routeIs('workers*') ? 'active' : ''}}">
                     ورکرز 
                </a>
            </li>
        @endcan
        @can('issueOrders-list')
            <li class="nav-item">
                <a 
                    href="{{ route('issue-orders.index') }}"
                    class="nav-link {{ request()->routeIs('issue-orders*') ? 'active' : ''}}">
                     احکامات  جاری 
                </a>
            </li>
        @endcan
        @can('receiveOrders-list')
            <li class="nav-item">
                <a 
                    href="{{ route('receive-orders.index') }}"
                    class="nav-link {{ request()->routeIs('receive-orders*') ? 'active' : ''}}">
                     احکامات وصول 
                </a>
            </li>
        @endcan
        @can('productionPayments-list')
            <li class="nav-item">
                <a 
                    href="{{ route('production-payments.index') }}"
                    class="nav-link {{ request()->routeIs('production-payments*') ? 'active' : ''}}">
                    کارکن رقم
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['purchaseItems-list','saleItems-list'])
<li class="nav-item nav-item-submenu {{ request()->is('item*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-article"></i>
        <span> آئٹم </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('item*') ? 'show' : ''}}">
        @can('purchaseItems-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('purchase-items.index') }}" 
                    class="nav-link {{ request()->routeIs('purchase-items*') ? 'active' : ''}}">
                    خام مال
                </a>
            </li>
        @endcan
        @can('saleItems-list')
            <li class="nav-item">
                <a 
                    href="{{ route('sale-items.index') }}"
                    class="nav-link {{ request()->routeIs('sale-items*') ? 'active' : ''}}">
                    فینسی
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['purchaseStocks-list','saleStocks-list'])
<li class="nav-item nav-item-submenu {{ request()->is('stock*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-list-bullets"></i>
        <span> اسٹاک </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('stock*') ? 'show' : ''}}">
        @can('purchaseStocks-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('purchase-stocks.index') }}" 
                    class="nav-link {{ request()->routeIs('purchase-stocks*') ? 'active' : ''}}">
                    خام مال
                </a>
            </li>
        @endcan
        @can('saleStocks-list')
            <li class="nav-item">
                <a 
                    href="{{ route('sale-stocks.index') }}"
                    class="nav-link {{ request()->routeIs('sale-stocks*') ? 'active' : ''}}">
                    فینسی مال
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@canany(['accounts-list','transfers-list','transactions-list'])
<li class="nav-item nav-item-submenu {{ request()->is('banking*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-bank"></i>
        <span> بینکنگ </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('banking*') ? 'show' : ''}}">
        @can('accounts-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('accounts.index') }}" 
                    class="nav-link {{ request()->routeIs('accounts*') ? 'active' : ''}}">
                    اکاؤنٹس
                </a>
            </li>
        @endcan
        @can('transfers-list')
            <li class="nav-item">
                <a 
                    href="{{ route('transfers.index') }}"
                    class="nav-link {{ request()->routeIs('transfers*') ? 'active' : ''}}">
                    رقم منتقلی
                </a>
            </li>
        @endcan
        @can('transactions-list')
            <li class="nav-item">
                <a 
                    href="{{ route('transactions.index') }}"
                    class="nav-link {{ request()->routeIs('transactions*') ? 'active' : ''}}">
                    لین دین
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany
@can('banks-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('banks*') ? 'active' : ''}}" href="{{ route('banks.index') }}">
        <i class="ph-bank"></i>
        <span> بینک کی فہرست </span>
    </a>
</li>
@endcan
@can('shops-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('shops*') ? 'active' : ''}}" href="{{ route('shops.index') }}">
        <i class="ph-storefront"></i>
        <span> ورکشاپ کھاتہ </span>
    </a>
</li>
@endcan
@can('warehouses-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('warehouses*') ? 'active' : ''}}" href="{{ route('warehouses.index') }}">
        <i class="ph-house-simple"></i>
        <span> گودام </span>
    </a>
</li>
@endcan
@canany(['users-list','roles-list','notifications-list','audits-list','logs-list','settings-list'])
<li class="nav-item nav-item-submenu {{ request()->is('configuration*') ? 'nav-item-open' : ''}}">
    <a href="#" class="nav-link">
        <i class="ph-gear"></i>
        <span> ترتیب </span>
    </a>
    <ul class="nav-group-sub collapse {{ request()->is('configuration*') ? 'show' : ''}}">
        @can('users-list')
            <li class="nav-item">
                <a 
                    href ="{{ route('users.index') }}" 
                    class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}">
                    صارفین
                </a>
            </li>
        @endcan
        @can('roles-list')
            <li class="nav-item">
                <a 
                    href="{{ route('roles.index') }}"
                    class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}">
                    کردار
                </a>
            </li>
        @endcan
        @can('notifications-list')
            <li class="nav-item">
                <a 
                    href="{{ route('notifications.index') }}"
                    class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}">
                    اطلاعات
                </a>
            </li>
        @endcan
        @can('audits-list')
            <li class="nav-item">
                <a 
                    href="{{ route('audits.index') }}"
                    class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}">
                    آڈٹ 
                </a>
            </li>
        @endcan
        @can('logs-list')
            <li class="nav-item">
                <a 
                    href="{{ route('logs') }}" target="_blank"
                    class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}">
                     غلطیاں 
                </a>
            </li>
        @endcan
        @can('settings-list')
            <li class="nav-item">
                <a 
                    href="{{ route('settings.index') }}"
                    class="nav-link {{ request()->routeIs('settings*') ? 'active' : ''}}">
                    ترتیبات
                </a>
            </li>
        @endcan
    </ul>
</li>
@endcanany