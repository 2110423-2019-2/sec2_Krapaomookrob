<template>
  <div class="frame p-4">
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <h5>Subjects</h5>
          <v-autocomplete
            v-model="chooseSubjects"
            :items="fetchSubjects"
            dense
            chips
            small-chips
            label="Select some subjects"
            multiple
            solo
          ></v-autocomplete>
          <!-- <multiselect v-model="chooseSubjects" :close-on-select="false" :multiple="true" :options="fetchSubjects"></multiselect> -->
          <div class="feedback" v-if="err.chooseSubjects">Please provide a subject.</div>
        </div>
        <div class="form-group">
          <h5>Area</h5>
          <gmap-autocomplete class="form-control" @place_changed="setPlace"></gmap-autocomplete>
          <div class="feedback" v-if="err.chooseArea">Please provide a area.</div>
        </div>
        <gmap-map :center="center" :zoom="12" style="width:100%;  height: 400px;">
          <gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position" @click="center=m.position"></gmap-marker>
        </gmap-map>
      </div>
      <div class="col-lg-6">
        <div class="dash p-3">
          <div class="row">
            <div class="col-sm-7">
              <h5>Day</h5>
              <v-autocomplete
                v-model="chooseDays"
                :items="fetchDays"
                dense
                chips
                small-chips
                label="Select some days"
                multiple
                solo
              ></v-autocomplete>
              <!-- <multiselect v-model="chooseDays" :close-on-select="false" :multiple="true" :options="fetchDays"></multiselect> -->
              <div class="feedback" v-if="err.chooseDays">Please provide some days.</div>
            </div>
            <div class="col-sm-5">
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
                          label="Select time"
                          prepend-icon="access_time"
                          readonly
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-time-picker
                        v-if="menuTime"
                        v-model="time"
                        full-width
                        @click:minute="$refs.menuTime.save(time)"
                      ></v-time-picker>
                    </v-menu>

              <!-- <vue-timepicker v-model="time" format="HH:mm" :minute-interval="30" input-class="form-control"></vue-timepicker> -->
              <div class="feedback" v-if="err.time">Please provide time</div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-7">
              <h5>Start Date</h5>

              <v-menu
                      ref="menuDate"
                      v-model="menuDate"
                      :close-on-content-click="false"
                      :return-value.sync="startDate"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on }">
                        <v-text-field
                          v-model="startDate"
                          label="Select start date"
                          prepend-icon="event"
                          readonly
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="startDate" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="menuDate = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.menuDate.save(startDate)">OK</v-btn>
                      </v-date-picker>
                    </v-menu>

              <!-- <date-picker v-model="startDate"></date-picker> -->
              <div class="feedback" v-if="err.startDate">Please provide start date.</div>
            </div>
            <div class="col-sm-5">
              <h5>Hours/Class</h5>
              <select v-model="hours" class="custom-select">
                <option selected>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-sm-4">
            <h5>Price</h5>
            <input class="form-control" v-model="price" placeholder="Price">
            <div class="feedback" v-if="err.price">Please provide prices.</div>
          </div>
          <div class="col-sm-4">
            <h5>No. of Classes</h5>
            <input class="form-control" v-model="noClasses" placeholder="No. of Classes">
            <div class="feedback" v-if="err.noClasses">Please provide No. of Classes.</div>
          </div>
          <div class="col-sm-4">
            <h5>Student Count</h5>
            <select v-model="studentCount" class="custom-select">
              <option selected>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>

        <div class="row justify-content-center mt-4">
          <a class="btn ownbtn px-5" @click="newCourse">Create New Course</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect'
  import VueTimepicker from 'vue2-timepicker'
  import DatePicker from 'vue2-datepicker'
  import axios from 'axios'

  Vue.component('multiselect', Multiselect)

  export default {
    components: {
      Multiselect,
      VueTimepicker,
      DatePicker
    },
    data () {
      return {
        err: {time:false, chooseSubjects:false, chooseArea:false, chooseDays:false, startDate:false, price:false, noClasses:false},
        center: {lat: 13.7384627, lng: 100.5320458},
        markers: [],
        currentPlace: null,
        chooseArea: "",
        chooseSubjects: [],
        fetchSubjects: [],
        fetchDays: [],
        chooseDays: [],
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
      this.geolocate()
      axios.get('/api/course/days').then(response => this.fetchDays = response.data)
      axios.get('/api/course/subjects').then(response => this.fetchSubjects = response.data)
    },

    methods: {
        newCourse(){
          let check = false
          this.err = {time:false, chooseSubjects:false, chooseArea:false, chooseDays:false, startDate:false, price:false, noClasses:false}
          if(!this.chooseSubjects.length) this.err.chooseSubjects = true, check = true
          if(!this.chooseArea.length) this.err.chooseArea = true, check = true
          if(!this.chooseDays.length) this.err.chooseDays = true, check = true
          if(!this.startDate.length) this.err.startDate = true, check = true
          if(!this.price.length) this.err.price = true, check = true
          if(!this.time.length) this.err.time = true, check = true
          if(!this.noClasses.length) this.err.noClasses = true, check = true
          if(check) return
          axios.post('/api/course/new', {
            subjects: this.chooseSubjects,
            area: this.chooseArea,
            days: this.chooseDays,
            time: this.time,
            startDate: this.startDate,
            hours: this.hours,
            price: this.price,
            noClasses: this.noClasses,
            studentCount: this.studentCount
          })
          .then(response => window.location.href = "/my-courses")
          .catch(error => console.log(error))
        },
        setPlace(place) {
          this.currentPlace = place
          const marker = {
            lat: this.currentPlace.geometry.location.lat(),
            lng: this.currentPlace.geometry.location.lng()
          }
          this.markers = [{position: marker}]
          this.chooseArea = this.currentPlace.name
          this.center = marker
        },
        geolocate: function() {
          navigator.geolocation.getCurrentPosition(position => {
            this.center = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
          });
        }
      }
  }
</script>
