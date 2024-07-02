$(document).ready(function () {
    $('.toast').toast();
    //update
    $(document).on('change', '.cart-qty-single', function () {
        var getItemID = $(this).data('item-id');
        var urlBase = $(this).data('url-base');
        var product_qty = $(this).data('item-qty');
        var qty = $(this).val();
        if (qty < 1) {
            qty = 1;
            $(this).val(1);
            alert("Số lượng không thể nhỏ hơn 1.");
        } else if (qty > product_qty) {
            qty = product_qty;
            $(this).val(product_qty);
            alert("Số lượng không thể lớn hơn số lượng tồn.");
        }
        $.ajax({
            type: 'POST',
            url: urlBase + '/cart/ajaxCalls',
            dataType: 'json',
            data: { action: 'update-qty', itemID: getItemID, qty: qty },
            success: function (data) {
                if (data.msg == 'success') {
                    $.post(urlBase + '/cart/tableCart', function (data) {
                        $('#order').html(data);
                    })
                }
            },
        });

    });

    // remove all
    $('#emptyCart').click(function () {
        var urlBase = $(this).data('url-base');
        $.ajax({
            type: 'POST',
            url: urlBase + '/cart/ajaxCalls',
            dataType: 'json',
            data: { action: 'empty', empty_cart: true },
            success: function (data) {
                if (data.msg == 'success') {
                    window.location.href = urlBase + '/product';
                }
            }
        });
    });

    //remove
    $(document).on('click', '.remove-cart', function () {
        var getItemID = $(this).data('item-id');
        var urlBase = $(this).data('url-base');
        if (confirm("Bạn có đồng ý xóa sản phẩm hay không?")) {
            $.ajax({
                type: 'POST',
                url: urlBase + '/cart/ajaxCalls',
                dataType: 'json',
                data: { action: 'remove', itemID: getItemID },
                success: function (data) {
                    if (data.msg == 'success') {
                        $.post(urlBase + '/cart/tableCart', function (data) {
                            $('#order').html(data);
                        })
                    }
                }
            });
        }
    });

    //add
    $(document).on('click', '.add-cart', function () {
        var productID = $(this).data('product-id');
        var urlBase = $(this).data('url-base');
        var qty = $(this).data('product-qty');
        var productDVT = $(this).data('product-dvt');
        var productPrice = $(this).data('product-price');
        var productName = $(this).data('product-name');
        var productImg = $(this).data('product-img');
        var productQty = $(this).data('product-quantity');

        $.ajax({
            type: 'POST',
            url: urlBase + '/cart/ajaxCalls',
            dataType: 'json',
            data: {
                action: 'add',
                productID: productID,
                qty: qty,
                productQty: productQty,
                productDVT: productDVT,
                productPrice: productPrice,
                productName: productName,
                productImg: productImg
            },
            success: function (message) {
                if (message.msg == 'success') {
                    $.post(urlBase + '/product/cartQuantity', function (data) {

                        $('#cart-quantity').html(data);

                        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
                        var toastList = toastElList.map(function (toastEl) {
                            return new bootstrap.Toast(toastEl)
                        });
                        toastList.forEach(toast => toast.show());
                    });
                }
            },
        });
    });
});
