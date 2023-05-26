var reviewForm = document.forms['reviewForm'];
var userId = reviewForm['userId'];
var productId = reviewForm['productId'];
var content = reviewForm['content'];

reviewForm.onsubmit = function(e) {
    e.preventDefault();
    axios.post('/review',{
        userId : userId.value,
        productId : productId.value,
        content :content.value,
    })
    .then(response => {
        console.log(response.data.msg);
        if (response.data.msg == 'success') {
            Swal.fire({
            title: 'Success',
            text: 'Your review has been created',
            icon: 'success',
            showConfirmButton: false,
            showCancelButton: false,
            timer: 3000
            });
            setTimeout(function() {
                location.reload();
            }, 1000);

        }
        else {
            var contentName = document.getElementById('content');
            contentName.innerHTML = content.value == '' ? '<i class="text-danger">'+response.data.msg.content+'</i>': '';
        }
    })
    .catch(err => {
        console.log(err.response)
    });
}

       var nameList = document.getElementsByClassName('namelist');
       var commentList = document.getElementsByClassName('commentlist');
       var actionList = document.getElementsByClassName('actionlist');
       var idList = document.getElementsByClassName('idlist');
       function deleteBtn(deleteId) {
       if (confirm('Sure to delete?')) {
           axios.delete('/review-delete/'+deleteId)
             .then(response => {
               console.log(response.data.deletedReview.comment);
               for (var i = 0; i < commentList.length; i++) {
                   console.log(idList[i].innerHTML);
                   if (idList[i].innerHTML == response.data.deletedReview.id) {
                       nameList[i].style.display = 'none';
                       commentList[i].style.display = 'none';
                       actionList[i].style.display = 'none';
                       idList[i].style.display = 'none';
                   }
               }
             })
             .catch(err => {
               console.log(err.response)
           });

       }
   }
