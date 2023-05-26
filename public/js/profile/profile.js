const updateButton = document.getElementById("update-button");
const myDiv = document.getElementById("my-div");

updateButton.addEventListener("click", function() {
myDiv.classList.remove("d-none");
});

const profile = document.getElementById("profile");
var loadFile = function(event) {
    profile.classList.add("d-none");
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    profile.classList.add("d-none");
};
