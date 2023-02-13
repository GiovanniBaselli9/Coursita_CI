var slideIndex = 0;
var slides = document.querySelectorAll("#slider img");
var captions = document.querySelectorAll("#slider .caption");
var totalSlides = slides.length;
var intervalId;

function showSlide(slideIndex) {
  for (var i = 0; i < totalSlides; i++) {
    slides[i].classList.remove("active");
    captions[i].style.display = "none";
  }
  slides[slideIndex].classList.add("active");
  captions[slideIndex].style.display = "block";

}

showSlide(slideIndex);

function startSlider() {
    intervalId = setInterval(function() {
    slideIndex = (slideIndex + 1) % totalSlides;
    showSlide(slideIndex);
    }, 10000);
}

startSlider();

var prevBtn = document.getElementById("prevBtn");
var nextBtn = document.getElementById("nextBtn");

prevBtn.onclick = function() {
  clearInterval(intervalId);
  slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
  showSlide(slideIndex);
  startSlider();
};

nextBtn.onclick = function() {
  clearInterval(intervalId);
  slideIndex = (slideIndex + 1) % totalSlides;
  showSlide(slideIndex);
  startSlider();
};