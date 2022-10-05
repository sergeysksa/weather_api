import menu from '@/menu'
import authMenu from '@/authMenu'
import NotFound from "@/components/NotFound";

export default [
    ...menu,
    ...authMenu,
    {
        path: "/:catchAll(.*)",
        component: NotFound,
    },
]
