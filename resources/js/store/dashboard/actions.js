import axios from "axios";

export default {
   async getUserData(store, payload) {
       axios.get('api/get-auth-user-data').then(userData => {
           const {data} = userData
           store.commit('setUser', data.user)
           store.commit('setWheather', data.main)
       })
    }
}
