<template>
  <div>
    <div class='col'>
      <div class='row justify-content-center'>
        <button class="btn btn-danger"  v-if="status==='registered' && role==='student'" data-toggle="modal" :data-target="'#cancelModal'+courseId">Cancel</button>
        <p v-else class="text-danger text-capitalize">{{status}}</p>
      </div>
    </div>

    <div :id="'cancelModal' + courseId" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>You will receive 70% refund from the remaining classs. If you confirm you will not be able to undo.</p>
          </div>
          <div class="modal-footer">
              <div class="row w-100 justify-content-end">
                <div class="col-3 p-0">
                  <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">Close</button>
                </div>
                <div class="col-3 p-0">
                  <button type="button" class="btn btn-primary m-0" data-dismiss="modal" v-on:click="sendRequest">Confirm</button>
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
    props: ['userid', 'courseid'],
    data () {
      return {
        userId: this.userid,
        courseId: this.courseid,
        status: '',
        role: ''
      }
    },
    mounted() {
      axios.get('/api/user/role')
        .then(response => this.role = response.data)  
      axios.get('/api/course/status/'+this.courseId)
        .then(response => this.status = response.data)

    },

    methods: {
        sendRequest: function(event) {
          axios.post('api/course/cancel', {
            user_id: this.userId,
            course_id: this.courseId
          }).then((response) => this.status = "refunding")
        }
        
    }
  }
</script>
