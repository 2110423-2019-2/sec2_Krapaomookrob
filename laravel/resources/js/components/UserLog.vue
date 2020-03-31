<template>

  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      User Information Logging
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
          <td>{{row.item.nickname}}</td>
          <td>{{row.item.email}}</td>
          <td>{{row.item.phone?row.item.phone:'-'}}</td>
          <td>{{row.item.role?row.item.role:'-'}}</td>
          <td>{{row.item.balance}}</td>
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
          { text: 'Name', value: 'name' },
          { text: 'Nickname', value: 'nickname' },
          { text: 'Email', value: 'email' },
          { text: 'Phone', value: 'phone' },
          { text: 'Role', value: 'role' },
          { text: 'Balance', value: 'balance' },
        ],
        requests: [
        ],
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
    },

  mounted: function() {
    axios.get('/getAllUserInfo').then( (response) => {
      this.requests = response.data;
    });
  }
};
</script>

<style>
</style>
