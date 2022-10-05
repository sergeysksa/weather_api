<template>
    <div class="register-form position-absolute">
        <Transition>
            <div
                v-if="errorText.length"
                class="alert-message alert alert-danger position-absolute top-0"
                role="alert"
                v-text="errorText"
           />
        </Transition>
        <div class="form-group">
            <label>First name</label>
            <input
                v-model="firstName"
                type="email"
                class="form-control"
                placeholder="Enter First name"
            >
        </div>
        <div class="form-group">
            <label>Last name</label>
            <input
                v-model="lastName"
                type="email"
                class="form-control"
                placeholder="Enter Last name"
            >
        </div>
        <div class="form-group">
            <label>Email</label>
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
        <div class="mt-3 form-group">
            <label for="exampleInputEmail1">Password Confirmation</label>
            <input
                v-model="password_confirmation"
                type="password"
                class="form-control"
                placeholder="password confirmation"
            >
        </div>
        <button
            class="my-3 btn btn-primary"
            @click="registration"
        >
            Register
        </button>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import { useStore } from 'vuex'

const store = useStore()
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const password = ref('')
const password_confirmation = ref('')
const errorText = computed(() => store.state.auth.registrationErrorMessage)
const registration = () => {
    store.dispatch('auth/registration', {
        first_name: firstName.value,
        last_name: lastName.value,
        email: email.value,
        password: password.value,
        password_confirmation: password_confirmation.value
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
