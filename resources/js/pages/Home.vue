<template>
    <div class="container bg-white rounded mt-2 p-4">
        <div class="row gx-2">
            <div v-if="user" class="p-4">
                <h2 class="text-primary fw-bold" >Wellcome, {{ user.name }}!!!</h2>
                <p class="text-secondary">We are always happy having you here with us XD</p>
            </div>
            <div
                v-else
            >
                <h2>it Seems you aren't logged in</h2>
                <p>To receive amazing discounts and amazing features, register <strong>NOW!!!</strong></p>
            </div>
            <div class="col-md-8 col-lg-10">
                <section>
                    <h4 class="mt-4">Check out some new products you might like</h4>
                    <div class="row g-2">
                        <div
                            v-for="product in products"
                            class="col-md-4 col-lg-3"
                        >
                            <ProductCard :product="product" />
                        </div>
                    </div>
                </section>
            </div>
            <div class="col">
                <div class="rounded border d-flex justify-content-center align-items-center">
                    menu
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loader from "../components/Loader.vue";
import ProductCard from "../components/ProductCard.vue";
import { mapGetters } from 'vuex';
import Api from "../mixins/Api.vue";

export default {
    data() {
        return {
            loaded: false,
            products: null,
        };
    },

    created() {
        this.get('product', data => {
            this.products = data;
        }, null, true)
    },

    mounted() {
        this.loaded = true;
    },

    computed: {
        ...mapGetters(['user'])
    },

    components: {Loader, ProductCard},

    mixins: [Api]

};

</script>
