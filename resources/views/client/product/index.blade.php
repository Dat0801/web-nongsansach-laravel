@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $title }}</h1>
    </div>
    <!-- Single Page Header End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="row g-4" style="padding-bottom: 20px;">
                    <div class="col-xl-3">
                        <form class="input-group w-100 mx-auto d-flex" action="" method="get">
                            <input type="search" class="form-control p-3" placeholder="Từ khóa"
                                aria-describedby="search-icon-1" name="searchStr">
                            <button id="search-icon-1" class="input-group-text p-3" type="submit"><i
                                    class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <h4>Danh Mục</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    @foreach ($categories as $category)
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a
                                                    href="{{ route('product.index', ['category_id' => $category->category_id]) }}"><i
                                                        class="fas fa-apple-alt me-2"></i>{{ $category->category_name }}</a>
                                                <span>{{ '(' . $category->products_count . ')' }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="{{ asset('') }}assets/client/img/banner-fruits.jpg"
                                    class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Nông <br> Sản <br> Sạch</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row g-4 justify-content-center">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <div>
                                        <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                            <img src="{{ asset('') }}assets/client/img/products/{{ $product->primaryImage->image_name ?? 'no-image.jpg' }}"
                                                class="img-fluid w-100 rounded-top fruite-img" alt="">
                                        </a>
                                    </div>
                                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; left: 10px;">
                                        {{ $product->category->category_name }}
                                    </div>
                                    <div class="p-4 border border-primary border-top-0 rounded-bottom">
                                        <a href="{{ route('product.show', ['product' => $product->product_id]) }}">
                                            <h4 class="product-name mb-4">{{ $product->product_name }}</h4>
                                        </a>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-4">
                                                {{ number_format($product->product_price) }}<sup><small>đ</small></sup><sub>/<small>{{ $product->unit->unit_name }}
                                                        {{ $product->product_quantity }}{{ $product->weight->weight_name }}</small></sub>
                                            </p>
                                            @if ($product->product_stock > 0)
                                                <button
                                                    class="add-cart btn border border-secondary rounded-pill px-3 text-primary"
                                                    data-url="{{ route('cart') }}" data-id = "{{ $product->product_id }}">
                                                    <i class="fa fa-shopping-bag text-primary"></i>
                                                    <span class="d-none d-sm-inline ms-2">Thêm vào giỏ hàng</span>
                                                </button>
                                            @else
                                                <button class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <a href="{{ route('contact') }}"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i>Liên hệ
                                                        shop</a>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($products->lastPage() > 1)
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                @if ($products->currentPage() > 1)
                                    <a href="{{ $products->url($products->currentPage() - 1) . '&' . http_build_query(request()->except('page')) }}"
                                        class="rounded">&laquo;</a>
                                @endif

                                @php
                                    $maxVisiblePages = 5;
                                    $halfTotalLinks = floor($maxVisiblePages / 2);
                                    $startPage = max($products->currentPage() - $halfTotalLinks, 1);
                                    $endPage = min($startPage + $maxVisiblePages - 1, $products->lastPage());

                                    if ($endPage - $startPage < $maxVisiblePages - 1) {
                                        $startPage = max($endPage - $maxVisiblePages + 1, 1);
                                    }
                                @endphp

                                @if ($startPage > 1)
                                    <a href="{{ $products->url(1) . '&' . http_build_query(request()->except('page')) }}"
                                        class="rounded">1</a>
                                    @if ($startPage > 2)
                                        <span class="rounded">...</span>
                                    @endif
                                @endif

                                @foreach (range($startPage, $endPage) as $page)
                                    <a href="{{ $products->url($page) . '&' . http_build_query(request()->except('page')) }}"
                                        class="rounded {{ $products->currentPage() == $page ? 'active' : '' }}">
                                        {{ $page }}
                                    </a>
                                @endforeach

                                @if ($endPage < $products->lastPage())
                                    @if ($endPage < $products->lastPage() - 1)
                                        <span class="rounded">...</span>
                                    @endif
                                    <a href="{{ $products->url($products->lastPage()) . '&' . http_build_query(request()->except('page')) }}"
                                        class="rounded">{{ $products->lastPage() }}</a>
                                @endif

                                @if ($products->currentPage() < $products->lastPage())
                                    <a href="{{ $products->url($products->currentPage() + 1) . '&' . http_build_query(request()->except('page')) }}"
                                        class="rounded">&raquo;</a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
