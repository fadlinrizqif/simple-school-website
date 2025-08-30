const imageHome = document.querySelector(".hero-section");

// menyimpan path image ke dalam array
const imageArr = [
  "assets/img/2149661462.jpg",
  "assets/img/2150911441.jpg",
  "assets/img/5729.jpg"
];

let currentIndex = 0;


// fungsi untuk membuat image berganti
function imageslide() {
  currentIndex++;
  if (currentIndex >= imageArr.length) {
    currentIndex = 0;
  }
  imageHome.style.backgroundImage = `url(${imageArr[currentIndex]})`;
}

// menggunakan setInterval agar fungsi dipanggail 4 detik sekali
setInterval(imageslide, 4000);
