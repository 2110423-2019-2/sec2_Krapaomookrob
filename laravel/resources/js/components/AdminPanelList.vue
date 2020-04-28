<template>
  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Manage Admin
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
          <td>{{row.item.role}}</td>
          <td v-if="row.item.role == 'student' || row.item.role == 'tutor'">
              <button class='btn btn-primary' @click="promoteAdmin(row.item.email)">
                  Promote
              </button>
          </td>
          <td v-else-if="row.item.role == 'admin'">
              <button class='btn btn-danger' @click="demoteAdmin(row.item.email)">
                  Demote
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
          { text: 'Email', value: 'email' },
          { text: 'Role', value: 'role' },
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
    promoteAdmin: function(email) {
        axios.get('/admin-panel/promoteAdmin/'+ String(email)).then(response => {
          this.status = "Admin is promoted"
          axios.get("/admin-panel/fetchUsers").then(response => {
            this.requests = response.data;
            this.status = "fetch users sucess"
          });
        })
    },
    demoteAdmin: function(email) {
        axios.get('/admin-panel/demoteAdmin/'+ String(email)).then(response => {
          this.status = "Admin is promoted"
          axios.get("/admin-panel/fetchUsers").then(response => {
            this.requests = response.data;
            this.status = "fetch users sucess"
          });
        })
    }
  }
};
</script>

<style>
</style>


