import { createStore } from 'vuex'
import auth from './auth'
import dashboard from './dashboard'

export default createStore({
    modules: {
        auth,
        dashboard
    }
})
