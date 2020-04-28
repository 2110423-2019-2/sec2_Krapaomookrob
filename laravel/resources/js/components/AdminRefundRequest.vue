<template>

  <v-card>
  <div class="alert alert-warning alert-dismissible fade show" v-if="errorMessage">
    {{ errorMessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  </div>
    <v-card-title>
      Refund Requests From Students
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
          <td>{{row.item.user_id}}</td>
          <td>{{row.item.course_id}}</td>
          <td>{{row.item.amount}}</td>
          <td>{{row.item.status}}</td>
          <td>{{row.item.created_at}}</td>
          <td>{{row.item.updated_at}}</td>
          <td>
              <button class='btn ownbtn' @click="refund(row.item)" :disabled="row.item.status=='successful'">
                  Refund
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
            sortable: true,
            value: 'id',
          },
          { text: 'User', value: 'user_id'},
          { text: 'Course', value: 'course_id'},
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
    axios.post('/checkrefund').then( (response) => {
      this.requests = response.data;
    });
  },
  methods: {
    refund: function(item) {
      axios.post('/api/refundPayment', {
        refundReq_id: item.id
      }).then((response) => {
        if (response.data.is_transferred) {
            console.log(response.data)
            window.open(response.data.data, '_blank').focus();
        } else {
            console.log(response.data)
        }
        axios.post('/checkrefund').then( (response) => {
        this.requests = response.data;
        });

      }).catch((error) => {
          this.errorMessage = error.response.data;
      })
    }

  }
};
</script>

<style>
</style>


