const decoBtnElem = document.querySelector(".login-ctn");
const decoCtnElem = document.querySelector(".disconnect-session");

decoBtnElem.addEventListener("click", () => {
  decoCtnElem.classList.toggle("disc-show");
  setTimeout(function () {
    decoCtnElem.classList.remove("disc-show");
  }, 1500);
});
