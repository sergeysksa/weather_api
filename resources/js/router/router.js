import routes from "@/router/routes";
import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from) => {
    if ( to.meta.requiresAuth ) {
        // TODO: Show Login form
        router.push({ path: '/', replace: true })
        return false
    }
})

export default router;
