<template>
    <div class="container">
        <Loader v-show="!loaded"></Loader>
        <div v-if="items" class="mt-4 p-2 border rounded bg-whit">
            <div v-for="item in items" class="my-2">
                <div class="row align-items-center">
                    <div class="col-2 col-md-1 text-center">
                        <img :src="item.product.img_url" style="max-height: 500px; max-width: 100%;" />
                    </div>
                    <router-link
                        :to="{ name: 'product', params: { slug: item.product.id }}"
                        class="col-10 col-md-6 text-decoration-none text-black"
                    >
                        {{
                            item.product.name.length > 50 ?
                                item.product.name.substr(0, 50) + '...' :
                                item.product.name
                        }}
                    </router-link>
                    <div class="col-6 col-md-3">
                        <div class="row mb-3">
                            <label for="quantity" class="col-6 col-md-4 col-form-label text-secondary">Quantity:</label>
                            <div class="col">
                                <input
                                    v-model="item.quantity"
                                    @change="changeQuantity(item)"
                                    type="number" min="1" max="10"
                                    class="form-control" id="quantity"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 text-center fw-bold">R$ {{ item.price }}</div>
                </div>
                <div>
                    <button @click="removeItem(item.id)" class="btn text-danger mt-0">Excluir</button>
                </div>
            </div>

            <hr>
            <div>
                <div class="fw-bold">Total: {{ total }}</div>
            </div>
        </div>
        <div v-else class="text-center pb-4">
            <p class="fs-3">Não há nada no seu carrinho</p>
        </div>
    </div>
</template>

<script>
import Loader from "../components/Loader.vue";
import Api from "../mixins/Api.vue";

export default {
    data() {
        return {
            loaded: false,

            items: [],
        };
    },

    created() {
        this.get('cart', data => {

            if(!data.length) data = false;

            this.loaded = true;
            this.items = data;
        }, null, true)
    },

    computed: {
        total() {
            return this.items.reduce(
                (accumulator, item) => accumulator + Number(item.price), 0
            ).toFixed(2);
        }
    },

    mounted() {
        this.loaded = true;
    },

    methods: {
        removeItem(id) {
            this.del('cart/' + id, data => {
                this.get('cart', data => {

                    if(!data.length) data = false;

                    this.loaded = true;
                    this.items = data;
                }, null, true)
            });
        },

        changeQuantity(item) {
            item.price = item.quantity * item.product.price;
            item.price = item.price.toFixed(2);
        },
    },

    components: {Loader},

    mixins: [Api],
};
</script>
