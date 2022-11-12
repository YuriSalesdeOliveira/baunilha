(function(){

    let slides = document.querySelectorAll('.slide');
    console.log(slides);
    slides.forEach((slide) => {
        slide.addEventListener('click', () => {
            slide.classList.add('slide__azure');
        });
    });

}());