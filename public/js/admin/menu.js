$(document).ready(function () {
    (function () {
        // Get the current URL path
        const currentPath = window.location.pathname;

        // Use a regular expression to find the route name in the URL
        const routeNameMatch = currentPath.match(/\/admin\/(\w+)/);

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

    window.handleFormSubmit = function(e) {
        e.preventDefault();
        $('#logoutForm').submit();
    }
})