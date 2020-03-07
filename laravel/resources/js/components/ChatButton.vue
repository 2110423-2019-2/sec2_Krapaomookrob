<template>
    <button class="chatBtn" @click="popUpChat()">Chat</button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['userid'],
    data () {
      return {
        userId: this.userid,
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
