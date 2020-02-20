<template>
  <div class="frame p-4">
    <div class="row">
      <div class="col-lg-3">
        
        <div class="form-group">
          <h5>Tutor</h5>
          <v-autocomplete
            v-model="chooseTutor"
            :items="fetchTutors"
            label="Not Specified"
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
            label="Not Specified"
            prepend-inner-icon="place"
            dense
            chips
            small-chips
            solo
          ></v-autocomplete>
        </div>     
      </div>

      <div class="col-lg-3">
        <div class="form-group">
          <h5>Subjects</h5>
          <v-autocomplete
            v-model="chooseSubject"
            :items="fetchSubjects"
            label="Not Specified"
            dense
            chips
            small-chips
            multiple
            solo
          ></v-autocomplete>
        </div>     
      </div>

      <div class="col-lg-3">
        <div class="form-group">
          <h5>Day</h5>
          <v-autocomplete
            v-model="chooseDay"
            :items="fetchDays"
            prepend-inner-icon="event"
            label="Not Specified"
            dense
            chips
            small-chips
            multiple
            solo
          ></v-autocomplete>
        </div>     
      </div>

      <div class="col-lg-3">

        <div class="form-group">
          <h5>Time</h5>
          <v-menu
            ref="menuTime"
            v-model="menuTime"
            :close-on-content-click="false"
            :nudge-right="40"
            :return-value.sync="time"
            transition="scale-transition"
            offset-y
            max-width="290px"
            min-width="290px"
          >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="time"
                  label="Not Specified"
                  prepend-inner-icon="access_time"
                  readonly
                  v-on="on"
                  dense
                  chips
                  small-chips
                  multiple
                  solo
                ></v-text-field>
              </template>
              <v-time-picker
                v-if="menuTime"
                v-model="time"
                full-width
                @click:minute="$refs.menuTime.save(time)"
              ></v-time-picker>
          </v-menu>
        </div>     

        <div class="form-group">
        <h5>Hours/Class</h5>
          <v-autocomplete
            v-model="hour"
            :items=[1,2,3,4]
            label="Not Specified"
            dense
            chips
            small-chips
            multiple
            solo
          ></v-autocomplete>
        </div>     

        <div class="form-group">
        <h5>No. of Classes</h5>
        <v-text-field
            v-model="noClass"
            label="Not Specified"
            dense
            chips
            small-chips
            multiple
            solo
          ></v-text-field>
        </div>     
        
        <div class="form-group">
        <h5>Max Price</h5>
        <v-text-field
            v-model="maxPrice"
            label="Not Specified"
            dense
            chips
            small-chips
            multiple
            solo
          ></v-text-field>
        </div>     
      </div>

      <div class="col-lg-12" style="text-align: center;">
        <button class="btn ownbtn px-5 py-2" @click="searchCourse">Search Courses</button>
      </div>
    </div>
  
    <br>
    <h1>Search Result</h1>
    
    <v-data-table
      :headers="headers"
      :items="search_result"
      :items-per-page="15"
      class="elevation-1"
    ></v-data-table>
    
  </div>
  

</template>

<script>
  import axios from 'axios'

  export default {
    data () {
      return {
        fetchSubjects: [],
        fetchTutors: [],
        fetchDays: [],
        fetchAreas: [],
        chooseTutor: "",
        chooseDay: [],
        chooseArea: "",
        chooseSubject: [],
        menuTime: false,
        time: "",
        hour: "",
        maxPrice: "",
        noClass: "",
        headers: [
          { text: 'Tutor', value: 'tutor', sortable: false, width: "20%" },
          { text: 'Available Subjects', value: 'subjects', sortable: false, width: "15%" },
          { text: 'Areas', value: 'area', sortable: false, width: "15%" },
          { text: 'Classes', value: 'days', sortable: false, width: "20%" },
          { text: 'Price/Start Date', value: 'price', sortable: false, width: "15%" },
          { text: 'Action', value: 'noClasses', sortable: false, width: "15%" },
        ],
        search_result: [],
      }
    },
    mounted() {
      axios.get('/api/fetch-days').then(response => this.fetchDays = response.data)
      axios.get('/api/fetch-subjects').then(response => this.fetchSubjects = response.data)
      axios.get('/api/fetch-tutors').then(response => this.fetchTutors = response.data)
      axios.get('/api/fetch-areas').then(response => this.fetchAreas = response.data)
    },

    methods: {
      searchCourse() {
        axios.get('/api/search-courses', {params: {
          tutor: this.chooseTutor,
          area: this.chooseArea,
          subject: this.chooseSubject,
          day: this.chooseDay,
          time: this.time,
          hour: this.hour,
          noClass: this.noClass,
          maxPrice: this.maxPrice,
        }})
        .then(response => {
          this.search_result = response.data
        })
        .catch(error => console.log(error))
      }   
    }
  }
</script>
