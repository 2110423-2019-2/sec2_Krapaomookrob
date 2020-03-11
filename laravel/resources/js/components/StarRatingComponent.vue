<template>
<div class="p-3">
<textarea class="form-control" v-model="message" placeholder="Review Message"></textarea>
<div class="d-flex justify-content-center pt-3">
    <v-rating
        v-model="rating"
        background-color="yellow lighten-3"
        color="yellow"
        large>
    </v-rating>
</div>
<div class="d-flex justify-content-end"><a class="btn btn-light" @click="submitReview">Submit</a></div>
</div>
</template>

<script>
import Axios from "axios";
  export default {
    props: [
        "courseid",
        "studentid",
        "tutorid"
    ],
    data: () => ({
      rating: 3,
      message: ""
    }),

    methods: {
        submitReview: function(){
            console.log('submit');
            return axios.post('/api/review/course', {
                rating: this.rating,
                message: this.message,
                courseid: this.courseid,
                studentid: this.studentid,
                tutorid: this.tutorid
            }).then(response => window.location.href = "/")
            .catch(error => console.log(error));
        }
    }
  }
</script>


