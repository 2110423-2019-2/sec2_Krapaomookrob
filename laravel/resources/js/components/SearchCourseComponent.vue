<template>
  <div class="frame p-4">
    <div class="row">
      <div class="col-lg-3">
        
        <div class="form-group">
          <h5>Tutor</h5>
          <v-autocomplete
            v-model="chooseTutor"
            :items="fetchTutors"
            label="Tutor's Name"
            dense
            chips
            small-chips
            solo
          ></v-autocomplete>
        </div>

        <div class="form-group">
          <h5>Area</h5>
          <v-autocomplete
            v-model="chooseArea"
            :items="fetchAreas"
            label="Area/City/Province"
            dense
            chips
            small-chips
            solo
          ></v-autocomplete>
        </div>
      </div>
          
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    data () {
      return {
        fetchTutors: [],
        fetchDays: [],
        fetchAreas: [],
        markers: [],
        currentPlace: null,
        chooseTutor: "",
        chooseDays: [],
        chooseArea: [],
        chooseSubjects: [],
        areaAddress: "",
        areaLocationId: "",
        time: "",
        menuTime: false,
        startDate: "",
        menuDate: false,
        hours: 1,
        price: "",
        noClasses: "",
        studentCount: 1
      }
    },
    mounted() {
      axios.get('/api/course/days').then(response => this.fetchDays = response.data)
      axios.get('/api/course/subjects').then(response => this.fetchSubjects = response.data)
      axios.get('/api/fetch/tutors').then(response => this.fetchTutors = response.data)
      axios.get('/api/fetch/areas').then(response => this.fetchAreas = response.data)
    },

    methods: {
        
    }
  }
</script>
