<template>
    <div class="">
        <Loader v-show="!loaded"></Loader>
        <div class="row">
            <!-- Formulário de Adição -->
            <div class="col-md-12 mb-2 mb-md-3">
                <form @submit.stop.prevent="submit" class="card">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between align-items-center"
                        >
                            <i class="fs-1 bi bi-bookmark-plus-fill"></i>
                            <input
                                v-model="title"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <select v-model="categoryid" class="form-control">
                            <option value="">Seleciona Uma Categoria</option>
                            <option
                                v-if="father_categories"
                                v-for="category in father_categories"
                                :value="category.id"
                                :key="category.id"
                            >
                                {{ category.title }}
                            </option>
                        </select>

                        <textarea
                            v-model="description"
                            class="form-control my-2"
                        ></textarea>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" type="submit">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Listagem de exibição e edição -->
            <div v-if="editableCategories" v-for="category in editableCategories" class="col-md-4 mb-2 mb-md-3">
                <form
                    @submit.stop.prevent="submitEdit(category)"
                    :class="['card', {'bg-secondary': !category.is_father}]"
                >
                    <div
                        class="p-1 d-flex justify-content-between align-items-center"
                    >
                        <h3 v-show="!category.edit" class="">
                            <i class="fs-1 bi bi-bookmark-fill"></i>
                            {{ category.title }}
                        </h3>
                        <input
                            v-show="category.edit"
                            v-model="category.title"
                            type="text" name="title"
                            class="form-control mt-3 ms-3"
                        >
                        <div class="m-2">
                            <button @click.prevent="edit(category)" :class="['btn p-2 m-0', {'btn-secondary text-light': !category.is_father}]">
                                <i :class="['bi', category.edit ? 'bi-x-lg' : 'bi-pencil']"></i>
                            </button>
                            <button v-show="!category.edit" @click.prevent="remove(category)" :class="['btn p-2 m-0', {'btn-secondary text-light': !category.is_father}]">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <span v-show="!category.edit" v-if="category.category" class="badge bg-primary">
                            {{
                                category.category.title
                            }}
                        </span>
                        <span v-if="category.categories" v-for="subcategory in category.categories" class="badge bg-primary">
                            {{
                                subcategory.title
                            }}
                        </span>

                        <select v-show="category.edit" v-model="category.categoryid" class="form-control mb-2">
                            <option value="">Seleciona Uma Categoria</option>
                            <option
                                v-if="father_categories"
                                v-for="category in father_categories"
                                :value="category.id"
                                :key="category.id"
                            >
                                {{ category.title }}
                            </option>
                        </select>

                        <p v-show="!category.edit" class="card-text">{{ category.description }}</p>
                        <textarea
                            v-show="category.edit"
                            v-model="category.description"
                            name="description"
                            class="form-control mb-2" cols="30" rows="5"
                        ></textarea>

                        <div
                            v-if="category.edit"
                            class="d-grid gap-2"
                        >
                            <button class="btn btn-primary" type="submit">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Cookie from "js-cookie";
import AppendToast from "../mixins/appendToast.vue";
import Loader from "../components/Loader.vue";
import Api from "../mixins/Api.vue";

export default {
    data() {
        return {
            loaded: false,

            categories: [],

            title: "",
            description: "",
            categoryid: "",

            access_token: "",
        };
    },

    computed: {

        editableCategories() {
            return this.categories;
        },

        father_categories() {
            return this.categories.filter(category => category.is_father);
        }
    },

    created() {
        this.access_token = Cookie.get("access_token");
        this.fetchData();
    },

    mounted() {

    },

    methods: {

        remove(category) {
            this.del('category/' + category.id, data => {
                this.fetchData()
            }, error => {
                this.loaded = true;
            })
        },

        edit(category) {
            category.edit = !category.edit;
        },

        submitEdit(category) {

            const payload = {
                title: category.title,
                description: category.description,
                categoryid: category.categoryid,
            };

            this.put('category'+ category.id, payload, data => {
                this.fetchData();
            }, error => {
                this.loaded = true;
            })
        },

        submit() {
            this.loaded = false;
            const payload = {
                title: this.title,
                description: this.description,
                categoryid: this.categoryid,
            };

            this.post('category', payload, data => {
                this.fetchData();
            }, error => {
                this.loaded = true
            })
        },

        fetchData() {
            this.loaded = false;

            this.get('category', (data) => {
                this.loaded = true;
                this.title = this.description = this.categoryid = "";

                this.categories = data.map(category => {
                    category.edit = false;
                    return category;
                });
            }, /*errorHandler*/ null, /*hideSuccessMessage*/ true)
        },
    },

    components: {Loader},

    mixins: [AppendToast, Api],
};
</script>
