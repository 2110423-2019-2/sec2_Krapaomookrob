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
export default {
  props: [
      "rating"
  ]
}
</script>


