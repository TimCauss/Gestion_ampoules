let x = document.getElementById("supprToast");
x.classList.toggle("show");

setTimeout(function () {
  x.classList.remove("show");
}, 3000);
