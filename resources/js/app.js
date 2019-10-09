import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import App from './components/App.vue';

Vue.use(VueRouter);

Vue.component('app', App);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
});
