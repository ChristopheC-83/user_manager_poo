const overlay = document.querySelector(".overlay");
const loader = document.querySelector(".gearbox");
const btnForgotPassword = document.querySelector("#btnForgotPassword");
const btnRegistration = document.querySelector("#btnRegistration");

function activeLoader(fichier_php) {
  overlay.classList.remove("dnone");
  loader.classList.remove("dnone");
  fetch(fichier_php)
    .then((response) => {
      if (!response.ok) throw new Error("Erreur : mauvaise ressource.");
      return response.json();
    })
    .then((response) => {
      overlay.classList.add("dnone");
      loader.classList.add("dnone");
      return;
    })
    .catch((e) => {
      console.log(e);
    });
}

if (btnForgotPassword) {
  btnForgotPassword.addEventListener("click", () => {
    activeLoader("user.controller.php");
  });
}
if (btnRegistration) {
  btnRegistration.addEventListener("click", () => {
    activeLoader("visitor.controller.php");
  });
}
