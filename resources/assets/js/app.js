require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios,axios);
// Vue.use(axios);

import HomeComponent from './components/HomeComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import AnswerComponent from './components/AnswerComponent.vue';

const routes = [
    {
        name: 'home',
        path: '/survey',
        component: HomeComponent
    },
    {
        name: 'create',
        path: '/survey/create/:id',
        component: CreateComponent
    },
    {
        name: 'answer',
        path: '/survey/answer',
        component: AnswerComponent
    },
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');