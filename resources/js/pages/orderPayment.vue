<template>
    <div class="container">
        <Loader v-show="!loaded"></Loader>
        <h2 class="my-4" >Complete your order</h2>
        <div class="row">
            <div class="col-md-6 text-center">
                <Icon
                    icon="bi:credit-card-2-front"
                    class="text-success"
                    width="80%"
                />
            </div>
            <div class="col-md-6">
                <form @submit.prevent="submit" class="row g-3">
                    <div class="col-12">
                        <label for="holder" class="form-label">Card Holder Name:</label>
                        <input v-model="holder" type="text" class="form-control" id="holder">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Card Number:</label>
                        <input v-model="number" type="text" class="form-control" id="inputAddress" placeholder="**** **** **** ****">
                    </div>
                    <div class="col-md-6">
                        <label for="expDate" class="form-label">Expiry Date:</label>
                        <input v-model="expDate" type="month" class="form-control" id="expDate" name="start">
                    </div>
                    <div class="col-md-6">
                        <label for="securityCode" class="form-label">CVV</label>
                        <input v-model="securityCode" type="text" class="form-control" id="securityCode" placeholder="***">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success text-white">Confirm Payment</button>
                    </div>
                </form>
            </div>
        </div>
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
            holder: "",
            number: "4242424242424242",
            securityCode: "",
            expDate: "",
        }
    },

    computed: {
        ...mapGetters(['address_id']),
    },

    created() {
        this.loaded = true;
    },

    methods: {
        submit() {
            this.loaded = false;
            let cardPayload = {
                publicKey: "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAr+ZqgD892U9/HXsa7XqBZUayPquAfh9xx4iwUbTSUAvTlmiXFQNTp0Bvt/5vK2FhMj39qSv1zi2OuBjvW38q1E374nzx6NNBL5JosV0+SDINTlCG0cmigHuBOyWzYmjgca+mtQu4WczCaApNaSuVqgb8u7Bd9GCOL4YJotvV5+81frlSwQXralhwRzGhj/A57CGPgGKiuPT+AOGmykIGEZsSD9RKkyoKIoc0OS8CPIzdBOtTQCIwrLn2FxI83Clcg55W8gkFSOS6rWNbG5qFZWMll6yl02HtunalHmUlRUL66YeGXdMDC2PuRcmZbGO5a/2tbVppW6mfSWG3NPRpgwIDAQAB",
                holder: this.holder,
                number: this.number,
                expMonth: this.expDate.split('-')[1],
                expYear: this.expDate.split('-')[0],
                securityCode: this.securityCode
            };

            let card = PagSeguro.encryptCard(cardPayload);

            let encrypted = card.encryptedCard;

            let payload = {
                address_id : this.address_id,
                phone : "27988126640",
                encrypted : encrypted,
            }

            this.post('order', payload, data => {
                this.loaded = true;
                this.$router.push('/orderCompleted');
            }, err => {
                this.loaded = true;
            })

            console.log(encrypted);
        }
    },

    components: {Loader, Icon},

    mixins: [Api],
}

</script>
