<template>
    <div>
        <h1>Dashboard</h1>
        <div class="col">
            <pre>{{userData}}</pre>
        </div>
        <div class="col">
            <pre>{{wheatherData}}</pre>
        </div>
    </div>
</template>

<script setup>
import {computed, onMounted} from "vue";
import { useStore } from 'vuex'

const store = useStore()
onMounted(() => {
    store.dispatch('dashboard/getUserData')
})
const userData = computed(() => store.state.dashboard.user)
const wheatherData = computed(() => store.state.dashboard.wheather)

</script>

<style scoped>

</style>
