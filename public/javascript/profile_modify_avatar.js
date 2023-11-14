//modale changement image par image site
const btn_modif_img_site = document.querySelector("#btn_modif_img_site");
const images_site = document.querySelector(".images_site");
import { overlay} from './menu_responsive.js';

if (btn_modif_img_site) {
  btn_modif_img_site.addEventListener("click", () => {
    images_site.classList.remove("dnone");
    overlay.classList.remove("dnone");
  });
}
if (images_site) {
  images_site.addEventListener("click", () => {
    images_site.classList.add("dnone");
    overlay.classList.add("dnone");
  });
}
if (overlay) {
  overlay.addEventListener("click", () => {
    images_site.classList.add("dnone");
    overlay.classList.add("dnone");
  });
}
