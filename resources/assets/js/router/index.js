import VueRouter from 'vue-router'

import Home from '../packages/pages/public/Home'

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Home
        }
    ]
})
