<template>
    <button class="chatBtn" @click="popUpChat(userid)">Chat</button>
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
        popUpChat: function(userid) {
            window.location.href = '/chat?user-id='+userid;
        }

    }
  }
</script>
