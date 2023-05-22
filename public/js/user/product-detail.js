$(document).ready(function() {
    $('.add-to-cart-btn').on('click', function(e) {
        e.preventDefault();
        
        let parentDiv = $(this).parent('.product__details__option');

        let userId = $('body').data('user-id');
        let id = parentDiv.data('id');
        let name = parentDiv.data('name');
        let price = parseFloat(parentDiv.data('price'));
        let image = parentDiv.data('image');
        var quantity = $('.quantity .pro-qty .product-qty').val();

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
        var oldTotal = parseFloat($('#cart-total-price').text().replace('$', ''));
        oldTotal += price *quantity;
        $('#cart-total-price').text('$' + oldTotal.toFixed(2));

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