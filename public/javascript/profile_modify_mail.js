const btnModifyMail = document.querySelector("#btnModifyMail");
const formModifyMail = document.querySelector("#formModifyMail");
const blockModifyMail = document.querySelector("#blockModifyMail");
const btnModifyName = document.querySelector("#btnModifyMail");
const formModifyName = document.querySelector("#formModifyMail");
const blockModifyName = document.querySelector("#blockModifyMail");

// function showBlock() {
//   blockModifyMail.classList.add("bigBlock");
//   setTimeout(() => {
//     formModifyMail.classList.remove("dnone");
//     formModifyMail.classList.add("decompressed");
//   }, 333);
// }

// function hideBlock() {
//   formModifyMail.classList.add("compressed");
//   setTimeout(() => {
//     blockModifyMail.classList.remove("bigBlock");
//     formModifyMail.classList.add("dnone");
//     formModifyMail.classList.remove("decompressed");
//     formModifyMail.classList.remove("compressed");
//   }, 333);
// }
function showBlock(form, block) {
  block.classList.add("bigBlock");
  setTimeout(() => {
    form.classList.remove("dnone");
    form.classList.add("decompressed");
  }, 333);
}

function hideBlock(form, block) {
  form.classList.add("compressed");
  setTimeout(() => {
    block.classList.remove("bigBlock");
    form.classList.add("dnone");
    form.classList.remove("decompressed");
    form.classList.remove("compressed");
  }, 333);
}

btnModifyMail.addEventListener("click", function () {
  if (formModifyMail.classList.contains("dnone")) {
    showBlock(formModifyMail, blockModifyMail);
  } else {
    hideBlock(formModifyMail, blockModifyMail);
  }
});

btnModifyName.addEventListener("click", function () {
  if (formModifyName.classList.contains("dnone")) {
    showBlock(formModifyName, blockModifyName);
  } else {
    hideBlock(formModifyName, blockModifyName);
  }
});
