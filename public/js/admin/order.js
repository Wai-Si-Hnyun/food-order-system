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
            axios.delete(`/admin/order/${id}/delete`)
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
    $('.orderStatus').on('change',function (e) {
        e.preventDefault();

        $current = $(this).val();
        $orderId = $(this).closest('tr').data('id');

        $data = {
            'status': $current
        }

        axios.get(`/admin/order/${$orderId}/status/change`, {params: $data})
            .then((res) => {
                Swal.fire({
                    title: 'Success!',
                    text: res.data.message,
                    icon: 'success',
                })
            })
            .catch((err) => {
                console.log(err);
            })
    })
})