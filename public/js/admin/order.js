const deleteOrder = (e, id) => {
    e.preventDefault();

    const orderDeleteUrl = window.routes.orderDeleteUrl.replace('__orderId__', id);

    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(orderDeleteUrl)
                .then((res) => {
                    Swal.fire({
                        title: 'Success',
                        text: 'Order deleted successfully!',
                        icon: 'success',
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer: 1500
                    })

                    $total = parseInt($('#totalOrder').text());
                    $('#totalOrder').text($total - 1);

                    $(`table tbody tr[data-id="${id}"]`).remove();

                    if ($('table tbody tr').length === 0) {
                        $('table').remove();
                        $('.container-xxl').append(`<h4 class="mt-5 text-center">No Order here!</h4>`);
                    }
                })
                .catch((err) => {
                    console.log(err);
                })
        }
    });
}

$(document).ready(function () {
    $('.orderStatus').on('change', function (e) {
        e.preventDefault();

        $current = $(this).val();
        $orderId = $(this).closest('tr').data('id');

        const orderStatusChgUrl = window.routes.orderStatusChgUrl.replace('__orderId__', $orderId);

        $data = {
            'status': $current
        }

        axios.get(orderStatusChgUrl, { params: $data })
            .then((res) => {
                Swal.fire({
                    title: 'Success',
                    text: 'Order status updated successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 1500
                })

                if ($current == 1) {
                    $("tr[data-id='" + $orderId + "'] #delivered").removeAttr('disabled');
                } else {
                    $("tr[data-id='" + $orderId + "'] #delivered").attr('disabled', true);
                }

                if ($current == 0 || $current == 1) {
                    $(this).attr('disabled', true);
                }

                // Hide the success alert
                setTimeout(function () {
                    $('#successAlert').removeClass('show');
                }, 2000); // Time in milliseconds (2 seconds)
            })
            .catch((e) => {
                console.log(e);
            })
    })

    $('.form-check-input').on('change', function (e) {
        e.preventDefault();

        $status = $(this).is(':checked') ? 1 : 0;
        $orderId = $(this).closest('tr').data('id');

        const orderDeliverStatusChgUrl = window.routes.orderDeliverStatusChgUrl.replace('__orderId__', $orderId);

        $data = {
            'status': $status
        };

        axios.get(orderDeliverStatusChgUrl, { params: $data })
            .then((res) => {
                Swal.fire({
                    title: 'Success',
                    text: 'Order deliverd!',
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 1500
                })

                if ($status == 1) {
                    $(this).attr('disabled', true);
                }

                // Hide the success alert
                setTimeout(function () {
                    $('#successAlert').removeClass('show');
                }, 2000);
            })
            .catch((err) => {
                console.log(err);
            })
    })
})