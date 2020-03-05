<template>
    <button class="btn ownbtn"s>Chat</button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    // props: ['userid', 'courseid'],
    data () {
      return {
        // userId: this.userid,
        // courseId: this.courseid,
        // status: '',
      }
    },
    mounted() {
    //   axios.post('/api/course/status', {
    //     user_id: this.userId,
    //     course_id: this.courseId
    //   }).then(response => this.status = response.data)
    },

    methods: {
        // sendRequest: function(event) {
        //   axios.post('api/course/cancel', {
        //     user_id: this.userId,
        //     course_id: this.courseId
        //   }).then((response) => this.status = "refunding")
        // }
        
    }
  }
</script>
