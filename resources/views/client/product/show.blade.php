@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $title }}</h1>
    </div>
    @if (session('success'))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('') }}assets/client/img/products/{{ $product->primaryImage['image_name'] }}"
                            class="rounded img-thumbnail me-2" style="width:40px;">
                        <p class="mb-0">{{ $product->product_name }} đã được thêm vào giỏ hàng. <a
                                href="{{ route('cart') }}" class="alert-link">Xem giỏ hàng</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Single Page Header End -->
    <div class="container-fluid mt-5" style="padding: 0;">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="col-md-12 col-lg-12">
                                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        @if (count($product->images) == 0)
                                            <div class="carousel-item active rounded">
                                                <img src="{{ asset('') }}assets/client/img/products/no-image.jpg"
                                                    class="img-fluid rounded w-100" alt="Image">
                                            </div>
                                        @else
                                            @foreach ($product->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }} rounded">
                                                    <img src="{{ asset('') }}assets/client/img/products/{{ $image->image_name }}"
                                                        class="img-fluid rounded w-100" alt="Image">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->product_name }}</h4>
                            <p class="mb-3">Danh Mục: {{ $product->category->category_name }}</p>
                            <h5 class="fw-bold mb-3">
                                {{ number_format($product->product_price) }}<sup><small>đ</small></sup><sub>/<small>{{ $product->unit_name }}
                                        {{ $product->product_quantity }}{{ $product->weight->weight_name }}</small></sub>
                            </h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <form action="{{ route('cart.addToCart', ['id' => $product->product_id]) }}" method="post">
                                <div class="mb-5" style="width: 110px;">
                                    <input type="number" name="quantity" id="productQty" class="form-control"
                                        placeholder="Số lượng" min="1" max="{{ $product->product_stock }}"
                                        value="1" required>
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                </div>

                                @if ($product->product_stock > 0)
                                    <button type="submit"
                                        class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                                        name="add_to_cart" value="add to cart"><i
                                            class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng</button>
                                @else
                                    <a href="{{ route('contact') }}"
                                        class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                            class="fa fa-shopping-bag me-2 text-primary"></i> Liên hệ shop</a>
                                @endif
                                @csrf
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Mô
                                        Tả</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Đánh Giá</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-lg-6">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Đơn vị tính</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product->unit->unit_name }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Trọng lượng</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">
                                                            {{ $product->product_quantity . $product->weight->weight_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Số lượng còn lại</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">
                                                            {{ $product->product_stock > 0 ? $product->product_stock : 'Hết hàng' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="{{ asset('') }}assets/client/img/avatar.jpg"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;"
                                            alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">25, 05, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Hoàng Phúc</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>Sản phẩm chất lượng!</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{ asset('') }}assets/client/img/avatar.jpg"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;"
                                            alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">24, 05, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Thuận Quang</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">Sản phẩm rất tươi ngon!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="#">
                            <h4 class="mb-5 fw-bold">Để lại đánh giá</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4"
                                            placeholder="Tên của bạn *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0"
                                            placeholder="Email của bạn *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8"
                                            placeholder="Đánh giá của bạn *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Đánh giá: </p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <a href="#"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                            Đăng bình luận</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <h1 class="fw-bold mb-0">Các sản phẩm liên quan</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        @foreach ($productsByCategory as $product)
                            <div class="border border-primary rounded position-relative" style="transition: 0.5s;">
                                <div class="vesitable-img">
                                    <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                        <img src="{{ asset('') }}assets/client/img/products/{{ $product->primaryImage->image_name ?? 'no-image.jpg' }}"
                                            class="img-fluid w-100 rounded-top carousel-image" alt="">
                                    </a>
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">
                                    {{ $product->category->category_name }}
                                </div>
                                <div class="p-4 rounded-bottom">
                                    <h4 class="mb-4 product-name">
                                        <a href="{{ route('product.show', ['product' => $product->product_id]) }}"
                                            class="text-dark text-decoration-none">{{ $product->product_name }}</a>
                                    </h4>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-4">
                                            {{ number_format($product->product_price) }}<sup><small>đ</small></sup><sub>/<small>{{ $product->unit_name }}
                                                    {{ $product->product_quantity }}{{ $product->weight->weight_name }}</small></sub>
                                        </p>
                                        <button class="add-cart btn border border-secondary rounded-pill px-3 text-primary"
                                            data-url="{{ route('cart') }}" data-id = "{{ $product->product_id }}">
                                            <i class="fa fa-shopping-bag text-primary"></i>
                                            <span class="d-none d-sm-inline ms-2">Thêm vào giỏ hàng</span>
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
    <script>
        window.onload = function() {
            var productQty = document.getElementById('productQty');

            productQty.oninput = function(e) {
                if (e.target.validity.rangeUnderflow) {
                    e.target.setCustomValidity("Số lượng không thể nhỏ hơn 1.");
                } else if (e.target.validity.rangeOverflow) {
                    e.target.setCustomValidity("Số lượng không thể lớn hơn số lượng tồn.");
                } else if (e.target.validity.valueMissing) {
                    e.target.setCustomValidity("Vui lòng nhập số lượng.");
                } else {
                    e.target.setCustomValidity("");
                }
            };
        }
    </script>
@endsection
