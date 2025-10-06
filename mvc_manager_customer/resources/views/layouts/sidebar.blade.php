<nav id="sidebar" class="sidebar js-sidebar" >
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="">
            <span class="align-middle">HT Quản lý Khách hàng</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Quản lý tài khoản
            </li>
            <li class="sidebar-item {{ Route::is('account.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('account.index') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Danh sách tài khoản</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('account.create') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('account.create') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Thêm mới tài khoản</span>
                </a>
            </li>

            <li class="sidebar-header">
                Quản lý khách hàng
            </li>
            <li class="sidebar-item {{ Route::is('customer.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('customer.index') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Danh sách khách hàng</span>
                </a>
            </li>
            <li class="sidebar-item {{ Route::is('customer.create') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('customer.create') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Thêm mới khách hàng</span>
                </a>
            </li>
            <li class="sidebar-header">
                Quản lý hợp đồng
            </li>
            <li class="sidebar-item {{ Route::is('contract.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('contract.index') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Danh sách hợp đồng</span>
                </a>
            </li>
            <li class="sidebar-item {{ Route::is('contract.create') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('contract.create') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Thêm mới hợp đồng</span>
                </a>
            </li>

            <li class="sidebar-header">
                Quản lý giao dịch
            </li>
            <li class="sidebar-item {{ Route::is('transaction.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('transaction.index') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Danh sách giao dịch</span>
                </a>
            </li>
            <li class="sidebar-item {{ Route::is('transaction.create') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('transaction.create') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Thêm mới giao dịch</span>
                </a>
            </li>

            <li class="sidebar-header">
                Báo cáo thống kê
            </li>
            <li class="sidebar-item {{ Route::is('report.showTransaction') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('report.showTransaction') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Báo cáo tài chính</span>
                </a>
            </li>
            <li class="sidebar-item {{ Route::is('report.showContract') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('report.showContract') }}">
                    <i data-feather="sliders"></i> <span class="align-middle">Báo cáo hợp đồng</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
<style>
    .sidebar,
    .sidebar-content {
        background-color: #9e1f1e !important;
    }

    .sidebar .sidebar-header {
        color: #f8d9d9 !important;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 12px;
        letter-spacing: 0.5px;
        margin-top: 20px;
        margin-bottom: 10px;
        padding-left: 10px;
    }

    .sidebar .sidebar-item .sidebar-link {
        background-color: transparent !important;
        color: rgba(255, 255, 255, 0.85) !important;
        padding: 10px 14px;
        border-radius: 6px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar .sidebar-item .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #ffffff !important;
    }

    .sidebar .sidebar-item.active .sidebar-link {
        background-color: rgba(0, 0, 0, 0.15) !important;
        color: #ffffff !important;
        font-weight: 600;
    }

    .sidebar .sidebar-link i[data-feather] {
        stroke: #ffffff !important;
        width: 16px;
        height: 16px;
        margin-right: 6px;
    }
</style>

