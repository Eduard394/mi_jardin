/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

import axios from 'axios';
import VueSwal from 'vue-swal'
import Vuetify from 'vuetify';
import colors from 'vuetify/lib/util/colors'

Vue.use(require('bootstrap-vue'));
window.Fire = new Vue();

Vue.use(VueSwal);
Vue.use(Vuetify);

require('vue-tour/dist/vue-tour.css')

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('all-alumnos', require('./components/Datatables/allAlumnos.vue').default);
Vue.component('alumnos-tag', require('./components/alumnos/alumnos.vue').default);
Vue.component('master-tag', require('./components/master.vue').default);
Vue.component('all-pagos', require('./components/Datatables/allPagos.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    colors,
});
