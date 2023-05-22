function EditToast() {
  let x = document.getElementById("editToast");
  x.classList.toggle("show");

  setTimeout(function () {
    x.classList.remove("show");
  }, 3000);
}
