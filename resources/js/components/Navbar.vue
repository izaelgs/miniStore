<template>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container bg-light">
            <router-link
                :to="{ name: 'home' }"
                class="navbar-brand text-primary fs-4 fw-bolder flex-fill"
            >
                miniStore
            </router-link>

            <!-- Toggle -->
            <button class="navbar-toggler mx-2 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Cart -->
            <router-link
                v-if="user"
                :to="{ name: 'cart' }"
                class="text-primary"
            >
                <Icon
                    icon="ic:baseline-shopping-cart"
                    width="28px"
                />
            </router-link>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-end flex-grow-0" id="navbarNav">
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
                    class="navbar-nav justify-content-end"
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

import { Icon } from '@iconify/vue';

export default {

    methods: {
        logout() {
            this.$store.dispatch('user', null);
            Cookie.remove('access_token');
            this.$router.push('/login');
        }
    },

    computed: {
        ...mapGetters(['user'])
    },

    components: { Icon }
};
</script>
