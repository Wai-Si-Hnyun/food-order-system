$(document).ready(function () {
    $("#get-started").on("click", function () {
        $(this).parent().addClass("d-none");
        $("#questions").removeClass("d-none");
        $("#answer").html('<div class="alert alert-info" style="font-size: 14px">Get Started. Here are the questions you can ask:</div>');
    });

    $(".question").on("click", function () {
        // Toggle class
        $('.question').removeClass('active-question');
        $(this).addClass('active-question');

        const question = $(this).data("question");

        axios.post('/chat/get-answer', { question })
            .then(function (res) {
                var words = res.data.split(" ");
                var i = 0;
                $('#answer').html('<div class="alert alert-info fs-6" style="font-size: 14px" id="content"></div>');
                var intervalId = setInterval(function () {
                    if (i >= words.length) {
                        clearInterval(intervalId);
                    } else {
                        $("#content").append(words[i] + ' ');
                        i++;
                    }
                }, 50); // 500 milliseconds delay between words
            })
            .catch(function () {
                $("#answer").html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            });
    });

    $('.detail-view').on('click', function() {
        $id = $(this).data('id');

        window.location.href = '/products/' + $id + '/details';
    })

    // Reset modal to original state when it's hidden
    $("#chatbotModal").on("hidden.bs.modal", function () {
        $(".question").removeClass("active-question");
        $("#questions").addClass("d-none");
        $("#welcome").removeClass("d-none");
        $("#answer").html("");
    });
});