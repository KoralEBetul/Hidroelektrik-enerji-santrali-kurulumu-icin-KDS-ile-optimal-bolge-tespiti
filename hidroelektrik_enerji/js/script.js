const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      toggleSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

// Sayfa yüklendiğinde tema tercihini kontrol et
document.addEventListener("DOMContentLoaded", function() {
   const savedTheme = localStorage.getItem("theme");

   if (savedTheme) {
       body.classList.add(savedTheme);
       updateModeText(savedTheme);
   }
});

// Tema değiştirme işlemini gerçekleştiren fonksiyon
function toggleTheme() {
   body.classList.toggle("dark");

   const currentTheme = body.classList.contains("dark") ? "dark" : "light";
   localStorage.setItem("theme", currentTheme);

   updateModeText(currentTheme);
}

// Tema metnini güncelleyen fonksiyon
function updateModeText(theme) {
   modeText.innerText = theme === "dark" ? "Light Mode" : "Dark Mode";
}

// 'toggle' düğmesine ve 'toggleSwitch' düğmesine olay dinleyicisi ekle
toggle.addEventListener("click", function() {
   sidebar.classList.toggle("close");
});

toggleSwitch.addEventListener("click", function() {
   // Sadece toggleSwitch'e basıldığında tema değiştirme fonksiyonunu çağır
   toggleTheme();
});
  
searchBtn.addEventListener("click", function() {
   sidebar.classList.remove("close");
});
