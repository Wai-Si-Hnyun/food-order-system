$(document).ready(function () {
    $('.delete').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/admin/questions-and-answers/${id}/delete`)
                    .then((res) => {
                        $(`#qa-${id}`).remove();
                        $('#success').html(`<div class="alert alert-success w-50" role="alert">${res.data.success}</div>`);

                        // Remove the success message after 2 seconds
                        setTimeout(function () {
                            $('#success').empty();
                        }, 2000);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            }
        })
    })
});