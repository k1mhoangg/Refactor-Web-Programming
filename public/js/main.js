// Khi người dùng cuộn xuống, header sẽ đổi màu nhẹ
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  if (window.scrollY > 50) {
    header.style.backgroundColor = "#111";
    header.style.boxShadow = "0 4px 12px rgba(0,0,0,0.5)";
  } else {
    header.style.backgroundColor = "#000";
    header.style.boxShadow = "0 2px 10px rgba(0,0,0,0.4)";
  }
});

// Hiệu ứng click vào icon tìm kiếm
const searchIcon = document.querySelector(".fa-search");
const searchInput = document.querySelector(".others input");

if (searchIcon && searchInput) {
  searchIcon.addEventListener("click", () => {
    searchInput.classList.toggle("show");
    searchInput.focus();
  });
}
