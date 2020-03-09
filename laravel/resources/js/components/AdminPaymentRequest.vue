<template>
  <v-card>
    <v-card-title>
      Payment Requests From Tutors
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
          <td>{{row.item.amount}}</td>
          <td>{{row.item.status}}</td>
          <td>{{row.item.created_at}}</td>
          <td>{{row.item.updated_at}}</td>
          <td>
              <button class='btn ownbtn' @click="transfer(row.item)">
                  Transfer
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
          { text: 'Amount (Baht)', value: 'amount' },
          { text: 'Status', value: 'status' },
          { text: 'Created At', value: 'created_at' },
          { text: 'Updated At', value: 'updated_at' },
          { text: 'Action' },
        ],
        requests: [
        ],
      }
    },

  mounted: function() {
    axios.get('/api/payment-request/initRequests').then( (response) => {
      this.requests = response.data;
    });
  },
  methods: {
    transfer: function(item) {
      alert('ID:' + item.id + '\nAmount: ' + item.amount);
    }
    
  }
};
</script>

<style>
</style>


