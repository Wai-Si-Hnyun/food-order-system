$(document).ready(function() {
    // Reset modal to original state when it's hidden
    $("#chatbotModal").on("hidden.bs.modal", function () {
        $(".question").removeClass("active-question");
        $("#questions").addClass("d-none");
        $("#welcome").removeClass("d-none");
        $("#answer").html("");
    });
})