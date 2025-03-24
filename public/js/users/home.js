let banner = document.querySelector('.banner');
let images = JSON.parse(banner.getAttribute('data-images'));
let prev = document.querySelector('.fa-chevron-left');
let next = document.querySelector('.fa-chevron-right');

let index = 0;

function showSlide(index) {
    banner.src = images[index];
}

function nextSlide() {
    index = (index + 1) % images.length;
    showSlide(index);
}

function prevSlide() {
    index = (index - 1 + images.length) % images.length;
    showSlide(index);
}

showSlide(index);

let interval = setInterval(nextSlide, 3000);

prev.addEventListener('click', function(){
    clearInterval(interval);
    prevSlide();
    interval = setInterval(nextSlide, 3000);
});

next.addEventListener('click', function(){
    clearInterval(interval);
    nextSlide();
    interval = setInterval(nextSlide, 3000);
});