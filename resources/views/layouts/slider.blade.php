<div id="carouselExampleIndicators" class="carousel slide mr-auto ml-auto p-slider" data-ride="carousel" style="">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
    </ol>

    <div class="carousel-inner carousel" >
        <div class="carousel-item active">
            <div class="d-block p-slider w-100" style="background-image: url('{{ asset('assets/img/bg2.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;"></div>
        </div>
        <div class="carousel-item">
            <div class="d-block p-slider w-100" style="background-image: url('{{ asset('assets/img/bg3.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;"></div>
        </div>
        <div class="carousel-item">
            <div class="d-block p-slider w-100" style="background-image: url('{{ asset('assets/img/bg7.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;"></div>
        </div>
        <div class="carousel-item">
            <div class="d-block p-slider w-100" style="background-image: url('{{ asset('assets/img/bg2.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;"></div>
        </div>
        <div class="carousel-item">
            <div class="d-block p-slider w-100" style="background-image: url('{{ asset('assets/img/bg3.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;"></div>
        </div>
        <div class="carousel-item">
            <div class="d-block p-slider w-100" style="background-image: url('{{ asset('assets/img/bg7.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;"></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<style>
    .p-slider
    {     
        height: 100vh;
    }
    @media screen and (max-width: 768px)
    {
        .p-slider
        {
            width: 100vw;
            height: 100vh;
        }
    }
</style>
