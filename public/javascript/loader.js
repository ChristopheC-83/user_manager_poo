const overlay = document.querySelector(".overlay");
const loader = document.querySelector(".gearbox");
const btnForgotPassword = document.querySelector("#btnForgotPassword");
const btnRegistration = document.querySelector("#btnRegistration");

function activeLoader() {
  overlay.classList.remove("dnone");
  loader.classList.remove("dnone");
  setTimeout(() => {
    overlay.classList.add("dnone");
    loader.classList.add("dnone");
  }, 3000);
}
if (btnForgotPassword) {
  btnForgotPassword.addEventListener("click", () => {
    activeLoader();
  });
}
if (btnRegistration) {
  btnRegistration.addEventListener("click", () => {
    activeLoader();
  });
}
