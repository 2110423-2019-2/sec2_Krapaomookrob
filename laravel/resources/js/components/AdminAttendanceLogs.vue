<template>
  
  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Attendance Checking Logs
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="requests"
      :search="search"
    >
      <template v-slot:item="row">
        <tr>
          <td>{{row.item.timestamp}}</td>
          <td>{{row.item.subject}}</td>
          <td>{{row.item.location}}</td>
          <td>{{row.item.tutor}}</td>
          <td>{{row.item.student}}</td>
        </tr>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import Axios from "axios";

export default {
  data () {
      return {
        search: '',
        headers: [
          {
            text: 'Timestamp',
            align: 'start',
            sortable: false,
            value: 'timestamp',
          },
          { text: 'Subject', value: 'subject' },
          { text: 'Location', value: 'location' },
          { text: 'Tutor', value: 'tutor' },
          { text: 'Student', value: 'student' },
        ],
        requests: [
        ],
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
    },

  mounted: function() {
    axios.get('/admin-panel/fetchAttendances').then( (response) => {
      this.requests = response.data;
    });
  },
  methods: {    
  }
};
</script>