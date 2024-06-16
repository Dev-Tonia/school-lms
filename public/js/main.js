const sidebar = document.querySelector("aside");
const menu = document.querySelector(".menu");
const sidebarBackdrop = document.getElementById("sidebarBackdrop");
const sideUnderlay = document.querySelector(".sideUnderlay");

let w = window.innerWidth;

menu.addEventListener("click", () => {
  if (w > 767) {
    sidebar.classList.toggle("invisible");
    sideUnderlay.classList.toggle("d-md-block");
  }
  toggleMobileSidebar();
});
function toggleMobileSidebar() {
  if (w < 768) {
    sidebar.classList.toggle("d-none");
    sidebarBackdrop.classList.toggle("d-none");
  }
}
sidebarBackdrop.addEventListener("click", toggleMobileSidebar);
