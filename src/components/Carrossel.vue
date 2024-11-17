<template>
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-color: darkblue;">
        <img :src="'./images/desconto_natal.png'" class="d-block" alt="...">
        <div class="promo-natal">
          <hnatal>RECEBA ATÉ 500€ DE VOLTA</hnatal>
          <p><hnatal>08 a 11 dezembro de 2023</hnatal></p>
          <button @click="showInfo()">Saiba Mais!</button>
        </div>
      </div>
      <div class="carousel-item" style="background-color: darkred;">
        <img :src="'./images/entregas.png'" class="d-block" alt="...">
        <div class="promo-natal">
          <hnatal>Entregas</hnatal>
          <p><hnatal>Envio até 24 horas</hnatal></p>
          <p><hnatal>Portes grátis acima dos 500€</hnatal></p>
        </div>
      </div>
      <div class="carousel-item" style="background-color: darkgreen;">
        <img :src="'./images/roomba1.jpg'" class="d-block" alt="...">
        <div class="promo-natal">
          <hnatal>Saldos de Inverno</hnatal>
          <p><hnatal>A oferta termina às 23:45 do dia 06.01.24</hnatal></p>
          <p><hnatal>Aproveite ;)</hnatal></p>
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

<script>
export default {
  methods: {
    showInfo() {
      alert(`Sim, é isso mesmo, está na imagem. \n
            Compras >= 500€ dá 100€ de desconto! \n
            Compras >= 1000€ dá 200€ de desconto! \n
            Compras >= 1500€ dá 300€ de desconto! \n
            Compras >= 2000€ dá 400€ de desconto! \n
            Compras >= 2500€ dá 500€ de desconto! \n`);
    },
  },
};
</script>