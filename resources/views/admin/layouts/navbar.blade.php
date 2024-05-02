<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.index') }}" >
                    <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Anasayfa</span>
                </a>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.company.index') }}" >
                    <i class="mdi mdi-store"></i> <span data-key="t-dashboards">Firmalar</span>
                </a>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.user.index') }}" >
                    <i class="mdi mdi-account-group"></i> <span data-key="t-dashboards">Kullanıcılar</span>
                </a>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.product.index') }}" >
                    <i class="mdi mdi-tag-check-outline"></i> <span data-key="t-dashboards">Ürünler</span>
                </a>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.order.index') }}" >
                    <i class="mdi mdi-basket"></i> <span data-key="t-dashboards">Siparişler</span>
                </a>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.finance.index') }}" >
                    <i class="mdi mdi-cash-fast"></i> <span data-key="t-dashboards">Finans</span>
                </a>
            </li> <!-- end Dashboard Menu -->

        </ul>
    </div>
    <!-- Sidebar -->
</div>
