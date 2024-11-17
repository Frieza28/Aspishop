<template>
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-color: darkblue;">
        <img src="../assets/images/desconto_natal.png" class="d-block" style="margin-left:180px;" alt="...">
        <div class="promo-natal">
          <hnatal>RECEBA ATÉ 500€ DE VOLTA</hnatal>
          <p><hnatal>08 a 11 dezembro de 2023</hnatal></p>
          <button>Saiba Mais!</button>
        </div>
      </div>
      <div class="carousel-item active" style="background-color: darkgreen;">
        <img src="../assets/images/desconto_natal.png" class="d-block" style="margin-left:180px;" alt="...">
        <div class="promo-natal">
          <hnatal>RECEBA ATÉ 500€ DE VOLTA</hnatal>
          <p><hnatal>08 a 11 dezembro de 2023</hnatal></p>
          <button>Saiba Mais!</button>
        </div>
      </div>
      <div class="carousel-item active" style="background-color: darkred;">
        <img src="../assets/images/desconto_natal.png" class="d-block" style="margin-left:180px;" alt="...">
        <div class="promo-natal">
          <hnatal>RECEBA ATÉ 500€ DE VOLTA</hnatal>
          <p><hnatal>08 a 11 dezembro de 2023</hnatal></p>
          <button>Saiba Mais!</button>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</template>