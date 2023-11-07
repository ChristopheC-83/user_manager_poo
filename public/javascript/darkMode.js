const darkModeBtn = document.querySelector("#darkMode");
const isDarkModeStored = localStorage.getItem("darkMode");
let stateDarkMode = isDarkModeStored;

function setUpDarkMode(bool) {
  if (bool) {
    document.body.classList.add("darkMode");
  } else {
    document.body.classList.remove("darkMode");
  }
  stateDarkMode = bool;
  darkModeBtn.checked = bool;
}

if (isDarkModeStored != null) {
  if (isDarkModeStored === "true") {
    setUpDarkMode(true);
    colorGoingDark()
  } else {
    setUpDarkMode(false);
    colorGoingLight();
  }
} else {
  localStorage.setItem("darkMode", false);
  setUpDarkMode(false);
}

function toggleDarkMode() {
  document.body.classList.toggle("darkMode");
  stateDarkMode = !stateDarkMode;
  localStorage.setItem("darkMode", stateDarkMode);
  darkModeBtn.checked = stateDarkMode;
  if (stateDarkMode) {
    colorGoingDark()
  } else {
    colorGoingLight()
  }
}

darkModeBtn.addEventListener("change", toggleDarkMode);

function colorGoingDark() {
  document.documentElement.style.setProperty("--bg_1", "#181118");
  document.documentElement.style.setProperty("--bg_2", "#201320");
  document.documentElement.style.setProperty("--components_1", "#351a35");
  document.documentElement.style.setProperty("--components_2", "#451d47");
  document.documentElement.style.setProperty("--components_3", "#512454");
  document.documentElement.style.setProperty("--border_1", "#5e3061");
  document.documentElement.style.setProperty("--border_2", "#734079");
  document.documentElement.style.setProperty("--border_3", "#92549c");
  document.documentElement.style.setProperty("--solid_1", "#ab4aba");
  document.documentElement.style.setProperty("--solid_2", "#b658c4");
  document.documentElement.style.setProperty("--text_1", "#e796f3");
  document.documentElement.style.setProperty("--text_2", "#FEFCFF");
  document.documentElement.style.setProperty("--overlay", "#f1f1f190");
  document.documentElement.style.setProperty("--shadow_1", "#f1f1f1");
}
function colorGoingLight() {
  document.documentElement.style.setProperty("--bg_1", "#FEFCFF");
  document.documentElement.style.setProperty("--bg_2", "#FDF7FD");
  document.documentElement.style.setProperty("--components_1", "#fbebfb");
  document.documentElement.style.setProperty("--components_2", "#f7def8");
  document.documentElement.style.setProperty("--components_3", "#f2d1f3");
  document.documentElement.style.setProperty("--border_1", "#e9c2ec");
  document.documentElement.style.setProperty("--border_2", "#deade3");
  document.documentElement.style.setProperty("--border_3", "#cf91d8");
  document.documentElement.style.setProperty("--solid_1", "#ab4aba");
  document.documentElement.style.setProperty("--solid_2", "#a144af");
  document.documentElement.style.setProperty("--text_1", "#953ea3");
  document.documentElement.style.setProperty("--text_2", "#53195d");
  document.documentElement.style.setProperty("--overlay", "#33333390");
  document.documentElement.style.setProperty("--shadow_1", "#333333");
}
