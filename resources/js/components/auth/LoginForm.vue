<template>
    <div class="login-form position-absolute">
        <Transition>
            <div
                v-if="errorText.length"
                class="alert-message alert alert-danger position-absolute top-0"
                role="alert"
                v-text="errorText"
           />
        </Transition>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input
                v-model="email"
                type="email"
                class="form-control"
                placeholder="Enter email"
            >
        </div>
        <div class="mt-3 form-group">
            <label for="exampleInputEmail1">Password</label>
            <input
                v-model="password"
                type="password"
                class="form-control"
                placeholder="password"
            >
        </div>
        <div class="my-3 form-group">
            <a href="login-with-remote-provider">Login with Google</a>
        </div>
        <button
            class="my-3 btn btn-primary"
            @click="login"
        >
            Login
        </button>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import { useStore } from 'vuex'

const store = useStore()
const email = ref('')
const password = ref('')
const errorText = computed(() => store.state.auth.loginErrorMessage)
const login = () => {
    store.dispatch('auth/login', {
        email: email.value,
        password: password.value
    })
}

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

.alert-message{
    left:0;
}
</style>
