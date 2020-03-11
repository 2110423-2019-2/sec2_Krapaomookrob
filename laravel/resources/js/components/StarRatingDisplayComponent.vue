<template>
<div class="d-flex">
  <span class="align-center">
    <div><v-rating
        readonly
        half-increments
        v-model="rating"
        background-color="#fad06a"
        color="#fad06a"
        medium>
    </v-rating>
    </div>
    </span>
    <span class="vertical-center">
      <div class="container">{{rating}}</div>
    </span>
</div>
</template>

<script>
import Axios from "axios";
  export default {
    props: [
        "tutorid"
    ],
    data: () => ({
      rating: [],
      status: ""
    }),

    mounted: function() {
    axios.get("/tutor/star/"+String(this.tutorid)).then(response => {
        console.log(response.data);
        this.rating = response.data;
        this.status = "fetch star rating success";
    });
  }
  }
</script>


