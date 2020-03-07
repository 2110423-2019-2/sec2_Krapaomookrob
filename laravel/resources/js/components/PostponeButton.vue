<template>
    <button class="chatBtn" @click="postponeRequest()">Chat</button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['classId'],
    data () {
      return {
        userId: this.userid,
        status: '',
      }
    },
    mounted() {
    },

    methods: {
        postponeRequest: function(event) {
            axios.post('api/class/postpone', {
                class_id: this.classId,
            }).then((response) => this.status = "Postponement is requested")
        }
        
    }
  }
</script>
