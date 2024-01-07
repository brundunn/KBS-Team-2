// let slideIndex = 1;
// showSlides(slideIndex);
//
// function plusSlides(n) {
//     showSlides(slideIndex += n);
// }
//
// function currentSlide(n) {
//     showSlides(slideIndex = n);
// }
//
// function showSlides(n) {
//     let i;
//     let slides = document.getElementsByClassName("mySlides");
//     let dots = document.getElementsByClassName("dot");
//     if (n > slides.length) {slideIndex = 1}
//     if (n < 1) {slideIndex = slides.length}
//     for (i = 0; i < slides.length; i++) {
//         slides[i].style.display = "none";
//     }
//     for (i = 0; i < dots.length; i++) {
//         dots[i].className = dots[i].className.replace(" active", "");
//     }
//     slides[slideIndex-1].style.display = "block";
//     dots[slideIndex-1].className += " active";
// }
window.onload = () => playCarousel();

const playCarousel = () => {
    const carouselItems = document.querySelectorAll('.carousel .carousel-wrapper .carousel-item');
    const seconds = 2; // Carousel switches every N seconds
    let index = 0;

    setInterval(() => {
        carouselItems.forEach(item => item.style.display = 'none');
        carouselItems[index].style.display = 'block'
        index++;
        if (index === carouselItems.length) index = 0;
    }, seconds * 1000)
}
