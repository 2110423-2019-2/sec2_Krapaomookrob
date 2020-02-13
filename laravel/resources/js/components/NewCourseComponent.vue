<template>
  <form class="frame p-4">
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <h5>Subjects</h5>
          <multiselect v-model="value" :close-on-select="false" :multiple="true" :options="subjects"></multiselect>
        </div>
        <div class="form-group">
          <h5>Area</h5>
          <gmap-autocomplete class="form-control" @place_changed="setPlace"></gmap-autocomplete>
          <button class="btn btn-primary btn-block" @click="addMarker">Pick</button>
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
              <multiselect v-model="value" :close-on-select="false" :multiple="true" :options="days"></multiselect>
            </div>
            <div class="col-sm-5">
              <h5>Time</h5>
              <vue-timepicker v-model="time" format="hh:mm" :minute-interval="30" input-class="form-control"></vue-timepicker>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-sm-7">
              <h5>Start Date</h5>
              <date-picker v-model="startDate"></date-picker>
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
          <div class="col-sm-6">
            <h5>Price</h5>
            <input class="form-control" placeholder="Price">
          </div>
          <div class="col-sm-6">
            <h5>No. of Classes</h5>
            <input class="form-control" placeholder="No. of Classes">
          </div>
        </div>
      </div>
    </div>
  </form>
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
        time: {
          hh: '02',
          mm: '01',
        },
        hours: 1,
        startDate: null,
        center: {lat: 13.743999, lng: 100.532697},
        markers: [],
        places: [],
        currentPlace: null,
        value: [],
        subjects: [],
        days: []
      }
    },
    mounted() {
      this.geolocate();
      axios.get('/api/days').then(response => this.days = response.data);
      axios.get('/api/subjects').then(response => this.subjects = response.data);
    },

    methods: {
        setPlace(place) {
          this.currentPlace = place;
        },
        addMarker() {
          if (this.currentPlace) {
            const marker = {
              lat: this.currentPlace.geometry.location.lat(),
              lng: this.currentPlace.geometry.location.lng()
            };
            this.markers.push({ position: marker });
            this.places.push(this.currentPlace);
            this.center = marker;
            this.currentPlace = null;
          }
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
