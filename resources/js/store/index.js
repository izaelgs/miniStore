import { createStore } from 'vuex';
import Cookie from 'js-cookie';

export default createStore({

    state: {
        user: null,
        access_token: null,

        address_id: null,
    },

    getters: {
        user(state) {
            return state.user;
        },

        access_token(state) {
            return state.access_token;
        },

        address_id(state) {
            return state.address_id ?? Cookie.get("address_id");
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

        address_id(state, address_id) {
            state.address_id = address_id;
            axios.defaults.headers['Authorization'] = "Bearer " + address_id;
        },
    },

    actions: {
        user(context, user) {
            context.commit('user', user);
        },

        access_token(context, access_token) {
            context.commit('access_token', access_token);
        },

        address_id(context, address_id) {
            context.commit('address_id', address_id);
        },
    },

    modules: {

    }
})
