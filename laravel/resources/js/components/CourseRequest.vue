<template>
  <v-tabs v-model="tab" background-color="#55B3E0" centered grow dark>
    <v-tab>Requests</v-tab>
    <v-tab>My Course Request</v-tab>

    <v-tab-item>
      <v-card>
        <v-data-table
          :headers="requestHeaders"
          :items="requests"
          sort-by="courseId"
          class="elevation-1"
        >
          <template v-slot:item.action="{ item }">
            <v-icon small class="mr-2" @click.native="accept(item)">mdi-checkbox-marked-circle</v-icon>
            <v-icon small @click.native="decline(item)">mdi-cancel</v-icon>
          </template>

          <template v-slot:no-data>
            <v-btn color="#55B3E0" @click="initialize" dark>Reset</v-btn>
          </template>
        </v-data-table>
      </v-card>
    </v-tab-item>

    <v-tab-item>
      <v-card>
        <v-data-table
          :headers="myRequestHeaders"
          :items="myRequests"
          sort-by="courseId"
          class="elevation-1"
        >
          <template v-slot:item.action="{ item }">
            <v-icon small @click.native="deleteItem(item)">mdi-cancel</v-icon>
          </template>
          <template v-slot:no-data>
            <v-btn color="#55B3E0" @click="initialize" dark>Reset</v-btn>
          </template>
        </v-data-table>
      </v-card>
    </v-tab-item>
  </v-tabs>
</template>

<script>
import Axios from "axios";
export default {
  data: () => {
    return {
      time: "",
      tab: null,
      dialog: false,
      requestHeaders: [
        { text: "Requester", align: "start", sortable: false, value: "name" },
        { text: "Course ID", value: "courseId" },
        { text: "Actions", value: "action", sortable: false }
      ],
      requests: [

      ],
      myRequestHeaders: [
        { text: "My Course ID", align: "start", value: "myCourseId" },
        { text: "Subjects", sortable: false, value: "subjects", align: "center" },
        { text: "Start Date", value:'startDate'},
        { text: "Date", sortable: false, value: "date", align: "center" },
        { text: "Time", sortable: false, value: "time", align: "center" },
        { text: "Hours", sortable: false, value: "hours", align: "center" },
        { text: "Nunber of Class", value: "noClasses"},
        { text: "Price(Baht)", value: "price", align: "center" },
        { text: "Status", sortable: false, value: "status", align: "center" }
      ],
      myRequests: [

      ],
    };
  },
  mounted: function() {
    axios
      .get("/api/get-my-course-request")
      .then(response => (this.myRequests = response.data))
    axios
      .get('/api/course-requests')
      .then(response => (this.requests = response.data))
  },
  methods: {
    initialize: function(){
      axios
        .get("/api/get-my-course-request")
        .then(response => (vm.$set(myRequests,response.data)))
      axios
        .get('/api/course-requests')
        .then(response => (vm.$set(requests,response.data)))
    },
    accept: function(item) {
      const index = this.requests.indexOf(item);
      if (confirm('Confirm Request')){
        axios
          .post('/api/accept-request', {
            id: item.id,
            courseId: item.courseId,
            requesterId: item.requesterId
          })
          .then(response => (
            this.requests.splice(index, 1)
          ));
        axios
          .post('api/cart/add', {
              course_id: item.courseId
          })
          .then(
            setTimeout(() => window.location.href='/cart', 2000)
          );
      }
    },
    decline: function(item) {
      const index = this.requests.indexOf(item);
      if (confirm('Are you sure you want to decline this request?')){
        axios
          .post('/api/decline-request', {
            id: item.id
          })
          .then(this.requests.splice(index, 1))
      }
    },
    deleteItem: function(item) {
      const index = this.requests.indexOf(item);
      if (confirm('Are you sure you want to delete this course request?')){
        axios
          .post('/api/delete-request', {
            id: item.myCourseId
          })
          .then(this.requests.splice(index, 1))
      }
    }
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Request" : "Edit Request";
    }
  }
};
</script>

<style>
</style>
