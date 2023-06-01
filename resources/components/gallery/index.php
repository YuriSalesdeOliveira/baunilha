<script>
    let gallery = document.querySelector('.gallery');

    gallery.addEventListener('click', function() {

        this.classList.add('gallery__tomato');

    });
</script>

<style>
    .gallery {
        width: 100%;
        height: 400px;
        background-color: cadetblue;
    }

    .gallery__tomato {
        background-color: tomato;
    }
</style>

<section id="<?= $this->generateId() ?>" class="gallery">

</section>