<template>
    <div class="container">
        <Loader v-show="!loaded"></Loader>
        <h2 class="my-4" >Complete seu pedido</h2>
        <!-- Address -->
        <section v-if="addresses" class="my-4">
            <h4>Address</h4>
            <div v-for="address in addresses" class="list-group-item card my-2 d-flex flex-row align-items-center bg-secondary bg-opacity-10 p-3">
                <input type="radio" id="one" :value="address.id" v-model="picked">
                <div class="vr mx-2"></div>
                <div class="w-100">
                    <p><b>Address</b></p>
                    {{address.street + ' ' + address.number + ' ' + address.city + ' ' + address.state + ' ' + address.zipcode }}
                </div>
            </div>
        </section>
        <section class="bg-secondary bg-opacity-10 rounded p-3">
            <button class="btn w-100 text-start" data-bs-toggle="collapse" data-bs-target="#form" aria-expanded="false" aria-controls="form">
                <Icon
                    icon="ic:baseline-add-location-alt"
                    width="28px"
                /> Novo Endereço
            </button>
            <form @submit.prevent="submit" class="row g-3 collapse" id="form">
                <div class="col-md-3">
                    <label for="zipcode" class="form-label">Zipcode</label>
                    <input type="text" class="form-control" id="zipcode" v-model="zipcode">
                </div>
                <div class="col-md-3">
                    <label for="number" class="form-label">Number</label>
                    <input type="text" class="form-control" id="number" v-model="number">
                </div>
                <div class="col-md-6">
                    <label for="complement" class="form-label">Complement</label>
                    <input type="text" class="form-control" id="complement" v-model="complement">
                </div>
                <div class="col-md-4">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" v-model="state">
                </div>
                <div class="col-md-4">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" v-model="city">
                </div>
                <div class="col-md-4">
                    <label for="street" class="form-label">Street</label>
                    <input type="text" class="form-control" id="street" v-model="street">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
        </section>
        <section class="text-end">
            <router-link :to="{ name: 'orderPayment'}" class="btn btn-success text-white">Proximo</router-link>
        </section>
    </div>
</template>

<script>
import Loader from '../components/Loader.vue';
import { Icon } from '@iconify/vue';

import Api from '../mixins/Api.vue';

import { mapGetters } from 'vuex';

export default {

    data() {
        return {
            loaded: false,

            picked: '',

            street: '',
            number: '',
            city: '',
            state: '',
            zipcode: '',
            complement: '',

            addresses: []
        }
    },

    created() {
        this.get('address', data => {
            this.loaded = true;

            data.data = data.data ? data.data : false;

            this.addresses = data.data;
        }, err => {
            this.loaded = true;
        }, true)
    },

    computed: {
        ...mapGetters(['address_id'])
    },

    methods: {
        submit() {
            this.loaded = false;
            $('.is-invalid').removeClass('is-invalid');

            const payload = {
                street : this.street,
                number : this.number,
                city : this.city,
                state : this.state,
                zipcode : this.zipcode,
                complement : this.complement,
            }

            this.post('address', payload, data => {
                this.loaded = true;
                this.addresses.push(data.data)
            }, err => {
                this.loaded = true;
                if(err.errors) {
                    Object.entries(err.errors).forEach(field => {
                        $(`#${field[0]}`).addClass('is-invalid');
                    })
                }
            })
        },
    },

    mixins: [Api],

    components: { Loader, Icon}
}

</script>
