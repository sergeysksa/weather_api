export default {
    setError(state, data) {
        state.loginErrorMessage = data
        setTimeout(() => state.loginErrorMessage = '', 2000)
    },
    setUser(state, data) {
        state.user = data
    },
    setLoggedIn(state, data) {
        state.loggedIn = data
    }
}
