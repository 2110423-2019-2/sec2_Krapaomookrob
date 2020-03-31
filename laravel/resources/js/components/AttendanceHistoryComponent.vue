<template>
  <div class="card">
    <div class="card-body pr-0">
      <h4 class="card-title">History Attendances</h4>
      <v-data-table
        :headers="headers"
        :items="attendances"
        :items-per-page="10"
        class="elevation-1"
      ></v-data-table>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    data: () => ({
      headers: [
        {
          text: 'Name',
          align: 'start',
          value: 'name',
        },
        { text: 'Date', value: 'date' },
        { text: 'Time', value: 'time' },
      ],
      attendances: [],
    }),
    created() {
        this.$eventHub.$on('checked', this.reload);
    },
    beforeDestroy() {
        this.$eventHub.$off('checked');
    },
    methods: {
      reload(){
        axios.get('/api/history-attendances').then(response => this.attendances = response.data)
      }
    },
    mounted () {
      this.reload()
    }
  }
</script>
