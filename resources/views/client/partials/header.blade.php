<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">140 Đ. Lê Trọng Tấn, Tây Thạnh, Tân Phú, Hồ Chí Minh</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">nongsansach12@gmail.com</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('home') }}" class="navbar-brand">
                <h1 class="text-primary display-6 text-uppercase">Nông sản sạch</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link text-uppercase">Trang chủ</a>
                    <a href="{{ route('product.index') }}" class="nav-item nav-link text-uppercase">Sản phẩm</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link text-uppercase">Liên hệ</a>
                    @if (Auth::check())
                        <a href="{{ route('profile') }}" class="nav-item nav-link text-uppercase">Tài khoản</a>
                        <a href="{{ route('logout') }}" class="nav-item nav-link text-uppercase">Đăng xuất</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-item nav-link text-uppercase">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link text-uppercase">Đăng ký</a>
                    @endif
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span id='cart-badge'
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            @if (session()->has('cart'))
                                {{ count(session()->get('cart')) }}
                            @else
                                0
                            @endif
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="toast-container position-fixed end-0" style="bottom:10%; width:300px!important; z-index:99999">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Thêm sản phẩm vào giỏ hàng thành công!
        </div>
    </div>
</div>
