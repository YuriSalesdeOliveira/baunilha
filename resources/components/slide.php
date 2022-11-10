<script defer>

    let slides = document.querySelectorAll('.slide');
    console.log(slides);
    slides.forEach((slide) => {
        slide.addEventListener('click', () => {
            slide.classList.add('slide__azure');
        });
    });


</script>

<style>
    .slide {
        width: 100%;
        height: 400px;
        background-color: antiquewhite;
    }

    .slide.slide__azure {
        background-color: azure;
    }
</style>

<section class="slide">

</section>