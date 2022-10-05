import routes from "@/router/routes";
import {createRouter, createWebHistory} from "vue-router";
import axios from "axios";

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from) => {
    if ( to.meta.requiresAuth && !axios.defaults.headers.common['Authorization']) {
        router.push({ path: '/', replace: true })
        return false
    }
})

export default router;
