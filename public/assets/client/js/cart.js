$(document).ready(function () {
    //update quantity in cart
    $(document).on('change', '.cart-quantity-single', function () {
        var id = $(this).data('id');
        var urlCart = $(this).data('url');
        var product_stock = $(this).data('stock');
        var quantity = $(this).val();
        if (quantity < 1) {
            quantity = 1;
            $(this).val(1);
            alert("Số lượng không thể nhỏ hơn 1.");
        } else if (quantity > product_stock) {
            quantity = product_stock;
            $(this).val(product_stock);
            alert("Số lượng không thể lớn hơn số lượng tồn.");
        }
        $.ajax({
            type: 'GET',
            url: urlCart + '/update-cart',
            dataType: 'json',
            data: { id: id, quantity: quantity },
            success: function (data) {
                if (data.msg == 'success') {
                    $.get(urlCart + '/cart-table', function (data) {
                        $('#cart-table-body').html(data);
                    })
                }
            },
        });

    });

    //remove item from cart
    $(document).on('click', '#accept-delete', function () {
        var urlCart = $(this).data('url');
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: urlCart + '/remove-from-cart/' + id,
            dataType: 'json',
            success: function (message) {
                if (message.msg == 'success') {
                    $('#deleteConfirmationModal').modal('hide');
                    $('.modal-backdrop').remove();

                    $.get(urlCart + '/cart-table', function (data) {
                        $('#cart-table-body').html(data);   
                    })

                    $.get(urlCart + '/cart-badge', function (data) {
                        $('#cart-badge').html(data);
                    });
                }
            }
        });
    });

    //add product to cart
    $(document).on('click', '.add-cart', function () {
        var urlCart = $(this).data('url');
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: urlCart + '/add-to-cart-ajax/' + id,
            dataType: 'json',
            success: function (message) {
                if (message.msg == 'success') {
                    $.get(urlCart + '/cart-badge', function (data) {
                        $('#cart-badge').html(data);

                        var toast = new bootstrap.Toast(document.querySelector('.toast'));
                        toast.show();
                    });

                }
            },
        });
    });
});
