const modalContainer = document.querySelector(".modal-container");
const modalTrigger = document.querySelectorAll(".modal-trigger");
const modalContainer2 = document.querySelector(".modal-container2");
const modalTrigger2 = document.querySelectorAll(".modal-trigger2");
const deleteBtn = document.querySelector(".delete");

let id = null;

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

function toggleModal() {
  modalContainer.classList.toggle("active");
}
function toggleModal2() {
  modalContainer2.classList.toggle("active");
}

function goto(str) {
    if (str === "del") window.location.replace("del.php?id=" + id);

}
