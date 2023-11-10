const new_password = document.querySelector("#new_password");
const verif_password = document.querySelector("#verif_password");
const btnValidationPassword = document.querySelector("#btnValidationPassword");
const erreurPassword = document.querySelector(".erreurPassword");

function verifySamePassword() {
  if (new_password.value === verif_password.value && new_password.value != "") {
    btnValidationPassword.classList.remove("disabled");
    erreurPassword.classList.add("blind");
  } else {
    btnValidationPassword.classList.add("disabled");
    erreurPassword.classList.remove("blind");
  }
}

new_password.addEventListener("keyup", () => {
  verifySamePassword();
});
verif_password.addEventListener("keyup", () => {
  verifySamePassword();
});
