<template>
    <nav class="navbar navbar-expand-lg position-relative">
        <ul class="nav nav-pills">
            <li
                v-for="(menuItem, index) in componentMenu"
                :key="index"
                class="nav-item"
            >
                <router-link
                    :class="{active: isCurrentRouteActive(menuItem.name)}"
                    class="nav-link"
                    aria-current="page"
                    :to="{ name: menuItem.name}"
                    v-text="menuItem.name"
                />
            </li>
            <li
                class="nav-item"
            >
                <button
                    v-if="!isLoggedIn"
                    @click="loginShow = !loginShow"
                    class="btn btn-link">Login</button>
            </li>
        </ul>
        <Transition>
            <login-form v-if="loginShow" />
        </Transition>
    </nav>
</template>

<script setup>
import { computed, ref } from "vue";
import { useRoute } from 'vue-router'
import { useStore } from 'vuex'
import menu from '@/menu'
import authMenu from '@/authMenu'
import LoginForm from "@/components/auth/LoginForm";

const store = useStore()

const route = useRoute()

let loginShow = ref(false)
const isCurrentRouteActive = (name) => route.name === name
const isLoggedIn = computed(() => store.state.auth.loggedIn)
const componentMenu = computed( () => isLoggedIn ? [...menu, authMenu] : menu)

</script>

<style scoped lang="scss">
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
.login-form{
    border: 1px solid #ccc;
    border-radius: 5px;
    top: 4rem;
    left: 5%;
    padding: 1rem;
    background: lightgray;
    z-index: 1;
}

</style>
