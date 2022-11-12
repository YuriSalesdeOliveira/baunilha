<script>

    let slides = document.querySelectorAll('.slide');

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

    .button {
        padding: 10px 20px;
        color: white;
        background-color: brown;
    }
</style>

<section class="slide">
    <a href="" class="button">Botao</a>
</section>