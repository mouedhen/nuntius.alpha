import MissionsDashboard from './pages/MissionsDashboard.vue'
import MissionsCreate from './pages/MissionsCreate.vue'
import MissionsList from './pages/MissionsList.vue'
import MissionsDetails from './pages/MissionsDetails.vue'

export const routes = [
    {
        path: '/dashboard/missions',
        name: 'missions:index',
        component: MissionsDashboard,
        meta: {}
    },
    {
        path: '/dashboard/missions/create',
        name: 'missions:create',
        component: MissionsCreate,
        meta: {}
    },
    {
        path: '/dashboard/missions/list',
        name: 'missions:list',
        component: MissionsList,
        meta: {}
    },
    {
        path: '/dashboard/missions/details/:id',
        name: 'missions:details',
        component: MissionsDetails,
        meta: {}
    },
];
