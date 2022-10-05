import axios from "axios";

export default {
   async login (store, payload) {
       await axios.get('/sanctum/csrf-cookie')
       await axios.post('/login',payload)
           .then(() => {
                this.getToken()
                    .then((response) => {
                        axios.defaults.headers.common['Authorization']  = `Bearer ${response.data.token}`;
                    })
           })
           .catch(err => {
               store.commit('setError', err.response.data.message)
               return false
            })
    },
    getToken(){
        return axios.post('/tokens/create')
    }
}
