<template>
    <div class="container">
        <Loader v-show="!loaded"></Loader>
        <h2 class="my-4" >Complete seu pedido</h2>
        <p>Informe um método de pagamento</p>
        <button @click="submit" class="btn btn-success text-white">Confirmar Pagamento</button>
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

    methods: {
        submit() {
            var card = PagSeguro.encryptCard({
                publicKey: "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAr+ZqgD892U9/HXsa7XqBZUayPquAfh9xx4iwUbTSUAvTlmiXFQNTp0Bvt/5vK2FhMj39qSv1zi2OuBjvW38q1E374nzx6NNBL5JosV0+SDINTlCG0cmigHuBOyWzYmjgca+mtQu4WczCaApNaSuVqgb8u7Bd9GCOL4YJotvV5+81frlSwQXralhwRzGhj/A57CGPgGKiuPT+AOGmykIGEZsSD9RKkyoKIoc0OS8CPIzdBOtTQCIwrLn2FxI83Clcg55W8gkFSOS6rWNbG5qFZWMll6yl02HtunalHmUlRUL66YeGXdMDC2PuRcmZbGO5a/2tbVppW6mfSWG3NPRpgwIDAQAB",
                holder: "Nome Sobrenome",
                number: "4242424242424242",
                expMonth: "12",
                expYear: "2030",
                securityCode: "123"
            });

            var encrypted = card.encryptedCard;

            console.log(card);
            console.log(encrypted);
        }
    },

    components: {Loader},
}

</script>
