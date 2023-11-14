// Menu responsive

export const overlay = document.querySelector(".overlay");
const header = document.querySelector("header");
const arrow_btn = document.querySelector(".arrow_btn");

if (arrow_btn) {
  arrow_btn.addEventListener("click", () => {
    arrow_btn.classList.toggle("arrow_btn_return");
    header.classList.toggle("header_open");
    overlay.classList.toggle("dnone");
  });
}
if (overlay) {
  overlay.addEventListener("click", () => {
    arrow_btn.classList.remove("arrow_btn_return");
    header.classList.remove("header_open");
    overlay.classList.add("dnone");
  });
}
