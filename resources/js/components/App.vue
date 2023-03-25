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
import Login from '../pages/Auth/Login.vue';
import Footer from './Footer.vue';
import Navbar from './Navbar.vue';

export default {
    
    components: { Login, Navbar, Footer },

    mixins: [Api]
}
</script>
