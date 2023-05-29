$(document).ready(function () {

    if (isWishlist) {
        $('#add-to-wishlist').addClass('active');
    } else {
        $('#add-to-wishlist').removeClass('active');
    }

    $('#add-to-wishlist').on('click', function (e) {
        e.preventDefault();

        const user_id = $('body').data('user-id');
        const product_id = $(this).data('product-id');

        const storeWishlistUrl = window.routes.storeWishlistUrl;
        const deleteWishlistUrl = window.routes.deleteWishlistUrl
            .replace('__productId__', product_id);

        const data = {
            user_id,
            product_id
        }

        if (isWishlist) {
            $(this).removeClass('active');
            isWishlist = false;

            axios.delete(deleteWishlistUrl)
                .then(res => {
                    Swal.fire({
                        title: 'Removed from favorite',
                        text: 'You can view your favorite in the top right corner',
                        icon: 'success',
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 2500
                    })
                })
                .catch(err => {
                    console.log(err.response);
                })
        } else {
            $(this).addClass('active');
            isWishlist = true;

            axios.post(storeWishlistUrl, data)
                .then(res => {
                    Swal.fire({
                        title: 'Added to favorite',
                        text: 'You can view your favorite in the top right corner',
                        icon: 'success',
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 2500
                    })
                })
                .catch(err => {
                    console.log(err.response);
                })
        }
    })

    $('.add-to-cart-btn-detail').on('click', function (e) {
        e.preventDefault();

        let parentDiv = $(this).parent('.product__details__option');

        let userId = $('body').data('user-id');
        let id = parentDiv.data('id');
        let name = parentDiv.data('name');
        let price = parseInt(parentDiv.data('price'));
        let image = parentDiv.data('image');
        var quantity = parseInt($('.quantity .pro-qty .product-qty').val());
        console.log(quantity);

        if (quantity > 0) {
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
            var oldTotal = parseFloat($('#cart-total-price').text().replace('MMK', ''));
            oldTotal += price * quantity;
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
        } else {
            Swal.fire({
                title: 'Process Failed',
                text: 'Invalid Quantity',
                icon: 'error',
                showConfirmButton: false,
                showCancelButton: false,
                timer: 1500
            });
        }
    })

    $('.detail-view').on('click', function () {
        $id = $(this).data('id');

        window.location.href = '/products/' + $id + '/details';
    })
})