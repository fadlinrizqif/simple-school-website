const imageHome = document.querySelector(".hero-section");

const imageArr = [
  "assets/img/2149661462.jpg",
  "assets/img/2150911441.jpg",
  "assets/img/5729.jpg"
];

let currentIndex = 0;

function imageslide() {
  currentIndex++;
  if (currentIndex >= imageArr.length) {
    currentIndex = 0;
  }
  imageHome.style.backgroundImage = `url(${imageArr[currentIndex]})`;
}

setInterval(imageslide, 4000);
