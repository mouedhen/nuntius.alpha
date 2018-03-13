import VueRouter from 'vue-router'

import Home from '../packages/pages/public/Home'
import Dashboard from '../packages/pages/common/Dashboard'

import UsersIndex from '../packages/pages/admin/users/Index'

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Home
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/dashboard/users',
            name: 'users:index',
            component: UsersIndex
        }
    ]
})
