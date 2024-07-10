@extends('client.shared.layout')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('') }}assets/client/css/profile.css">
    <!-- PROFILE -->
    <div class="container hero-header emp-profile">
        <div method="post">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="profile-head">
                        <div class="row">
                            <div class="col-md-10">
                                <h5>Hồ Sơ Của Bạn</h5>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('logout') }}" class="btn btn-primary">Đăng xuất</a>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Thông
                                        tin người dùng</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Lịch sử mua hàng</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-changepassword-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-changepassword" aria-controls="nav-changepassword"
                                        aria-selected="false">Đổi mật khẩu</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <form class="col-11" action="" method="post">
                                                <div class="row align-items-center text-center justify-content-center py-2">
                                                    <div class="col-4">
                                                        <p class="mb-0">Tên khách hàng:</p>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" value="{{ Auth::user()->name }}"
                                                            class="form-control mb-0" name="name">
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-4">
                                                        <p class="mb-0">Email:</p>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" value="{{ Auth::user()->email }}"
                                                            class="form-control mb-0" disabled>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center text-center justify-content-center py-2">
                                                    <div class="col-4">
                                                        <p class="mb-0">Địa chỉ:</p>
                                                    </div>

                                                    <div class="form-group col-8">
                                                        <input class="form-control" disabled value=""></input>
                                                    </div>
                                                </div>
                                                <div class="align-items-center text-center justify-content-center py-3">
                                                    <input type="submit" class="btn btn-primary" name="btnUpdateProfile"
                                                        value="Chỉnh sửa hồ sơ" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">

                                    {{-- <?php
                                    foreach ($purchasing_history as $key => $item) {
                                        $totalCounter = 0;
                                        $itemCounter = 0;
                                        ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sản phẩm</th>
                                                    <th scope="col">Giá</th>
                                                    <th scope="col">Đơn vị tính</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Tổng</th>
                                                </tr>
                                            </thead>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <h5>Hóa đơn
                                                        <?php echo $key + 1; ?>
                                                    </h5>
                                                    <?php
                                                    $date = new DateTime($item['NgayGiao']);
                                                    $formattedDate = $date->format('d-m-Y');
                                                    $date = '(' . $formattedDate . ')';
                                                    
                                                    if ($item['TrangThai'] == 'Đang xử lý' || $item['TrangThai'] == 'Đang giao hàng') {
                                                        $color = '#e65c00';
                                                        if ($item['TrangThai'] == 'Đang giao hàng') {
                                                            $date = '(Ngày giao dự kiến: ' . $formattedDate . ')';
                                                        }
                                                    } elseif ($item['TrangThai'] == 'Đã giao hàng') {
                                                        $color = '#008000';
                                                    } else {
                                                        $color = '#cc0000';
                                                    }
                                                    if (isset($_SESSION['orderPaid'])) {
                                                        if ($item['MaHD'] == $_SESSION['orderPaid']) {
                                                            $colorPaid = '#008000';
                                                            echo "<h6 style='color:$color;'> " . $item['TrangThai'] . ' ' . $date . "<span style='color:$colorPaid;'> (Đã thanh toán)</span></h6>";
                                                        } else {
                                                            echo "<h6 style='color:$color;'> " . $item['TrangThai'] . ' ' . $date . '</h6>';
                                                        }
                                                    } else {
                                                        echo "<h6 style='color:$color;'> " . $item['TrangThai'] . ' ' . $date . '</h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            foreach ($purchasing_history[$key]['detail'] as $detailKey => $detailValue) {
                                                $total = $detailValue['product']['GiaBan'] * $detailValue['SoLuong'];
                                                $totalCounter += $total;
                                                $itemCounter += $detailValue['SoLuong'];
                                                ?>

                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('') }}assets/client/img/<?php echo $detailValue['product']['HinhAnh']; ?>"
                                                            class="img-fluid rounded-circle"
                                                            style="width: 80px; height: 80px; object-fit: contain;"
                                                            alt="">
                                                        <p class="mb-0">
                                                            <?php echo $detailValue['product']['TenHang']; ?>
                                                        </p>
                                                    </div>

                                                </th>
                                                <td>
                                                    <p class="mb-0 mt-4">
                                                        <?php echo number_format($detailValue['product']['GiaBan']); ?><sup><small>đ</small></sup>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 mt-4">
                                                        <?php echo $detailValue['product']['DVT']; ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <input type="text" value="<?php echo $detailValue['SoLuong']; ?>" disabled
                                                        class="mb-0 mt-4" size="5">
                                                </td>
                                                <td>
                                                    <p class="mb-0 mt-4">
                                                        <?php echo number_format($total); ?><sup><small>đ</small></sup>
                                                    </p>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <p class="mb-0 mt-2">
                                                        <strong>
                                                            <?php
                                                            echo $itemCounter . ' Sản Phẩm'; ?>
                                                        </strong>
                                                    </p>

                                                </td>
                                                <td>
                                                    <p class="mb-0 mt-2">
                                                        <strong>
                                                            <?php echo number_format($totalCounter); ?><sup><small>đ</small></sup>
                                                        </strong>
                                                    </p>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div> --}}
                                    <div class="tab-pane" id="nav-changepassword" role="tabpanel"
                                        aria-labelledby="nav-changepassword-tab">
                                        <div class="px-2">
                                            <div class="row g-4">
                                                <form class="col-6" action="" method="post">
                                                    <div
                                                        class="row align-items-center text-center justify-content-center py-2">
                                                        <div class="col-4">
                                                            <p class="mb-0">Mật khẩu cũ:</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input type="password" class="form-control mb-0"
                                                                name="oldpassword">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-4">
                                                            <p class="mb-0">Mật khẩu mới:</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input type="password" class="form-control mb-0"
                                                                name="newpassword">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-4">
                                                            <p class="mb-0">Nhập lại mật khẩu:</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <input type="password" class="form-control mb-0"
                                                                name="renewpassword" required>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="align-items-center text-center justify-content-center py-3">
                                                        <input type="submit" class="btn btn-primary"
                                                            name="btnChangePassword" value="Đổi mật khẩu" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
