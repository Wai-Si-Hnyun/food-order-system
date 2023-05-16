$(document).ready(function () {
    (function () {
        // Get the current URL path
        const currentPath = window.location.pathname;

        // Use a regular expression to find the route name in the URL
        const routeName = currentPath.match(/\/admin\/(\w+)/)[1];

        // Find the menu item with the matching id
        const activeMenuItem = $('#' + routeName);

        // If the menu item is found, add the 'active' class
        if (activeMenuItem.length) {
            $(activeMenuItem).addClass('active');
        }
    }) ();
})