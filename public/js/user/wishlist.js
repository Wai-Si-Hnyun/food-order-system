$(document).ready(function () {
    $('.icon_close').on('click', function (e) {
        e.preventDefault();

        const id = parseInt($(this).closest('tr').data('id'));
        const deleteWishlistByIdUrl = window.routes.deleteWishlistByIdUrl
            .replace('__id__', id);

        Swal.fire({
            title: 'Are you sure to remove?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then(res => {
            if (res.isConfirmed) {
                axios.delete(deleteWishlistByIdUrl)
                    .then(res => {
                        $(this).closest('tr').remove();

                        if ($('tr[data-id').length == 0) {
                            $('.wishlist .row').empty();
                            $('.wishlist .container').append(' <h4 class="text-danger text-center py-5 my-5">User have no favorite product.</h4>');
                        }

                        $count = parseInt($('#wishlistCount').text()) - 1;
                        $('#wishlistCount').text($count);
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        })
    })

    $('.add-to-cart-btn').on('click', function (e) {
        e.preventDefault();

        const wishlistId = parseInt($(this).closest('tr').data('id'));
        const deleteWishlistByIdUrl = window.routes.deleteWishlistByIdUrl
            .replace('__id__', wishlistId);

        axios.delete(deleteWishlistByIdUrl)
            .then(res => {
                $(this).closest('tr').remove();

                if ($('tr[data-id').length == 0) {
                    $('.wishlist .row').empty();
                    $('.wishlist .container').append(' <h4 class="text-danger text-center py-5 my-5">User have no favorite product.</h4>');
                }

                $count = parseInt($('#wishlistCount').text()) - 1;
                $('#wishlistCount').text($count);
            })
            .catch(err => {
                console.log(err);
            })
    })
})