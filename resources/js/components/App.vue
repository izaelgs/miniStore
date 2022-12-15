<template>
    <main>
        <Navbar></Navbar>
        <div>
            <router-view></router-view>
        </div>
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

    created() {
        this.post('me', null, data => {
            this.$store.dispatch('user', data);
        }, null, true, true)
    },
    components: { Login, Navbar, Footer },

    mixins: [Api]
}
</script>
