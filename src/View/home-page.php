<?php
require_once __DIR__ . '/partials/html-start.php';
?>

<div id="carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-caption-static position-absolute top-50 start-0 translate-middle-y text-white px-4">
            <h1 class="display-4 fw-bold">Os Melhores Produtos!</h1>
            <p class="lead">Explore o Melhor da Nossa Loja.</p>
        </div>
    <!-- Carousel Inner -->
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active" data-bs-interval="2000">
            <img src="/assets/img/slide-4.jpg" class="d-block w-100" alt="Programação">
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item" data-bs-interval="2000">
            <img src="/assets/img/slide-2.jpg" class="d-block w-100" alt="Prédios modernos">
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item" data-bs-interval="2000">
            <img src="/assets/img/slide-3.jpg" class="d-block w-100" alt="Macbook em uma mesa de trabalho">
        </div>
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>

    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
</div>


<?php
require_once __DIR__ . '/partials/html-end.php';
