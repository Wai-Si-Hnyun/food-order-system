$(document).ready(function () {
    (function () {
        // Get the current URL path
        const currentPath = window.location.pathname;

        // Check if the current path is the root
        if (currentPath === '/') {
            $('#home').addClass('active');
            return;
        }

        // Use a regular expression to find the route name in the URL
        const routeNameMatch = currentPath.match(/\/(\w+)/);

        if (routeNameMatch) {
            const routeName = routeNameMatch[1];

            // Find the menu item with the matching id
            const activeMenuItem = $('#' + routeName);

            // If the menu item is found, add the 'active' class
            if (activeMenuItem.length) {
                $(activeMenuItem).addClass('active');
            }
        }
    })();

    function getCartTotal() {
        const userId = $('body').data('user-id');
        const cart = JSON.parse(localStorage.getItem('cart_' + userId)) || [];
        var totalPrice = 0;
        
        if (cart.length > 0) {
            cart.forEach(item => {
                totalPrice += item.price * item.quantity;
            });
    
            $('#cart-total-price').text(`${totalPrice} MMK`);
        }
    }
    getCartTotal();

    window.handleFormSubmit = function (e) {
        e.preventDefault();
        $('#logoutForm').submit();
    }
})