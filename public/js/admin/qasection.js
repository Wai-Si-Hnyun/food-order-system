$(document).ready(function () {
    $('.delete').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id');

        const qaDeleteUrl = window.routes.qaDeleteUrl.replace('__qaId__', id);

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
                axios.delete(qaDeleteUrl)
                    .then((res) => {
                        $(`#qa-${id}`).remove();
                        $('#success').html(`<div class="alert alert-danger w-50" role="alert">${res.data.success}</div>`);
                        if ($('.qa-card').length == 0) {
                            $('.row.mb-5').append(`<h4 class="mt-5 text-center">No Question and Answer here!</h4>`);
                        }

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