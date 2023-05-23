       //reviews edit
       var reviewEditForm = document.forms['reviewEditForm'];
       var reviewId = reviewEditForm['reviewId'];
       var reviewComment = reviewEditForm['comment'];
       function reviewEditBtn(editId) {
                   axios.get('/review/'+editId+'/edit')
                        .then(response => {
                           reviewId.value = response.data.id;
                           reviewComment.value = response.data.comment;
                        })
                        .catch(err => {
                       console.log(err.response)
                   });
       }
   
           // reviews update
   
           reviewEditForm.onsubmit = function(e) {
           e.preventDefault();
           axios.put('/review/'+reviewId.value,{
               comment: reviewComment.value,
           })
               .then(response => {
                   location.reload();
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