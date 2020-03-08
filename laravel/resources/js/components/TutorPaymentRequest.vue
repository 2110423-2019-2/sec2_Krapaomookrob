<template>
  <div class='row'>
    <div class='col-lg-9'>
      <div class='card'>
        <div class='row m-0'>
          <div class="col">
            <label class="font-weight-bold">Amount</label>
            <input type="text" class="form-control" disable v-model='amount' id="InputAmount"  aria-describedby="amountHelp">
            <small id="amountHelp" class="form-text text-muted">You can't make the withdrawal amount exceeding the balance</small>
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
    </div>
    <div class='col-lg-3'>
      <div class="card mb-3">
        <div class="card-header">Bank Account</div>
        <div class="card-body">
          <h5 class="card-title">{{bank}}</h5>
          <p class="card-text">
            Name: {{accountName}}
            Account Number: {{accountNumber}}
          </p>
        </div>
      </div>
    </div>


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
        accountName: null,
        accountNumber: null,
        bank: null,
        amount: null,
        balance: 25000,
      }
    },
    mounted() {
      axios.get('/api/user/bank-account').then( (response) =>{
          this.accountName = response.data.account_name;
          this.accountNumber = response.data.account_number;
          this.bank = response.data.bank;
      })
    },
    methods: {
        withdraw: function(event) {
            alert("withdraw");
        }
    }
  }
</script>
