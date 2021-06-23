import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'
import * as Cookies from 'js-cookie'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        is_login: false,
        user_id: null,
        user_name: null,
        user_token: null
    },
    getters: {
      
    },
    mutations: {
        loginUpdate (state,user) {
            state.is_login = true
            state.user_id = user.user_id
            state.user_name = user.user_name
            state.user_token = user.token
        },  
        logout(state){
            state.is_login = false
            state.user_id = null
            state.user_name = null
        }
    },
    actions: {
      
    },
    plugins: [
        createPersistedState({
          getState: (key) => Cookies.getJSON(key),
          setState: (key, state) => Cookies.set(key, state, { expires: 3, secure: true })
        })
    ]
});