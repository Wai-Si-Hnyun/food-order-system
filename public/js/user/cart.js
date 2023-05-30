$(document).ready(function () {
    // login user id
    const userId = $('body').data('user-id');

    // Show items in cart
    (function () {
        var cart = JSON.parse(localStorage.getItem('cart_' + userId)) || [];

        var totalPrice = 0;

        if (cart.length === 0) {
            $('table tbody').append('<tr><td class="text-danger">There is no product in cart.</td></tr>');
        } else {
            cart.forEach(item => {
                $('table tbody').append(`
                    <tr data-id="${item.id}">
                        <td class="product__cart__item">
                            <div class="product__cart__item__pic">
                                <img src="/storage/${item.image}"
                                    alt="${item.name}" width="90px" height="90px">
                            </div>
                            <div class="product__cart__item__text">
                                <h6>${item.name}</h6>
                                <h5>${item.price}MMK</h5>
                            </div>
                        </td>
                        <td class="quantity__item">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" class="product_qty" value="${item.quantity}" disable>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">${item.price * item.quantity}</td>
                        <td class="cart__close" style="cursor: pointer;"><span class="icon_close"></span></td>
                    </tr>
                `);

                totalPrice += item.price * item.quantity;
            });
            var proQty = $('.pro-qty');
            proQty.prepend('<span class="dec qtybtn dec-btn">-</span>');
            proQty.append('<span class="inc qtybtn inc-btn">+</span>');
            proQty.on('click', '.qtybtn', function () {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below one
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                    }
                }
                $button.parent().find('input').val(newVal);
            });
        }
        $('#subtotal, #total').text(totalPrice);
    })();

    $('.pro-qty').on('click', '.qtybtn', function (e) {
        e.preventDefault();

        var row = $(this).closest('tr');
        var product_id = row.data('id');
        var updateQty = parseInt(row.find('.product_qty').val());

        // Update localStorage
        var cart = JSON.parse(localStorage.getItem('cart_' + userId));
        var product = cart.find(item => item.id === product_id);
        if (product) {
            product.quantity = updateQty;
        }

        localStorage.setItem('cart_' + userId, JSON.stringify(cart));

        var price = product.price;
        var updatePrice = price * updateQty;

        // Update subtotal and total
        var total = parseInt($('#total').text());
        var currentProductTotal = parseInt(row.find('.cart__price').text());
        var updateTotal = (total - currentProductTotal) + updatePrice;
        $('#subtotal, #total').text(updateTotal);

        // Change product total
        row.find('.cart__price').text(updatePrice);

        // Update the header total
        $('#cart-total-price').text(updateTotal + ' MMK');
    })

    $('.cart__close').on('click', function () {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var price = parseInt(row.find('.cart__price').text());

        // Load the existing cart from localStorage
        var cart = JSON.parse(localStorage.getItem('cart_' + userId)) || [];

        // Filter out the item to be removed
        var updatedCart = cart.filter(item => item.id !== id);

        // Save the updated cart in localStorage
        localStorage.setItem('cart_' + userId, JSON.stringify(updatedCart));

        // Subtract the price from the total
        var $subtotal = $('#subtotal');
        var $total = $('#total');
        var newTotal = parseInt($total.text()) - price;

        // Save update value in the header
        var oldTotal = parseInt($('#cart-total-price').text().replace('MMK', ''));
        oldTotal -= price;
        $('#cart-total-price').text(oldTotal + 'MMK');

        // Update the total in the HTML
        $subtotal.text(newTotal);
        $total.text(newTotal);

        // Find and remove of this product
        row.remove();

        // Check if there is no tr, then show message
        if ($('tr[data-id]').length == 0) {
            $('table').append('<tr id="no-product"><td class="text-danger">There is no product in cart.</td></tr>');
        }
    })

    $('#clear-cart-btn').on('click', function () {
        if ($('table tbody tr[data-id').length !== 0) {
            localStorage.removeItem('cart_' + userId);

            Swal.fire({
                title: 'Success',
                text: 'Cart is cleared',
                icon: 'success',
                showConfirmButton: false,
                showCancelButton: false,
                timer: 1800
            })

            // Remove all products
            $('table tbody tr[data-id]').remove();

            // Add no product text
            $('table').append('<tr><td class="text-danger">There is no product in cart.</td></tr>');

            // Set the total values to 0
            $('#subtotal').text('0');
            $('#total').text('0');

            // Save update value in the header
            $('#cart-total-price').text('0 MMK');
        }
    })

    $('#checkout').on('click', function () {
        if ($('tbody tr[data-id]').length != 0) {
            window.location.href = '/checkout';
        }
    })
})