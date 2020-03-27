<template>
  <div class="card">
    <div class="card-body pr-0">
      <h4 class="card-title">Classes Today</h4>
      <div class="d-flex flex-wrap">
        <div class="card p-3 dash mr-3" v-for="(item, index) in classes">
            <h5>{{item.name}}</h5>
            <span class="d-block">{{item.date}}</span>
            <span class="d-block">{{item.time}}</span>
            <button type="button" class="btn ownbtn" v-if="item.checked" disabled>Start Attendance Checking</button>
            <button type="button" class="btn ownbtn" @click="check(item.class_id, item.user_id)" v-else>Start Attendance Checking</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    data: () => ({
      classes: null,
    }),
    mounted () {
      axios.get('/api/classes-today').then(response => this.classes = response.data)
    },
    methods: {
      check(class_id, user_id){
        axios.post('/api/check-class', {class_id, user_id})
        .then(response => {
          this.classes.map((x) => {(x.class_id === class_id) ? this.checkTrue(x) : x})
        })
        this.$eventHub.$emit('checked');
      },
      checkTrue(x){
        x.checked = 1
        return x
      }
    }
  }
</script>
