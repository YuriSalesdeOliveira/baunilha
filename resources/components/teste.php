<script defer>

    let testes = document.querySelectorAll('.teste');
    console.log(testes);
    testes.forEach((teste) => {
        teste.addEventListener('click', () => {
            teste.classList.add('teste__azure');
        });
    });


</script>

<style>
    .teste {
        width: 100%;
        height: 400px;
        background-color: antiquewhite;
    }

    .teste.teste__azure {
        background-color: azure;
    }
</style>

<section class="teste">

</section>