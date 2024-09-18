const formOpenBtn = document.querySelector("#form-open"),
beranda = document.querySelector(".beranda"),
formContainer = document.querySelector(".form_container"),
formCloseBtn = document.querySelector(".form_close"),
daftarBtn = document.querySelector("#daftar"),
loginBtn = document.querySelector("#login"),
pwShowHide = document.querySelector(".pw-hide");

formOpenBtn.addEventListener("click", () => beranda.classList.add("show"))
formCloseBtn.addEventListener("click", () => beranda.classList.remove("show"))