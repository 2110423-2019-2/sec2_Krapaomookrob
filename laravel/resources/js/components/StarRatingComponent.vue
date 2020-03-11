<template>
<div>
<v-rating
      v-model="rating"
      background-color="orange lighten-3"
      color="orange"
      medium
    ></v-rating>
</div>
</template>

<script>
import Axios from "axios";
  export default {
    data: () => ({
      rating: 4,
    }),
  }
</script>


