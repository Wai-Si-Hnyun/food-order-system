$(document).ready(function () {
    const userId = $('body').data('user-id');

    $('#reviewForm').on('submit', function (e) {
        e.preventDefault();

        var productId = $('#productId').val();
        var content = $('#content').val();

        var data = {
            userId,
            productId,
            content
        };

        axios.post('/review', data)
            .then(response => {
                Swal.fire({
                    title: 'Success',
                    text: 'Your review has been created',
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 3000
                });
                setTimeout(function () {
                    location.reload();
                }, 1000);
            })
            .catch(err => {
                if (err.response.status == 422) {
                    var contentName = document.getElementById('content');
                    contentName.innerHTML = content.value == '' ? '<i class="text-danger">' + err.response.data.errors.content[0] + '</i>' : '';
                }
            });
    })
})