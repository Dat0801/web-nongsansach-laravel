@extends('admin.shared.layout')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('content')
    <form class="d-flex" action="{{ route('admin.product.index') }}" method="get">
        <div style="margin: 0 auto">
            <input class="form-control me-2" type="search" placeholder="Nhập tên hàng hóa..." aria-label="Tìm kiếm hàng hóa..."
                style="width:400px; margin: 0 auto" name="searchStr" id="searchStr">
            <center>
                <button class="btn btn-outline-success m-2" type="submit">Tìm kiếm</button>
            </center>
        </div>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive container">
        <table class="table table-secondary table-bordered"
            style="text-align: center; border-radius: 10px; overflow: hidden;color:black">
            <thead>
                <tr>
                    <th scope="col">Mã&nbsp;hàng&nbsp;hóa</th>
                    <th scope="col">Tên&nbsp;hàng&nbsp;hóa</th>
                    <th scope="col">Tên&nbsp;nhóm&nbsp;hàng</th>
                    <th scope="col">Tên&nbsp;đơn&nbsp;vị&nbsp;tính</th>
                    <th scope="col">Trọng&nbsp;lượng</th>
                    <th scope="col">Tên&nbsp;đơn&nbsp;vị&nbsp;trọng&nbsp;lượng</th>
                    <th scope="col">Giá&nbsp;bán</th>
                    <th scope="col">Số&nbsp;lượng&nbsp;tồn</th>
                    <th scope="col">Trạng&nbsp;thái</th>
                    <th scope="col" colspan="2">CRUD</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->unit->unit_name }}</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>{{ $product->weight->weight_name }}</td>
                        <td>{{ $product->product_price }}</td>
                        <td>{{ $product->product_stock }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('admin.product.restore', ['id' => $product->product_id]) }}"
                                class="btn btn-sm btn-success material-symbols-outlined">cycle</a>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-delete material-symbols-outlined"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-productid="{{ $product->product_id }}"
                                data-productname="{{ $product->product_name }}">delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{ $products->onEachSide(1)->links() }}
        </div>
        <div>
            </center>
            <a href="{{ route('admin.product.index') }}" class="btn btn-lg btn-primary material-symbols-outlined">
                keyboard_return
            </a>
        </div>
    </div>

    <!-- Xử lý phân trang -->

    <!-- Xử lý nút delete -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black">Xoá danh mục hàng hoá</h5>
                </div>
                <div class="modal-body">
                    <p style="color: red">Bạn có chắc muốn xoá danh mục hàng này không?</p>
                    <table class="table table-product">
                        <tr>
                            <td>Mã hàng hóa</td>
                            <td><span id="DeleteproductIDSpan"></span></td>
                        </tr>
                        <tr>
                            <td>Tên hàng hóa</td>
                            <td><span id="DeleteproductNameSpan"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.btn-delete').click((event) => {
            const productid = $(event.target).attr('data-productid');
            const productname = $(event.target).attr('data-productname');
            $('#DeleteproductIDSpan').html(productid);
            $('#DeleteproductNameSpan').html(productname);

            let baseUrl = '{{ route('admin.product.destroy', ['product' => ':id']) }}';
            let deleteUrl = baseUrl.replace(':id', productid);

            $('#deleteForm').attr('action', deleteUrl);
        })
    </script>
@endsection
