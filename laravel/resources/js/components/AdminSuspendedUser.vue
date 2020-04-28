<template>
  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Manage Suspended User
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
          <td>{{row.item.email}}</td>
          <td v-if="row.item.is_suspended == 1">
            Suspended
          </td>
          <td v-else>
            -
          </td>
          <!-- <td>{{row.item.is_suspended}}</td> -->
          <td>
              <button v-if="row.item.is_suspended == 1" class='btn btn-primary' @click="toggleSuspend(row.item.id)">
                  Unsuspend
              </button>
              <button v-else class='btn btn-danger' @click="toggleSuspend(row.item.id)">
                  Suspend
              </button>
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
          { text: 'Email', value: 'email' },
          { text: 'Is suspended', value: 'is_suspended' },
          { text: 'Action' },
        ],
        requests: [
        ],
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
  },

  mounted: function() {
    axios.get("/admin-panel/fetchUsers").then(response => {
        this.requests = response.data;
        this.status = "fetch users sucess"
    });
  },
  methods: {
    toggleSuspend: function(id) {
        axios.get('/admin-panel/suspend/'+ String(id)).then(response => {
          this.status = "User is suspended"
          axios.get("/admin-panel/fetchUsers").then(response => {
            this.requests = response.data;
            this.status = "fetch users sucess"
          });
        })
    },
  }
};
</script>

<style>
</style>


