<template>
    <button class="ownbtn actionBtn" @click="popUpChat()">Register Now</button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['courseid'],
    data () {
      return {
        courseId: this.courseid,
      }
    },
    mounted() {
    },

    methods: {
        popUpChat: function(event) {
            // this.userId += 1;
            // TODO:
        }
        
    }
  }
</script>
