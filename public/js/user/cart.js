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
                                <h5>$${item.price}</h5>
                            </div>
                        </td>
                        <td class="quantity__item">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="${item.quantity}">
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">${item.price * item.quantity}</td>
                        <td class="cart__close" style="cursor: pointer;"><span class="icon_close"></span></td>
                    </tr>
                `);

                totalPrice += item.price * item.quantity;
            });
        }
        $('#subtotal, #total').text('K ' + totalPrice);
    })();

    $('.cart__close').on('click', function () {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var price = parseInt(row.find('.cart__price').text().replace('K', ''));

        // Load the existing cart from localStorage
        var cart = JSON.parse(localStorage.getItem('cart_' + userId)) || [];

        // Filter out the item to be removed
        var updatedCart = cart.filter(item => item.id !== id);

        // Save the updated cart in localStorage
        localStorage.setItem('cart_' + userId, JSON.stringify(updatedCart));

        // Subtract the price from the total
        var $subtotal = $('#subtotal');
        var $total = $('#total');
        var newTotal = parseInt($total.text().replace('K', '')) - price;

        // Save update value in the header
        var oldTotal = parseInt($('#cart-total-price').text().replace('K', ''));
        oldTotal -= price;
        $('#cart-total-price').text('K ' + oldTotal);

        // Update the total in the HTML
        $subtotal.text('K ' + newTotal);
        $total.text('K ' + newTotal);

        // Find and remove of this product
        row.remove();

        // Check if there is no tr, then show message
        if ($('tr[data-id]').length == 0) {
            $('table').append('<tr><td class="text-danger">There is no product in cart.</td></tr>');
        }
    })

    $('#clear-cart-btn').on('click', function () {
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
        $('#subtotal').text('K 0');
        $('#total').text('K 0');

        // Save update value in the header
        $('#cart-total-price').text('K 0');
    })

    $('#checkout').on('click', function () {
        if ($('tbody tr[data-id]').length != 0) {
            window.location.href = '/checkout';
        }
    })
    console.log(localStorage.getItem('cart_guest'));
})