import CustomersDashboard from './pages/CustomersDashboard'
import CustomersCreate from './pages/CustomersCreate'
import CustomersUpdate from './pages/CustomersUpdate'
import CustomersList from './pages/CustomersList'
import CustomersDetails from './pages/CustomersDetails'

export const routes = [
    {
        path: '/dashboard/customers',
        name: 'customers:index',
        component: CustomersDashboard,
        meta: {}
    },
    {
        path: '/dashboard/customers/create',
        name: 'customers:create',
        component: CustomersCreate,
        meta: {}
    },
    {
        path: '/dashboard/customers/update/:id',
        name: 'customers:update',
        component: CustomersUpdate,
        meta: {}
    },
    {
        path: '/dashboard/customers/list',
        name: 'customers:list',
        component: CustomersList,
        meta: {}
    },
    {
        path: '/dashboard/customers/:id/details',
        name: 'customers:details',
        component: CustomersDetails,
        meta: {}
    }
]