
require('./bootstrap');

window.Vue = require('vue').default;

// import App from './components/App';
import { createApp } from 'vue';
import router from './router';
import store from './store';

import App from './components/App.vue'
createApp(App)
    .use(store)
    .use(router)
    .mount("#app")

// Vue.use(VueRouter);
// Vue.use(store)

// const app = new Vue({
//     el: '#app',
//     components: {App},
//     router: new VueRouter(routes),
//     store: store
// });
