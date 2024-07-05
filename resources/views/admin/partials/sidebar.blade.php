<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/DashBoard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="far fa-bookmark"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Trang Admin </div>
    </a>
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/DashBoard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Bảng điều khiển</span>
        </a>
    </li>
    <!-- Divider -->
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Quản lý trang -->
    <div class="sidebar-heading">
        Trang
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQLTrang"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý trang</span>
        </a>
        <div id="collapseQLTrang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-gradient-success py-2 collapse-inner rounded">
                <a class="collapse-item" href="/home">Trang người dùng</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <!-- Quản lý sản phẩm -->
    <div class="sidebar-heading">
        Sản phẩm
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQLSanPham"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý sản phẩm</span>
        </a>
        <div id="collapseQLSanPham" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-gradient-success py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('product.index') }}">Xem sản phẩm</a>
                <a class="collapse-item" href="{{ route('product.create') }}">Thêm sản
                    phẩm</a>
                <a class="collapse-item" href="{{ route('product.trash') }}">Khôi phục sản
                    phẩm</a>
                <a class="collapse-item" href="{{ route('unit.index') }}">Quản lý đơn vị tính</a>
                <a class="collapse-item" href="{{ route('weight.index') }}">Quản lý đơn vị trọng lượng</a>
                <a class="collapse-item" href="{{ route('image.index') }}">Quản lý hình ảnh</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Quản lý danh mục -->
    <div class="sidebar-heading">
        Danh mục
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQLDanhMuc"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý danh mục</span>
        </a>
        <div id="collapseQLDanhMuc" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-gradient-success py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('category.index') }}">Xem danh mục</a>
                <a class="collapse-item" href="{{ route('category.create') }}">Thêm danh
                    mục</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Quản lý đơn hàng -->
    <div class="sidebar-heading">
        Đơn hàng
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQLBrand"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý đơn hàng</span>
        </a>
        <div id="collapseQLBrand" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-gradient-success py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/order">Xem đơn hàng</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Quản lý khách hàng -->
    <div class="sidebar-heading">
        Khách hàng
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQLNguoiDung"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý khách hàng</span>
        </a>
        <div id="collapseQLNguoiDung" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-gradient-success py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('user.index') }}">Xem khách hàng</a>
                <a class="collapse-item" href="{{ route('user.create') }}">Thêm khách
                    hàng</a>
                <a class="collapse-item" href="">Quản lý địa chỉ</a>
                <a class="collapse-item" href="">Quản lý loại địa chỉ</a>

            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
