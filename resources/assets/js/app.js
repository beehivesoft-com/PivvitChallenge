require('./bootstrap');

import Purchases from './components/Purchases.vue';
import Offerings from './components/Offerings.vue';
import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/purchases',
            component: Purchases,
            name: 'purchases'
        },
        {
            path: '/offerings',
            component: Offerings,
            name: 'offerings'
        },
    ]
});

const app = new Vue({
    el: '#app',
    router
});
