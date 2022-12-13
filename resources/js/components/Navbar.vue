<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid bg-light">
            <router-link
                :to="{ name: 'home' }"
                class="navbar-brand"
            >
                Navbar
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul
                    v-if="user"
                    class="navbar-nav"
                >
                    <li class="nav-item">
                        <a
                            @click.prevent="logout"
                            href=""
                            class="nav-link"
                        >
                            Logout
                        </a>
                    </li>
                </ul>
                <ul
                    v-else
                    class="navbar-nav"
                >
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'login' }"
                            class="nav-link"
                        >
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'register' }"
                            class="nav-link"
                        >
                            Register
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>

import Cookie from 'js-cookie';
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            active: false,
        };
    },

    created() {
    },

    methods: {
        logout() {
            this.$store.dispatch('user', null);
            Cookie.remove('access_token');
            this.$router.push('/login');
        }
    },

    computed: {
        ...mapGetters(['user'])
    }
};
</script>
