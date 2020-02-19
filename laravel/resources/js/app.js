require('./bootstrap');

window.Vue = require('vue');
window.VueCookie = require('vue-cookie');
window.Vue.use(window.VueCookie);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('remove-button', require('./components/RemoveButton.vue').default);
Vue.component('new_course-component', require('./components/NewCourseComponent.vue').default);
Vue.component('cart-item', require('./components/CartItem.vue').default);

import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
  load: {
    key: process.env.MIX_GOOGLE_MAP_API,
    libraries: "places"
  }
});

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import StarRating from 'vue-star-rating'
Vue.component('star-rating', require('vue-star-rating').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('remove-button', require('./components/RemoveButton.vue').default);
Vue.component('new_course-component', require('./components/NewCourseComponent.vue').default);
Vue.component('cart-item', require('./components/CartItem.vue').default);
Vue.component('cancel-button', require('./components/CancelButton.vue').default);
Vue.component('admin_panel-component', require('./components/AdminPanelList.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data: {
        activeRemove: 'cancelbtn',
        activeOwn: 'ownbtn'
      },
    methods: {
      addCart: function(elementId){
        // set cookie for '1' day
        if (this.$cookie.get('cart') == null){
          this.$cookie.set('cart',[elementId] ,1);  // TODO:insert first item
        }else{
          let tmp = this.$cookie.get('cart');
          this.$cookie.delete('cart');
          tmp.push(elementId);                      // TODO:insert new item
          this.$cookie.set('cart',tmp,1);
        }
      }
    }
});
