$(document).ready(function () {
    $(document).on('click', '.add-to-cart-btn', function (e) {
        e.preventDefault();

        let parentDiv = $(this).parent('.cart_add');

        let userId = $('body').data('user-id');
        let id = parentDiv.data('id');
        let name = parentDiv.data('name');
        let price = parseInt(parentDiv.data('price'));
        let image = parentDiv.data('image');
        let quantity = parseInt(parentDiv.data('quantity'));

        // Load the existing cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart_' + userId)) || [];

        // Find the item in the cart
        let item = cart.find(item => item.id === id);

        if (item) {
            item.quantity += quantity;
        } else {
            item = {
                id,
                name,
                price,
                image,
                quantity
            };
            cart.push(item);
        }

        // Save the updated cart in localStorage
        localStorage.setItem('cart_' + userId, JSON.stringify(cart));

        // Save update value in the header
        var oldTotal = parseInt($('#cart-total-price').text().replace('MMK', ''));
        oldTotal += price *quantity;
        $('#cart-total-price').text(oldTotal + ' MMK');

        // Show alert of success
        Swal.fire({
            title: 'Added to cart',
            text: 'You can view your cart in the top right corner',
            icon: 'success',
            showConfirmButton: false,
            showCancelButton: false,
            timer: 2500
        });
    })
})