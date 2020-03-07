<template>
  <div>
    <!-- test area -->
    <!-- <remove-button
            button-text="Test1"
            v-bind:class="buttonType"
            v-bind:element-id="1"
            v-on:click.native="addToCart(1)"
    ></remove-button>
    <remove-button
            button-text="Test2"
            v-bind:class="buttonType"
            v-bind:element-id="2"
            v-on:click.native="addToCart(2)"
    ></remove-button>
 -->
    <div
      class="row course-item mb-2 pb-2 border-bottom"
      v-for="entry in this.info"
      v-bind:id="entry.course_id"
    >
      <div class="col-lg">
        <strong>{{entry.tutor_name}}</strong>
        <!-- <br />Chula Engineering -->
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
        <a href="#">
          <!-- TODO: send to payment page -->
          <!-- <button class="btn-lg coutbtn px-5" onclick="testo">Checkout</button> -->
          <remove-button
            button-text="CheckOut"
            class="btn-lg coutbtn"
            style="width: 10em !important"
            v-bind:element-id="null"
            v-on:click.native="checkOut()"
          ></remove-button>
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
    axios.get('api/cart').then(response => {
      this.info = response.data.info,
      this.totalPrice = response.data.totalPrice,
      this.cart = response.data.cartString
    });
  },
  methods: {
    removeCart: function(course_id) {
      // no null delete cased
      axios.post('api/cart/remove', {
        course_id: course_id
      }).catch(error => console.log(error))
    },
    checkOut: function(){
      var data = this.cart;
      axios.post("/api/getPayment", {
        course_id: data.split(",").map(x => parseInt(x))
      }).then(response => window.location.href="/payment/"+response.data.payment_id+"/"+response.data.totalprice).catch(error => console.log(error))
    },
    addToCart: function(course_id){
      axios.post('api/cart/add', {
        course_id: course_id
      }).then(response => console.log(response)).catch(error => console.log(error))
    }
  }
};
</script>