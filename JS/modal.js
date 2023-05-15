const modalContainer = document.querySelector(".modal-container");
const modalTrigger = document.querySelectorAll(".modal-trigger");
const modalContainer2 = document.querySelector(".modal-container2")
const modalTrigger2 = document.querySelectorAll(".modal-trigger2")

modalTrigger.forEach((trigger) =>
    trigger.addEventListener("click", toggleModal)
);
modalTrigger2.forEach(trigger =>
    trigger.addEventListener("click", toggleModal2)
);

function toggleModal() {
    modalContainer.classList.toggle("active");
}
function toggleModal2() {
    modalContainer2.classList.toggle("active")
}