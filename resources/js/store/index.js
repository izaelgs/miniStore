import { createStore } from 'vuex';

export default createStore({

    state: {
        user: null,
        access_token: null,

        selecteAddress: null,
    },

    getters: {
        user(state) {
            return state.user;
        },

        access_token(state) {
            return state.access_token;
        },

        selecteAddress(state) {
            return state.selecteAddress;
        },
    },

    mutations: {
        user(state, user) {
            state.user = user;
        },

        access_token(state, access_token) {
            state.access_token = access_token;
            axios.defaults.headers['Authorization'] = "Bearer " + access_token;
        },

        selecteAddress(state, selecteAddress) {
            state.selecteAddress = selecteAddress;
            axios.defaults.headers['Authorization'] = "Bearer " + selecteAddress;
        },
    },

    actions: {
        user(context, user) {
            context.commit('user', user);
        },

        access_token(context, access_token) {
            context.commit('access_token', access_token);
        },

        selecteAddress(context, selecteAddress) {
            context.commit('selecteAddress', selecteAddress);
        },
    },

    modules: {

    }
})
