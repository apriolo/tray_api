<template>
  <div class="container" id="app">
    <MessageSuccess :msg="msg" v-show="msg" />
    <MessageError :msgError="msgError" v-show="msgError" />
    <div class="col-md-6 offset-md-3">
      <form id="seller-form" @submit="addSeller">
        <div class="form-group">
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="name@example.com"
              v-model="email"
            />
          </div>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              placeholder="Name Lastname"
              v-model="name"
            />
        </div>
        <button type="submit" class="btn btn-primary">Save Seller</button>
      </form>
    </div>
  </div>
</template>

<script>
import MessageSuccess from "./MessageSuccess.vue";
import MessageError from "./MessageError.vue";

export default {
  name: "AddSeller",
  data() {
    return {
      msg: null,
      msgError: null,

      email: null,
      name: null,
    };
  },

  mounted() {
    
  },

  methods: {
    async addSeller(e) {
      e.preventDefault();
      const data = {
        name: this.name,
        email: this.email,
      };
      const dataJson = JSON.stringify(data);

      const req = await fetch("http://localhost:7000/api/sellers", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: dataJson,
      })
        .then((response) => response.json())
        .then((res) => {
          if (res.status == "Created") {
            this.msg = "Seller created succesfuly";
            setTimeout(() => (this.msg = ""), 5000);
            this.name = "";
            this.email = "";
          } else {
            var msgE = res.message + ": " + res.fails;
            this.msgError = msgE;
            setTimeout(() => (this.msgError = ""), 5000);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  components: {
    MessageSuccess,
    MessageError,
  },
};
</script>
