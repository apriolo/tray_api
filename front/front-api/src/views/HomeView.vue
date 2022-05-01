<template>
  <div class="container" id="app">
    <div v-for="seller in sellers" :key="seller.id" class="card mb-3">
      <div class="card">
        <h5 class="card-header">
          <router-link 
            :to="{name: 'salesBySeller', params: { id: seller.id }}">
            {{ seller.name }}
          </router-link>
          </h5>
        <div class="card-body">
          <h5 class="card-title">#{{ seller.id }}</h5>
          <p class="card-text">
            {{ seller.email }}
          </p>
          <p class="card-text">
            Comission: {{ seller.comission }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomeView",
  data() {
    return {
      sellers: [],
    };
  },

  mounted() {
    fetch("http://localhost:7000/api/sellers")
      .then((response) => response.json())
      .then((res) => {
        this.sellers = res.data;
      });
  },
};
</script>
