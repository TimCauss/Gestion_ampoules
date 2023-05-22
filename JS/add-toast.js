let x = document.getElementById("addToast");
x.classList.toggle("show");

setTimeout(function () {
  x.classList.remove("show");
}, 3000);
