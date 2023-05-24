$('.show_confirm').click(function(event) {

    var form = $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: ``,

        text: "Are you sure you want to delete this category?",

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