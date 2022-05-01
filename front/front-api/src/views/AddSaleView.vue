<template>
  <div class="container" id="app">
    <MessageSuccess :msg="msg" v-show="msg" />
    <MessageError :msgError="msgError" v-show="msgError" />
    <div class="col-md-6 offset-md-3">
      <form id="sale-form" @submit="doSale">
        <div class="form-group">
          <label for="value">Value</label>
          <input
            id="value"
            name="value"
            placeholder="$00.00"
            type="number"
            class="form-control"
            v-model="value"
          />
        </div>
        <div class="form-group">
          <label for="seller_id">Seller</label>
          <select
            class="form-control"
            id="seller_id"
            name="seller_id"
            v-model="seller_id"
          >
            <option
              v-for="seller in sellers"
              :key="seller.id"
              :value="seller.id"
            >
              {{ seller.name }}
            </option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Do Sale</button>
      </form>
    </div>
  </div>
</template>

<script>
import MessageSuccess from "./MessageSuccess.vue";
import MessageError from "./MessageError.vue";

export default {
  name: "AddSale",
  data() {
    return {
      sellers: [],
      msg: null,
      seller_id: null,
      value: null,
      msgError: null,
    };
  },

  mounted() {
    this.getSellers();
  },

  methods: {
    async getSellers() {
      const req = await fetch("http://localhost:7000/api/sellers")
        .then((response) => response.json())
        .then((res) => {
          this.sellers = res.data;
        });
    },
    async doSale(e) {
      e.preventDefault();
      const data = {
        value: this.value,
        seller_id: this.seller_id,
      };
      const dataJson = JSON.stringify(data);

      const req = await fetch("http://localhost:7000/api/sales", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: dataJson,
      })
        .then((response) => response.json())
        .then((res) => {
          if (res.status == "Created") {
            this.msg = "Seller created succesfuly";
            setTimeout(() => (this.msg = ""), 5000);
            this.value = "";
            this.seller_id = "";
          } else {
            console.log(res)
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
