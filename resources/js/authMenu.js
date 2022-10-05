import Dashboard from "@/components/Dashboard";

export default [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { requiresAuth: true }
    }
]
