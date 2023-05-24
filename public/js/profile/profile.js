const updateButton = document.getElementById("update-button");
const myDiv = document.getElementById("my-div");

updateButton.addEventListener("click", function() {
myDiv.classList.remove("d-none");
});


var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};
