<template>
    <main>
        <Navbar></Navbar>
        <content>
            <router-view></router-view>
        </content>
        <footer class="bg-light border-top text-secondary d-flex align-items-center justify-content-center">
            @Todos os direitos violados
        </footer>
        <!-- <Login></Login> -->
    </main>
</template>

<script>

import Api from '../mixins/Api.vue';
import Login from '../pages/Login.vue';
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
    components: { Login, Navbar },

    mixins: [Api]
}
</script>
