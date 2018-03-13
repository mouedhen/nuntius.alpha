import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import auth from './auth'
import users from './users'
import activities from './activities'

export default new Vuex.Store({
    strict: true,
    modules: {
        auth,
        users,
        activities,
    }
});
