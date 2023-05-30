

var userList = document.getElementsByClassName('userlist');
var productList = document.getElementsByClassName('productlist');
var commentList = document.getElementsByClassName('commentlist');
var actionList = document.getElementsByClassName('actionlist');
var idList = document.getElementsByClassName('idlist');
function deleteBtn(deleteId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then(res => {
        axios.delete(`/admin/reviews/${deleteId}/delete`)
            .then(response => {
                Swal.fire({
                    title: 'Success',
                    text: 'Review deleted successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 1500
                })
                
                $(`tr[data-id="${deleteId}"]`).remove();
                if ($('table tbody tr').length === 0) {
                    $('table').remove();
                    $('.container-xxl.flex-grow-1').append(`<h4 class="mt-5 text-center">No Review here!</h4>`);
                }

                $total = parseInt($('#totalReview').text());
                $('#totalReview').text($total - 1);
            })
            .catch(err => {
                console.log(err.response)
            });
    })
}
