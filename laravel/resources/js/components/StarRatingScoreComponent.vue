<template>
<div class="d-flex justify-content-start pt-3">
  <span class="align-center">
    <div><v-rating
        readonly
        half-increments
        v-model="rating"
        background-color="yellow lighten-3"
        color="yellow"
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
export default {
  props: [
      "rating"
  ]
}
</script>


