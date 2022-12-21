let slides = document.querySelectorAll('.slide');
let button = document.querySelector('.button');

button.addEventListener('click', event => {
    event.stopPropagation();
});

slides.forEach((slide) => {
    slide.addEventListener('click', () => {
        slide.classList.add('slide__azure');
    });
});
