import axios from "axios";

export default {
   async login (store, payload) {
       await axios.get('/sanctum/csrf-cookie')
       await axios.post('/login',payload)
           .then((loginResulData) => {
               console.log( loginResulData );
               axios.post('/tokens/create').then((response) => {
                   console.log( response );
                  // axios.defaults.headers.common['Authorization']  = `Bearer ${response.data.token}` ;
               })
           })
           .catch(err => {
               store.commit('setError', err.response.data.message)
               return false
            })
    }
}
