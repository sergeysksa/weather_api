export default {
    setLoginError(state, data) {
        state.loginErrorMessage = data
        setTimeout(() => state.loginErrorMessage = '', 2000)
    },
    setRegisterError(state, data) {
        state.registrationErrorMessage = data
        setTimeout(() => state.registrationErrorMessage = '', 2000)
    },
    setUser(state, data) {
        state.user = data
    },
    setLoggedIn(state, data) {
        state.loggedIn = data
    },
    setLoginFormShow(state, data) {
        state.loginFormShow = data
    },
    setRegistrationFormShow(state, data) {
        state.registerShow = data
    }
}
