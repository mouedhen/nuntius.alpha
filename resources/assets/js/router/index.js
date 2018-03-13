import VueRouter from 'vue-router'

import Home from '../packages/pages/public/Home'
import Dashboard from '../packages/pages/common/Dashboard'

import UsersIndex from '../packages/pages/admin/users/Index'
import UsersCreate from '../packages/pages/admin/users/UsersCreate'
import UsersUpdate from '../packages/pages/admin/users/UsersUpdate'
import UsersList from '../packages/pages/admin/users/UsersList'

import {routes as customersRoutes} from '../modules/missions/customers/routes'
import {routes as conductorsRoutes} from '../modules/missions/conductors/routes'
import {routes as tractorsRoutes} from '../modules/missions/tractors/routes'
import {routes as toolsRoutes} from '../modules/missions/tools/routes'

import {routes as missionsRoutes} from '../modules/missions/missions/routes'

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
        },
        {
            path: '/dashboard/users/create',
            name: 'users:create',
            component: UsersCreate
        },
        {
            path: '/dashboard/users/update/:id',
            name: 'users:update',
            component: UsersUpdate
        },
        {
            path: '/dashboard/users/list',
            name: 'users:list',
            component: UsersList
        },
        ...customersRoutes,
        ...conductorsRoutes,
        ...tractorsRoutes,
        ...toolsRoutes,
        ...missionsRoutes,
    ]
})
