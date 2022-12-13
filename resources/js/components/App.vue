<template>
    <main>
        <Navbar></Navbar>
        <content>
            <router-view></router-view>
        </content>
        <Footer />
        <!-- <Login></Login> -->
    </main>
</template>

<script>

import Api from '../mixins/Api.vue';
import Login from '../pages/Login.vue';
import Footer from './Footer.vue';
import Navbar from './Navbar.vue';

export default {
    data() {
        return {
            user: false
        };
    },

    created() {
        this.post('me', null, data => {
            this.$store.dispatch('user', data);
            // this.user = data;
        }, null, true, true)
    },
    components: { Login, Navbar, Footer },

    mixins: [Api]
}
</script>
