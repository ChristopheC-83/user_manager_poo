const deleteValidationModale = document.querySelector(
  ".deleteValidationModale"
);
const openModalDeleteAcount = document.querySelector("#openModalDeleteAcount");
const overlay = document.querySelector(".overlay");
const closeModalDeleteAcount = document.querySelector(
  "#closeModalDeleteAcount"
);
if (openModalDeleteAcount) {
  openModalDeleteAcount.addEventListener("click", () => {
    console.log("modale ?");
    deleteValidationModale.classList.remove("dnone");
    overlay.classList.remove("dnone");
  });
}
if (overlay) {
  overlay.addEventListener("click", () => {
    deleteValidationModale.classList.add("dnone");
    overlay.classList.add("dnone");
  });
}
if (closeModalDeleteAcount) {
  closeModalDeleteAcount.addEventListener("click", () => {
    deleteValidationModale.classList.add("dnone");
    overlay.classList.add("dnone");
  });
}
