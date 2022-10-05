import axios from "axios";
import router from "@/router/router";

export default {
    getToken(){
        return axios.post('/tokens/create')
    },
    setCookie(){
        axios.get('/sanctum/csrf-cookie')
    },
   login (context, payload) {
       context.dispatch('setCookie')
       axios.post('/login',payload)
           .then(() => {
               context.dispatch('getToken')
                    .then((response) => {
                        axios.defaults.headers.common['Authorization']  = `Bearer ${response.data.token}`;
                        context.commit('setLoginFormShow', false)
                        context.commit('setLoggedIn', true)
                        router.push({ name: 'dashboard'})
                    })
           })
           .catch(err => {
               context.commit('setLoginError', err.response.data.message)
            })
    },
    registration (context, payload) {
        context.dispatch('setCookie')
        axios.post('/register',payload)
            .then(() => {
                context.dispatch('getToken')
                    .then((response) => {
                        axios.defaults.headers.common['Authorization']  = `Bearer ${response.data.token}`;
                        context.commit('setRegistrationFormShow', false)
                        context.commit('setLoggedIn', true)
                        router.push({ name: 'dashboard'})
                    })
            })
            .catch(err => {
                context.commit('setRegisterError', err.response.data.message)
            })
    }
}
