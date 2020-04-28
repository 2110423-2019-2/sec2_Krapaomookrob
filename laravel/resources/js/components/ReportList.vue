<template>
  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Report List
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
          <td>{{row.item.name}}</td>
          <td>{{row.item.title}}</td>
          <td>{{row.item.message}}</td>
          <td>{{row.item.status}}</td>
          <td v-if="row.item.status == 'unread'">
              <button class='btn btn-primary' @click="markAsRead(row.item.id)">
                  Mark read
              </button>
          </td>
          <td v-else>
            -
          </td>
        </tr>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import Axios from "axios";

export default {
  data: function() {
    return {
      status : '',
      search: '',
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: false,
            value: 'id',
          },
          { text: 'Username', value: 'name' },
          { text: 'Title', value: 'title' },
          { text: 'Message', value: 'message' },
          { text: 'Status', value: 'status' },
          { text: 'Action' },
        ],
        requests: [
        ],
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
  },

  mounted: function() {
    axios.get("/admin-panel/getReports").then(response => {
        this.requests = response.data;
        this.status = "fetch reports sucess"
    });
  },
  methods: {
    markAsRead: function(id) {
        axios.get('/admin-panel/readReport/'+ String(id)).then(response => {
          this.status = "This report is read"
          axios.get("/admin-panel/getReports").then(response => {
            this.requests = response.data;
            this.status = "fetch reports sucess"
          });
        })
    },
  }
};
</script>















