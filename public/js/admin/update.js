const updateBtn = document.getElementById("btnUpdate");
const form = document.getElementById("form");

btnUpdate.addEventListener("click", function() {
    form.classList.remove("d-none");
});


var loadFile = function(event) {
    var changeImg = document.getElementById('changeImg');
    changeImg.src = URL.createObjectURL(event.target.files[0]);
};