const deleteOrder = (e, id) => {
    e.preventDefault();

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
            axios.delete(`/admin/orders/${id}/delete`)
                .then((res) => {
                    $(`table tbody tr[data-id="${id}"]`).remove();

                    if ($('table tbody tr').length === 0) {
                        const noOrderRow = $('<tr>').append($('<td>', { class: 'text-danger', text: 'There is no order.' }));
                        $('table tbody').append(noOrderRow);
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

        $data = {
            'status': $current
        }

        axios.get(`/admin/orders/${$orderId}/status/change`, { params: $data })
            .then((res) => {
                $('#successAlert').text(res.data.message);
                $('#successAlert').addClass('show');

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

        $data = {
            'status': $status
        };

        axios.get(`/admin/orders/${$orderId}/deivered/status/change`, { params: $data })
            .then((res) => {
                $('#successAlert').text(res.data.message);
                $('#successAlert').addClass('show');

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