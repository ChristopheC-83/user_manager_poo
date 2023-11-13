// Menu responsive

const header = document.querySelector("header");
const overlayMenu = document.querySelector(".overlay");
const arrow_btn = document.querySelector(".arrow_btn");

if (arrow_btn) {
  arrow_btn.addEventListener("click", () => {
    arrow_btn.classList.toggle("arrow_btn_return");
    header.classList.toggle("header_open");
    overlayMenu.classList.toggle("dnone");
  });
}
if (overlayMenu) {
  overlayMenu.addEventListener("click", () => {
    arrow_btn.classList.toggle("arrow_btn_return");
    header.classList.toggle("header_open");
    overlayMenu.classList.add("dnone");
  });
}
