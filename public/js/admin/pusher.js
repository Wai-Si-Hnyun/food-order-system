// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('b59d0312a77bca50d283', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('noti-channel');
channel.bind('order-create', function(data) {
    Swal.fire({
        title: 'New Order Created',
        text: 'A new order has been placed by the customer.',
        footer: '<a href="/admin/orders">View Order Details</a>',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
    })
});