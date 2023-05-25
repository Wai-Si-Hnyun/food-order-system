$('.show_confirm').click(function(event) {
    event.preventDefault();

    var form = $(this).closest("form");

    var name = $(this).data("name");

    swal({

        title: ``,

        text: "Are you sure you want to delete this product?",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

        if (willDelete) {

            form.submit();

        }
    });

});