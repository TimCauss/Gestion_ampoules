/* function Toasty(clicked_id) {
    if(clicked_id == "suppr") {
       let x = document.getElementById("supprToast");
       x.classList.toggle("show");
       setTimeout(function(){ x.classList.remove("show");}, 3000);
    }
} */

const decoBtnElem = document.querySelector(".login-ctn");
const decoCtnElem = document.querySelector(".disconnect-session");

decoBtnElem.addEventListener("click", () => {
  decoCtnElem.classList.toggle("disc-show");
  setTimeout(function () {
    decoCtnElem.classList.remove("disc-show");
  }, 1500);
});
