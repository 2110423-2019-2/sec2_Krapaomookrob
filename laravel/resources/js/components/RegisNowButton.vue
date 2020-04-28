<template>
    <button class="ownbtn actionBtn" :disabled="this.clicked" @click="popUpChat()">Register Now</button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['courseid', 'clicked'],
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
