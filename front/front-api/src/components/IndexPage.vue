<template>
    <div class="container" id="app">
        <div v-for="seller in sellers" :key="seller.id" class="card mb-3"> 
            <div class="card-body">
                <router-link to="/">
                    {{ seller.name }}
                </router-link>
            </div>

        </div>
    </div>
</template>

<script>
export default {
  name: 'IndexPage',

  data() {
      return {
          sellers: []
      }
  },
  
  mounted() {
      fetch('http://localhost:7000/api/sellers')
        .then(response => response.json())
        .then((res) => {
            this.sellers = res.data;
        });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
