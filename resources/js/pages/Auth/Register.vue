<template>
    <div class="h-100 d-flex align-items-center">
        <div class="container rounded-3 border p-4">
            <Loader v-show="!loaded"></Loader>
            <div class="row">
                <div class="col-md-6">
                    <form @submit.stop.prevent="submit" class="row g-3">
                        <h1 class="h3 mb-3 fw-normal">Create miniStore account</h1>
                        <em class="text-secondary">some large descriptions about the website and stufs</em>

                        <div class="col-12">
                            <label for="name">Name</label>
                            <input v-model="name" type="text" class="form-control" name="name"
                                placeholder="Name">
                        </div>
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input v-model="email" type="email" class="form-control" name="email"
                                placeholder="name@example.com">
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input v-model="password" type="password" class="form-control" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation">Confirm password</label>
                            <input v-model="password_confirmation" type="password_confirmation" class="form-control" name="password">
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center">
                    <i class="fa-solid fa-user-plus text-primary icon-lg"></i>
                    <em class="text-secondary py-2">some description about the website</em>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Cookie from 'js-cookie';
import Api from '../../mixins/Api.vue';
import Loader from '../../components/Loader.vue';

export default {
    data() {
        return {

            loaded: false,

            name: '',
            email: '',
            password: '',
            password_confirmation: '',
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
            $('.is-invalid').removeClass('is-invalid');

            const payload = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            }

            this.post('user', payload, data => {
                this.loaded = true;
                this.$router.push('/login')
            }, err => {
                this.loaded = true;
                if(err.errors) {
                    Object.entries(err.errors).forEach(field => {
                        $(`[name="${field[0]}"`).addClass('is-invalid');
                    })
                }
            })
        },
    },

    components: {Loader},

    mixins: [Api]
}

</script>
