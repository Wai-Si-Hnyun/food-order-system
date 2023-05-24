$('.show_confirm').click(function(event) {
    event.preventDefault();
    
    var form = $(this).closest("form");

    var name = $(this).data("name");

    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
    }).then((res) => {
        if (res.isConfirmed) {
            form.submit();
        }
    });

});