
require('./bootstrap');

window.Vue = require('vue').default;

import App from './components/App';
import VueRouter from 'vue-router';
import routes from './router/routes';
import store from './store';
import Vue from 'vue';

Vue.use(VueRouter);
Vue.use(store)

const app = new Vue({
    el: '#app',
    components: {App},
    router: new VueRouter(routes),
    store: store
});
