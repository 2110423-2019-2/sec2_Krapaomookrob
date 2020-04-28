<template>
  <button class="btn px-5 mt-3 w-100">{{buttonText}}</button>
</template>

<script>
export default {
  mounted: function() {
    // console.log("Component mounted.");
  },

  props: ["buttonText", "elementId"],
};
</script>