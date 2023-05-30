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
                        Swal.fire({
                            title: 'Success',
                            text: 'Q&A deleted successfully!',
                            icon: 'success',
                            showConfirmButton: false,
                            showCancelButton: false,
                            timer: 1500
                        })

                        if ($('.qa-card').length == 0) {
                            $('.row.mb-5').append(`<h4 class="mt-5 text-center">No Question and Answer here!</h4>`);
                        }

                        $total = parseInt($('#totalQA').text());
                        $('#totalQA').text($total - 1);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            }
        })
    })
});