<section class="category-menu">
    @php($route = Route::currentRouteName())
    <ul class="liststyle--none category-menu__menu-block">
        <li>
            <a href="{{ route('admin.index') }}">DASHBOARD</a>
        </li>
        <li>
            <a href="">PRODUCTS</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.products.index', 'status='.'all') }}" class="allProducts"><li> All Products</li></a>
                <a href="{{ route('admin.products.create.new') }}" class="addProduct"><li> Add Product</li></a>
              
            </ul>
        </li>
        @role('admin','manager')
        <li>
            <a href="{{ route('admin.category') }}">CATEGORIES</a>
        </li>
        @endrole
        <li><a href="{{ route('admin.brands.index') }}">BRANDS</a></li>
        <li>
            <a href="">ORDERS</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.order.index', 'status='.'all') }}" class="allOrders"><li> All Orders</li></a>
                <a href="{{ route('admin.order.return') }}" class="orderReturn"><li> Order Returns</li></a>
            </ul>
        </li>
        @role('admin')
        <li class="{{ request()->has('role') || $route == 'admin.users.main' || $route == 'admin.users.create' || $route == 'admin.users.edit' ? 'active': null }}">
            <a href="javascript:void(0)">USERS</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.users.main', 'role=' . 'admin') }}" class="allAdmins"><li class="{{ request()->has('role') && request('role') === 'admin' ? 'active': null }}"> Administrators</li></a>
                <a href="{{ route('admin.users.main', 'role=' . 'manager') }}" class="allManagers"><li class="{{ request()->has('role') && request('role') === 'manager' ? 'active': null }}"> Managers</li></a>
                <a href="{{ route('admin.users.main', 'role=' . 'vendor') }}" class="allVendors"><li class="{{ request()->has('role') && request('role') === 'vendor' ? 'active': null }}"> Vendors</li></a>
                <a href="{{ route('admin.users.main', 'role=' . 'client') }}" class="allClients"><li class="{{ request()->has('role') && request('role') === 'client' ? 'active': null }}"> Clients</li></a>
                <a href="{{ route('admin.users.main', 'role=' . '') }}" class="allUsers"><li> All Users</li></a>
                <a href="{{ route('admin.users.create') }}" class="addUser"><li> Add New User</li></a>
            </ul>
        </li>
        @endrole
        @role('admin','manager')
        <li><a href="javascript:void(0)">VENDORS & SUPER CUSTOMER</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.vendor.index') }}"><li>Vendor Details</li></a>
               <a href="{{ route('admin.vendor.request') }}"><li>Vendor Request</li></a>
                <a href="{{ route('admin.vendor.reviews.index') }}"><li>Vendor Rating</li></a>
                    <a href="{{ route('admin.vendor.commission') }}"><li>Super Vendor Commissions</li></a>
                <a href="{{ route('admin.vendor.referrals') }}"><li>Super Vendor Referrals</li></a>
                <a href="{{ route('admin.vendor.SuperCustomer_commissions') }}"><li>Super Customer Commissions</li></a>
                <a href="{{ route('admin.vendor.SuperCustomer_referrals') }}"><li>Super Customer Referrals</li></a>
            </ul>
        </li>
        @endrole
        <li>
            <a href="">DEALS</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.deals.index') }}" class="allDeals"><li> All Deals</li></a>
                <a href="{{ route('admin.deals.create') }}" class="addDeal"><li> Add New Deal</li></a>
            </ul>
        {{-- </li>
             <li>
            <a href="">PAGES</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.page.index') }}" class="allDeals"><li> All Pages</li></a>
                <a href="{{ route('admin.page.create') }}" class="addDeal"><li> Add New Page</li></a>
            </ul>
        </li> --}}
        <li>
            <a href="javascript:void(0)">TEAM</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.teams.index') }}" class="allTeams"><li> All Team Members</li></a>
                <a href="{{ route('admin.teams.create') }}" class="addTeam"><li> Add New Member</li></a>
            </ul>
        </li>

       
        
        <li><a href="{{ route('admin.withdraw') }}">WITHDRAWALS </a></li>
        

        <li><a href="{{ route('admin.disputes') }}">DISPUTES</a></li>
        <li>
            <a href="javascript:void(0)">SETTING</a>
            <ul class="liststyle--none category-menu__sub-menu-block ">
                <a href="{{ route('admin.commissions.index') }}" class="commissionSettings"><li> Commission Settings</li></a>
                <a href="{{ route('admin.coupon.index') }}"><li>Coupons</li></a>
                @role('admin')
                <a href="{{ route('admin.settings') }}" class="setting"><li> Setting</li></a>
                @endrole
            </ul>
        </li>
    </ul>
</section>
