import './bootstrap';
import { createApp } from 'vue'
import App from "./App";
import router from "@/router/router";
import store from './store'
import axios from "axios";


axios.get('auth-check').then((response) => {
    axios.defaults.headers.common['Authorization']  = `Bearer ${response.data.token}`;
    store.commit('auth/setLoggedIn', true)
    store.commit('auth/setUser', response.data.user)
})

createApp(App)
    .use(router)
    .use(store)
    .mount('#app')
