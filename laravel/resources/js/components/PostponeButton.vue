<template>
    <button class="chatBtn" @click="postponeRequest()">{{status}}</button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['classid'],
    data () {
      return {
        classId: this.classid,
        status: '',
      }
    },
    mounted() {
        axios.get('/api/class/status/' + this.classId)
        .then(response => this.status = response.data)
    },

    methods: {
        postponeRequest: function(event) {
            axios.post('/api/class/postpone', {
                classId: this.classId,
            }).then((response) => this.status = "Postponed")
        }
        
    }
  }
</script>
