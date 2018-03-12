require('./bootstrap');

import Vue from 'vue'

window.Vue = Vue;

import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(VueRouter);
Vue.use(Vuex);

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/fr'
import DataTables from 'vue-data-tables'

Vue.use(ElementUI, { locale });
Vue.use(DataTables);

import store from './store'
import router from './router'

import App from './packages/base/App'

Vue.component('app', App);

new Vue({
    router,
    store,
}).$mount('#app');
