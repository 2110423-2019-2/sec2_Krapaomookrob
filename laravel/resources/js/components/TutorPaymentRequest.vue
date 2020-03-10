<template>
  <div class='row'>
    <div class='col-lg-9'>
      <div class='card'>
        <div class='row m-0'>
          <div class="col">
            <label class="font-weight-bold">Amount</label>
            <input type="text" class="form-control" disable v-model='amount' id="InputAmount"  aria-describedby="amountHelp">
            <small id="amountHelp" class="text-danger">{{errMsg.amount}}</small>
            <small class="text-muted">There is 3.65% transfer fee.</small>
          </div>
          <div class="col">
            <label class="font-weight-bold">Balance</label>
            <p>{{balance.toLocaleString()}} Baht</p>
          </div>
        </div>
        <div class='row m-0 justify-content-center'>
          <button class="w-50 btn ownbtn m-2" data-toggle="modal" data-target="#withdrawModal">Withdraw</button>
        </div>
      </div>
      <h1 class='mt-6'>Request History</h1>
      <table id=app class="table owntable mt-5">
        <thead>
            <tr class='d-flex'>
            <th scope="col" class='col-3'>Request ID</th>
            <th scope="col" class='col-3'>Amount</th>
            <th scope="col" class='col-3'>Created at</th>
            <th scope="col" class='col-3'>Status</th>
            </tr>
        </thead>
        <tbody>
          <tr class='d-flex' v-for="request in requests">
            <td scope="row" class='col-3'>{{request.id}}</td>
            <td class='col-3'>{{request.amount.toLocaleString()}}</td>
            <td class='col-3'>{{request.created_at}}</td>
            <td class='col-3'>{{request.status}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class='col-lg-3'>
      <div class="card mb-3">
        <div class="card-header">Bank Account</div>
        <div class="card-body">
          <h5 class="card-title">{{bank}}</h5>
          <p class="card-text">
            Name: {{accountName}}
          </p>
          <p class="card-text">
            Account No: {{accountNumber}}
          </p>
          <div class='d-flex justify-content-center'>
            <a href='/profile/edit'>Edit</a>
          </div>
          <small class="text-danger">{{errMsg.bankAccount}}</small>
        </div>
      </div>
    </div>

    <!--- Confirm Modal-->
    <div id="withdrawModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Do you want to withdraw {{amount}} Baht from your wallet.</p>
          </div>
          <div class="modal-footer">
              <div class="row w-100 justify-content-end">
                <div class="col-2 p-0">
                  <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">Close</button>
                </div>
                <div class="col-2 p-0">
                  <button type="button" class="btn btn-primary m-0" data-dismiss="modal" @click="withdraw">Confirm</button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    data () {
      return {
        accountName: '',
        accountNumber: '',
        bank: '',
        amount: '',
        balance: '',
        requests: [],
        errMsg: {
          amount: '',
          bankAccount: '',
        },

      }
    },
    mounted() {
      axios.get('/api/user/bank-account').then( (response) =>{
          this.accountName = response.data.account_name;
          this.accountNumber = response.data.account_number;
          this.bank = response.data.bank;
      })
      axios.get('/api/payment-request/my-requests').then( (response) =>{
          this.requests = response.data;
      })
      axios.get('/api/user/balance').then( (response) =>{
          this.balance = response.data;
      })
    },
    watch:{
      amount: function(val){
          const result = val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          Vue.nextTick(() => this.amount = result);
          }
    },
    methods: {
        withdraw: function(event) {
            axios.post('/api/payment-request/create', {
              amount: this.amount.replace(/,/g, ''),
            }).then( (response) => {
                window.location.href = "/";
            }).catch( (error) => {
                if(error.response.data.errors.amount){
                  this.errMsg.amount = error.response.data.errors.amount[0]
                }
                if(error.response.data.errors.bankAccount){
                  this.errMsg.bankAccount = error.response.data.errors.bankAccount[0]
                }
              });
        }
    }
  }
</script>
