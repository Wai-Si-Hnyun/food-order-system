$(document).ready(function() {
    $('#feedbackForm').on('submit', function(e) {
        e.preventDefault();

        const feedbackCreateUrl = window.routes.feedbackCreateUrl;
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();

        // clear error message
        $('small').text('');

        var data = {
            name,
            email,
            message
        }

        axios.post(feedbackCreateUrl, data)
            .then(res => {
                Swal.fire({
                    title: 'Success',
                    text: 'Your feeback has been submitted',
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 2000
                });
            })
            .catch(err => {
                if (err.response.status == 422) {
                    let errors = err.response.data.errors;

                    for (let field in errors) {
                        let htmlNode = $(`#${field}`).siblings('small');
                        if (htmlNode.length) {
                            htmlNode.text(errors[field]);
                        }
                    }
                }
            })
    })
})