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
                v-if="!isLoggedIn"
                class="nav-item"
            >
                <button
                    @click="loginFormShowChangeState"
                    class="btn btn-link">Login
                </button>
            </li>
            <li
                v-if="!isLoggedIn"
                class="nav-item"
            >
                <button
                    @click="registrationFormShowChangeState"
                    class="btn btn-link">Registration
                </button>
            </li>
        </ul>
        <Transition>
            <login-form v-if="loginShow" />
        </Transition>
        <Transition>
            <registration-form v-if="registerShow" />
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
import RegistrationForm from "@/components/auth/RegistrationForm";

const store = useStore()

const route = useRoute()

let loginShow = computed(() => store.state.auth.loginFormShow)
let registerShow = computed(() => store.state.auth.registerShow)
const isCurrentRouteActive = (name) => route.name === name
const isLoggedIn = computed(() => store.state.auth.loggedIn)
const componentMenu = computed( () => store.state.auth.loggedIn ? [...menu, ...authMenu] : menu)
const loginFormShowChangeState = () => store.commit('auth/setLoginFormShow', !loginShow.value)
const registrationFormShowChangeState = () => store.commit('auth/setRegistrationFormShow', !registerShow.value)
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
.login-form,
.register-form{
    border: 1px solid #ccc;
    border-radius: 5px;
    top: 4rem;
    left: 5%;
    padding: 1rem;
    background: lightgray;
    z-index: 1;
}

</style>
