const deleteValidationModale = document.querySelector(
  ".deleteValidationModale"
);
const openModalDeleteAcount = document.querySelector("#openModalDeleteAcount");
const overlay = document.querySelector(".overlay");
const closeModalDeleteAcount = document.querySelector(
  "#closeModalDeleteAcount"
);

openModalDeleteAcount.addEventListener("click", () => {
  console.log("modale ?");
  deleteValidationModale.classList.remove("dnone");
  overlay.classList.remove("dnone");
});
overlay.addEventListener("click", () => {
  deleteValidationModale.classList.add("dnone");
  overlay.classList.add("dnone");
});
closeModalDeleteAcount.addEventListener("click", () => {
  deleteValidationModale.classList.add("dnone");
  overlay.classList.add("dnone");
});
