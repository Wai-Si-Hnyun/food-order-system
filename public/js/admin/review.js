var userList = document.getElementsByClassName('userlist');
var productList = document.getElementsByClassName('productlist');
var commentList = document.getElementsByClassName('commentlist');
var actionList = document.getElementsByClassName('actionlist');
var idList = document.getElementsByClassName('idlist');
function deleteBtn(deleteId) {
    if (confirm('Sure to delete?')) {
        axios.delete('/admin/reviews/'+deleteId+'/delete')
          .then(response => {
            for (var i = 0; i < commentList.length; i++) {
                console.log(idList[i].innerHTML);
                if (idList[i].innerHTML == response.data.deletedReview.id) {
                    userList[i].style.display = 'none';
                    productList[i].style.display = 'none';
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
