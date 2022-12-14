<template>
    <div class="container">
        <Loader v-show="!loaded"></Loader>
        <div v-if="product" class="row bg-white rounded border p-2">
            <div class="col-md-8 text-center">
                <img :src="product.img_url" style="max-height: 500px; max-width: 100%;" />
            </div>
            <div class="col">
                <div class=" rounded border p-3">
                    <h3 class="text-black fw-normal fs-5">
                    {{ product.name }}
                    </h3>
                    <p class="card-text text-success fw-bold fs-1">R$ {{ product.price }}</p>

                    <button class="btn btn-lg btn-success text-light w-100 my-2">Comprar</button>
                    <button class="btn btn-lg btn-secondary text-llight w-100">Adicionar ao carrinho</button>
                </div>
            </div>
        </div>
        <div class="row mt-2 bg-white rounded border p-2">
            <h5 class="mt-2">Descrição do Produto:</h5>
            <p>{{ product.description }}</p>
        </div>
    </div>
</template>

<script>
import Cookie from "js-cookie";
import appendToast from "../mixins/appendToast.vue";
import Api from "../mixins/Api.vue";
import Loader from "../components/Loader.vue";

export default {
    data() {
        return {
            loaded: false,

            product: false,
        };
    },

    created() {
        this.loadData();

        this.$watch(
            () => this.$route.params,
            (toParams, previousParams) => {
                this.loadData()
            }
        );
    },

    mounted() {
        this.loaded = true;
    },

    methods: {
        loadData() {
            this.get('product/' + this.$route.params.slug, data => {
                this.product = data;
            }, null, true)
        }
    },

    components: {Loader},

    mixins: [Api],
};
</script>
