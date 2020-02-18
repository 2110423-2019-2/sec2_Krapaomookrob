<template>
  <div>
    <div
      class="row course-item mb-2 pb-2 border-bottom"
      v-for="entry in this.info"
      v-bind:id="entry.course_id"
    >
      <div class="col-lg">
        <strong>{{entry.tutor_name}}</strong>
        <br />Chula Engineering
      </div>
      <div class="col-lg">{{entry.subjects.join(', ')}}</div>
      <div class="col-lg">{{entry.area}}</div>
      <div class="col-lg">
        {{entry.days.join(', ')}}
        <br />
        {{entry.time}}
        <br />
        ({{entry.hour}} hrs/class)
        <br />
        {{entry.noClass}} Classes,
        <br />
        <div v-if="entry.studentCount == 1">Individual</div>
        <div v-if="entry.studentCount > 1">{{entry.studentCount}} students</div>
      </div>
      <div class="col-lg">
        {{entry.price}} THB
        <br />
        Starts on {{entry.startDate}}
      </div>
      <div class="col-lg">
        <a href="/cart">
          <remove-button
            button-text="Remove"
            v-bind:class="buttonType"
            v-bind:element-id="entry.course_id"
            v-on:click.native="removeCart(entry.course_id)"
          ></remove-button>
        </a>
      </div>
    </div>
    <div class="row justify-content-end pr-5 mt-3">
      <div class="col-2 mr-0 pl-5" style="float: right; font-size:1.4em;">
        <p class="text-right">
          <strong>Summary</strong>
        </p>
      </div>

      <div class="col-2 mr-3">
        <p class="mt-1 mb-0 ml-2">
          {{this.info.length}} x Courses
          <br />Total Price
          <br />
        </p>
        <p
          class="mt-0 mb-1 ml-2"
          style="color:rgb(242, 87, 87); font-size: 1.8em"
        >{{this.totalPrice}} THB</p>
        <a href="/cart">
          <!-- TODO: send to payment page -->
          <button class="btn-lg coutbtn px-5" onclick="checkOutCart()">Checkout</button>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
import RemoveButton from "./RemoveButton.vue";

export default {
  data: function() {
    return {
      cart: null,
      info: [],
      totalPrice: 0
    };
  },

  props: ["buttonType"],

  mounted: function() {
    var self = this;
    console.log("Cart item mounted");
    // get course info
    let cartItems = this.$cookie.get("cart");
    this.cart = cartItems; // debug
    try {
      for (var item of cartItems.split(",")) {
        if (this.info == null) {
          axios.get("api/course/" + String(item)).then(response => {
            this.info = [response.data];
            this.totalPrice += response.data.price;
          });
        } else {
          axios.get("api/course/" + String(item)).then(response => {
            this.info.push(response.data);
            this.totalPrice += response.data.price;
          });
        }
      }
    }catch{
      console.log('null value');
    }
  },
  methods: {
    removeCart: function(elementId) {
      // no null delete cased
      let tmp = this.$cookie.get("cart").split(",");
      this.$cookie.delete("cart");
      tmp.splice(tmp.indexOf(String(elementId)),1);
      this.$cookie.set("cart", tmp, 1);
    }
  }
};
</script>

<style>
</style>