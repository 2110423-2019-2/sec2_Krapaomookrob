<template>
  
  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
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
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        errorMessage: null,
      }
    },

  mounted: function() {
    axios.get('/checktransfer').then( (response) => {
      this.requests = response.data;
    });
  },
  methods: {
    transfer: function(item) {
      axios.post('/transfer', {
        paymentReqID: item.id
      }).then((response) => {
          window.open(response.data, '_blank');
      }).catch((error) => {
          this.errorMessage = error.response.data;
      })
    }
    
  }
};
</script>

<style>
</style>


