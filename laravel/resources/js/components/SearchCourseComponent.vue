<template>
  <div class="frame p-4">
    <div class="row">
      <div class="row px-3">
        <div class="col-lg-3 py-0">
          
          <div class="form-group m-0">
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
        </div>

        <div class="col-lg-3 py-0">
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

        <div class="col-lg-3 py-0">
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

        <div class="col-lg-3 py-0">
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
        </div>
      </div>

      <div class="col-lg-9 py-0">
        <div class="form-group">
          <h5>Area</h5>
          <gmap-autocomplete class="form-control" :value="areaAddress" @place_changed="setPlace"></gmap-autocomplete>
        </div>    
        <gmap-map :center="center" :zoom="12" style="width:100%;  height: 300px;">
          <gmap-marker :key="index" v-for="(m, index) in markers" :position="m.position" :draggable="false" @click="center=m.position" @drag="updateCoordinates"></gmap-marker>
        </gmap-map> 
      </div>     

      <div class="col-lg-3 py-0">
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
      :cart="currentCart"
      class="elevation-1"
    >
      <template v-slot:item.tutor="{ item }">
        <template v-if= "item.isAdvertised">
          <b style="color:purple;">{{item.tutor}}</b> <br>
        </template>
        <template v-else>
          <b style="color:black;">{{item.tutor}}</b> <br>
        </template>
        <a :href="'/tutor/profile/'+item.user_id" class="btn profileBtn" style='margin-top: 3px;margin-bottom:5px;'>
            <div style='position:relative;top:-5px;'>Profile</div>
        </a>
        <chat-button v-bind:userid="item.user_id"></chat-button>
      </template>

      <template v-slot:item.days="{ item }">
        {{item.days}} <br>
        {{getPeriodTimeFormat(item.time, item.hours)}} <br>
        <div v-if="item.noClasses == 1">{{item.noClasses}} Class</div>
        <div v-else>{{item.noClasses}} Classes</div>
      </template>

      <template v-slot:item.priceAndStartDate="{ item }">
        {{item.price}} THB<br>
        Starts on {{getDateFormat(item.startDate)}}
      </template>

      <template v-slot:item.action="{ item }">
        <div class='my-2'>
          <regis-now-button v-bind:courseid="item.id" v-on:click.native='registerNow(item.id)'></regis-now-button>
          <add-to-cart-button v-bind:courseid="item.id" v-bind:clicked="currentCart.includes(item.id)" @click.native="tempoCart.push(item.id);Object.assign(tempoCart, currentCart)"></add-to-cart-button>
        </div>
      </template>

    </v-data-table>
    
  </div>
  

</template>

<script>
  import axios from 'axios'
  import moment from 'moment'

  export default {
    data () {
      return {
        fetchSubjects: [],
        fetchTutors: [],
        fetchDays: [],
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
          { text: 'Tutor', value: 'tutor', sortable: false, width: "16%" },
          { text: 'Available Subjects', value: 'subjects', sortable: false, width: "16%" },
          { text: 'Areas', value: 'area', sortable: false, width: "16%" },
          { text: 'Classes', value: 'days', sortable: false, width: "20%" },
          { text: 'Price/Start Date', value: 'priceAndStartDate', sortable: false, width: "16%" },
          { text: 'Action', value: 'action', sortable: false, width: "16%" },
        ],
        search_result: [],
        // G-MAP
        center: {lat: 13.7384627, lng: 100.5320457},
        markers: [],
        areaAddress: '',
        areaLocationId: '',
        currentCart: [],
        tempoCart: [],
        clickRegis: false
      }
    },
    mounted() {
      axios.get('/api/fetch-days').then(response => this.fetchDays = response.data)
      axios.get('/api/fetch-subjects').then(response => this.fetchSubjects = response.data)
      axios.get('/api/fetch-tutors').then(response => this.fetchTutors = response.data)
      this.markers = [{position: this.center}]
    },

    methods: {
      searchCourse() {
        axios.get('/api/search-courses', {params: {
          tutor: this.chooseTutor,
          area: this.markers[0]['position'],
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
        .catch(error => console.log(error));
        
        // fetch current cart at the same time
        axios.get('api/cart/current')
        .then(response => {
          this.currentCart = response.data,
          this.tempoCart = response.data
        })
        .catch(error => console.log(error));
      },

      getPeriodTimeFormat(start, hour){
        start = '01-01-2000 ' + start
        return moment(String(start),'DD-MM-YYYY HH:mm:ss').format('HH:mm') + '-' + moment(String(start),'DD-MM-YYYY HH:mm:ss').add(hour, 'hours').format('HH:mm')
      },

      getDateFormat(date){
        return moment(String(date)).format('D MMM YYYY')
      },

      // G-MAP
      setPlace(place) {
        this.currentPlace = place
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        }
        this.markers = [{position: marker}]
        this.chooseArea = this.currentPlace.name
        this.areaAddress = this.currentPlace.formatted_address
        this.areaLocationId = this.currentPlace.id
        this.center = marker
      },

      updateCoordinates(location) {
        const marker = {
            lat: location.latLng.lat(),
            lng: location.latLng.lng(),
        }
        this.markers = [{position: marker}]
        this.chooseArea = location.name
        this.areaAddress = location.formatted_address
        this.areaLocationId = location.id
      },

      addToCart: function(course_id){
        axios.post('api/cart/add', {
          course_id: course_id
        }).then(response => console.log(200)).catch(error => console.log(error))
      },

      removeCart: function(course_id) {
        axios.post('api/cart/remove', {
          course_id: course_id
        }).catch(error => console.log(error))
      },
      
      registerNow: function(course_id){
        if(!this.clickRegis){
          if (this.currentCart.includes(course_id)){
            window.location.href = '/cart';
          }else{
            this.clickRegis = true;
            axios.post('api/cart/add', {
              course_id: course_id
            }).then(response => window.location.href="/cart").catch(error => console.log(error))
          }
        }
      }
    }
  }
</script>
