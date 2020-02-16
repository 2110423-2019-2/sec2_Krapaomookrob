<template>
    <div class='d-flex justify-content-center'>
      <button class="btn btn-danger" v-on:click="sendRequest" v-if="status==='registered'">Cancel</button>
      <p v-else class="text-danger text-capitalize">{{status}}</p>
    </div>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['userid', 'courseid'],
    data () {
      return {
        userId: this.userid,
        courseId: this.courseid,
        status: '',
      }
    },
    mounted() {
      axios.post('/api/course/status', {
        user_id: this.userId,
        course_id: this.courseId
      }).then(response => this.status = response.data)
    },

    methods: {
        sendRequest: function(event) {
          axios.post('api/course/cancel', {
            user_id: this.userId,
            course_id: this.courseId
          }).then((response) => this.status = "refunding")
        }
        
    }
  }
</script>
