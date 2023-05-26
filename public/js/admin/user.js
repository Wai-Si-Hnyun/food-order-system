function roleBtn(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
    }).then(res => {
        if (res.isConfirmed) {
            axios.put('/admin/user/' + userId, {
                role: 'admin',
            })
                .then(response => {
                    location.reload();
                })
                .catch(err => {
                    console.log(err.response)
                });
        }
    })

}

//roledelete
var nameList = document.getElementsByClassName('userlist');
var emailList = document.getElementsByClassName('mailList');
var roleList = document.getElementsByClassName('rolelist');
var action = document.getElementsByClassName('action');
var changeList = document.getElementsByClassName('changelist');
var idList = document.getElementsByClassName('idlist');

function deleteBtn(deleteId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
    }).then(res => {
        if (res.isConfirmed) {
            axios.delete('/admin/user-delete/' + deleteId)
                .then(response => {
                    console.log(response.data.userDelete.name);
                    for (var i = 0; i < nameList.length; i++) {
                        console.log(idList[i].innerHTML);
                        if (idList[i].innerHTML == response.data.userDelete.id) {
                            idList[i].style.display = 'none';
                            nameList[i].style.display = 'none';
                            roleList[i].style.display = 'none';
                            emailList[i].style.display = 'none';
                            action[i].style.display = 'none';
                            changeList[i].style.display = 'none';
                        }
                    }
                })
                .catch(err => {
                    console.log(err.response)
                });
        }
    })
}
