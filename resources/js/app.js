/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCOZ5YEdudlt0ADcV9w9bo_q2yXs8jehGQ',
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('vehicle-table', require('./components/VehicleTable.vue').default);
Vue.component('service-table', require('./components/ServiceTable.vue').default);
Vue.component('widgets', require('./components/Widgets.vue').default);
Vue.component('mb-map', require('./components/MbMap.vue').default);
Vue.component('g-map', require('./components/GMap.vue').default);
Vue.component('select-vehicle', require('./components/SelectVehicle.vue').default);
Vue.component('reset-redis', require('./components/ResetRedis.vue').default);
Vue.component('forecast', require('./components/Forecast.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',

    mounted () {

    },

})


