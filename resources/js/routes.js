import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: "dashboard",
        component: () => import('./pages/Dashboard.vue')
    },
    {
        path: '/profiles',
        name: "profile",
        component: () => import('./pages/profile/Index.vue')
    },
    {
        path: '/profiles/create',
        name: "create-profile",
        component: () => import('./pages/profile/Create.vue')
    },
    {
        path: '/profiles/:profileId/manage',
        name: "manage-profile",
        component: () => import('./pages/profile/Manage.vue')
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router