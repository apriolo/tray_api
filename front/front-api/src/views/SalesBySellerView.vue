<template>
  <div class="container">
    <h3>{{ seller.name }}</h3>
    <h5> {{ seller.email }} </h5>

    <div class="row">
      <div 
      v-for="sale in sales"
      :key="sale.id"
      class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Value: {{ sale.value }}</h5>
            <p class="card-text">
              Comission: {{ sale.comission }}
            </p>
            <p class="card-text">
              Date: {{ sale.date }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "salesBySeller",
  data() {
    return {
      seller: [],
      sales: [],
    };
  },

  mounted() {
    const sellerId = this.$route.params.id;

    fetch(`http://localhost:7000/api/sales/seller/${sellerId}`)
      .then((response) => response.json())
      .then((res) => {
        this.seller = res.data.seller;
        this.sales = res.data.sales;
      });
  },
};
</script>