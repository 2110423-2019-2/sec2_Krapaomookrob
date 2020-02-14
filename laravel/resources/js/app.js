/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueCookie = require('vue-cookie');
window.Vue.use(window.VueCookie);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('remove-button', require('./components/RemoveButton.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        activeCancel: 'cancelbtn',
        activeOwn: 'ownbtn'
      },
    methods: {
      addCart: function(event){
        // set cookie for '1' day
        if (this.$cookie.get('cart') == null){
          this.$cookie.set('cart',['...'] ,1);  // TODO:insert first item
        }else{
          let tmp = this.$cookie.get('cart');
          this.$cookie.delete('cart');
          tmp.push('...');                      // TODO:insert new item
          this.$cookie.set('cart',tmp,1);
        }
      },
      removeCart: function(event){
        // no null delete case 
        let tmp = this.$cookie.get('cart');
        this.$cookie.delete('cart');
        tmp.pop('...');                         // TODO:pop item
        this.$cookie.set('cart',tmp,1);
      }
    }
});
