const modalContainer = document.querySelector(".modal-container");
const modalTrigger = document.querySelectorAll(".modal-trigger");
const modalContainer2 = document.querySelector(".modal-container2");
const modalTrigger2 = document.querySelectorAll(".modal-trigger2");
const deleteBtn = document.querySelector(".delete");

//variable pour l'édit :
const triggerEdit = document.querySelectorAll(".modal-trigger3");

let id = null;
/* let date = null;
let floor = null;
let position = null;
let price = null; */

modalTrigger.forEach((trigger) =>
  trigger.addEventListener("click", toggleModal)
);

modalTrigger2.forEach((trigger) =>
  trigger.addEventListener("click", () => {
    id = trigger.getAttribute("data-id");
    toggleModal2();
  })
);

deleteBtn.addEventListener("click", () => {
  goto("del");
});

triggerEdit.forEach((trigger) =>
  trigger.addEventListener("click", (e) => {
    let id = trigger.getAttribute("data-id");
    let date = document.querySelector(".date_" + id).value;
    let floor = document.querySelector(".stage_" + id).value;
    let position = document.querySelector(".position_" + id).value;
    let price = document.querySelector(".price_" + id).value.substring(0, 4);

    edit(id, date, floor, position, price);
  })
);

function toggleModal() {
  modalContainer.classList.toggle("active");
}
function toggleModal2() {
  modalContainer2.classList.toggle("active");
}

function goto(str) {
  if (str === "del") window.location.replace("del.php?id=" + id);
}

function edit(id, date, floor, position, price) {
  window.open(
    `edit.php?id=${id}&create_date=${date}&stage=${floor}&position=${position}&price=${price}`,
    "_blank"
  );
}
