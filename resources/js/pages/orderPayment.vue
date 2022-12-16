<template>
    <div class="container">
        <Loader v-show="!loaded"></Loader>
        <h2 class="my-4" >Complete seu pedido</h2>
        <p>Informe um método de pagamento</p>
    </div>
</template>
<script>

import Loader from '../components/Loader.vue';

export default {

    data() {
        return {
            loaded: false,
        }
    },

    created() {
        this.loaded = true;

        // this.get('address', data => {
        //     this.loaded = true;

        //     data.data = data.data ? data.data : false;

        //     this.addresses = data.data;
        // }, err => {
        //     this.loaded = true;
        // }, true)
    },

    components: {Loader},
}

</script>
