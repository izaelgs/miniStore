<template>
    <div class="h-100 d-flex justify-content-center align-items-center">
        <Loader v-show="!loaded"></Loader>
        <form @submit.stop.prevent="submit" class="form-signin text-center">

            <img src="/favicon.png" class="w-25 h-25" alt="" srcset="">

            <h1 class="h3 mb-3 fw-bold fs-2 py-4">Sign in to your account</h1>

            <div class="form-floating mt-2">
                <input 
                    v-model="email" 
                    type="email" 
                    class="form-control" 
                    id="floatingInput"
                    placeholder="name@example.com"
                >
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mt-2">
                <input 
                    v-model="password" 
                    type="password" 
                    class="form-control" 
                    id="floatingPassword"
                    placeholder="Password"
                >
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Entrar</button>

            <!-- <div class="my-4">Not a member? </div> -->
            <div class="text-center my-4">
                <p>Not a member? <router-link :to="{ name: 'register' }">Register</router-link></p>
                <p>or sign up with:</p>
                <button type="button" class="btn btn-primary btn-floating mx-1 rounded-circle">
                    <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1 rounded-circle">
                    <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1 rounded-circle">
                    <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1 rounded-circle">
                    <i class="fab fa-github"></i>
                </button>
            </div>
        </form>
    </div>
</template>

<script>

import Cookie from 'js-cookie';
import Loader from '../../components/Loader.vue';
import Api from '../../mixins/Api.vue';

export default {
    data() {
        return {

            loaded: false,

            email: '',
            password: '',
        }
    },

    created() {
        Cookie.remove('access_token')
    },

    mounted() {
        this.loaded = true;
    },

    methods: {
        submit() {
            this.loaded = false;
            const payload = {
                email: this.email,
                password: this.password,
            }

            this.post('login', payload, data => {
                this.loaded = true;

                Cookie.set('access_token', data.access_token);
                this.$store.dispatch('access_token', data.access_token);

                this.post('me', null, data => {
                    this.$store.dispatch('user', data);
                    // this.user = data;
                }, null, true);

                this.$router.push('/');
            }, err => {
                this.loaded = true;
            }, true)
        },
    },

    components: {Loader},

    mixins: [Api]
}

</script>
