<template>

  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Course Cancellation Logging
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
          <td>{{row.item.id}}</td>
          <td>{{row.item.course_id}}</td>
          <td>{{row.item.user_id}}</td>
          <td>{{row.item.status}}</td>
          <td>{{row.item.updated_at}}</td>
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
            text: 'ID',
            align: 'start',
            sortable: false,
            value: 'id',
          },
          { text: 'Course id', value: 'course_id' },
          { text: 'User id', value: 'user_id' },
          { text: 'Status', value: 'status' },
          { text: 'Updated at', value: 'updated_at' },
        ],
        requests: [
        ],
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
    },

  mounted: function() {
    axios.get('/getAllCourseCancellation').then( (response) => {
      this.requests = response.data;
    });
  }
};
</script>

<style>
</style>
