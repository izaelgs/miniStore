<template>
    <div>
        <Loader v-show="!loaded"></Loader>
        <section class="rounded">
            <h2>Adicionar Objetivo</h2>
            <p>
                Um objetivo pode fazer parte de uma séria de categorias e conter
                diversas metas
            </p>

            <form @submit.stop.prevent="submit" class="row g-3">
                <div class="col-12">
                    <label for="title" class="form-label">Titulo</label>
                    <input
                        type="name"
                        class="form-control"
                        id="title"
                        v-model="title"
                        placeholder="insira um titulo"
                    />
                </div>
                <div class="col-12">
                    <label for="description" class="form-label"
                        >Descricao</label
                    >
                    <textarea
                        class="form-control"
                        id="description"
                        v-model="description"
                        rows="3"
                    ></textarea>
                </div>
                <div class="col-md-6">
                    <label for="categories" class="form-label">
                        Categoria:
                        <span
                            v-if="selected_categories"
                            v-for="category in selected_categories"
                            class="badge bg-secondary mx-1"
                        >
                            {{ category.title }}
                            <i
                                @click="removeCategory(category, categories, selected_categories)"
                                class="bi bi-x-lg pointer"
                            ></i>
                        </span>
                    </label>
                    <select
                        id="categories"
                        @change="addCategory(categories , selected_categories, selected_category)"
                        v-model="selected_category"
                        class="form-select"
                    >
                        <option value="" hidden>Seleciona Uma Categoria</option>
                        <option
                            v-if="categories"
                            v-for="category in categories"
                            :value="category.id"
                            :key="category.id"
                            :disabled="category.disabled"
                        >
                            {{ category.title }}
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="categories" class="form-label">
                        SubCategoria:
                        <span
                            v-if="selected_subcategories"
                            v-for="category in selected_subcategories"
                            class="badge bg-secondary mx-1"
                        >
                            {{ category.title }}
                            <i
                                @click="removeCategory(category, subcategories, selected_subcategories)"
                                class="bi bi-x-lg pointer"
                            ></i>
                        </span>
                    </label>
                    <select
                        id="categories"
                        @change="addCategory(subcategories , selected_subcategories, selected_subcategory)"
                        v-model="selected_subcategory"
                        class="form-select"
                    >
                        <option value="" hidden>Seleciona Uma Categoria</option>
                        <option
                            v-if="subcategories"
                            v-for="category in subcategories"
                            :value="category.id"
                            :key="category.id"
                            :disabled="category.disabled"
                        >
                            {{ category.title }}
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="deadline" class="form-label">Prazo</label>
                    <input
                        type="date"
                        class="form-control"
                        id="deadline"
                        v-model="deadline"
                    />
                </div>
                <div class="col-md-6">
                    <label for="priority" class="form-label">Prioridade</label>
                    <input
                        type="number"
                        class="form-control"
                        id="priority"
                        v-model="priority"
                        min="0"
                        max="10"
                    />
                </div>
                <div class="col-md-6">
                    <label for="cost" class="form-label">Custo</label>
                    <input
                        type="number"
                        class="form-control"
                        id="cost"
                        v-model="cost"
                        min="0"
                        max="10"
                    />
                </div>
                <div class="col-md-6">
                    <label for="gain" class="form-label">Ganho</label>
                    <input
                        type="number"
                        class="form-control"
                        id="gain"
                        v-model="gain"
                        min="0"
                        max="10"
                    />
                </div>
                <div class="col-12 d-grid gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        Cadastrar
                    </button>
                </div>
            </form>
        </section>
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
            subcategories: [],

            selected_categories: [],
            selected_category: "",

            selected_subcategories: [],
            selected_subcategory: "",

            title: "",
            deadline: "",
            description: "",
            cost: 0,
            gain: 0,
            priority: 0,

            access_token: "",
        };
    },

    created() {
        this.access_token = Cookie.get("access_token");
        this.fetchCategories();

    },

    methods: {
        submit() {
            this.loaded = false;
            this.selected_categories = this.selected_categories.concat(this.selected_subcategories);

            const payload = {
                title: this.title,
                deadline: this.deadline,
                description: this.description,
                cost: this.cost,
                gain: this.gain,
                priority: this.priority,
                "categories[]": this.selected_categories.map((category) => {
                    return category.id;
                }),
            };

            this.post('target', payload, (data) => {
                this.loaded = true;

                this.selected_categories = this.selected_subcategories = [];
                this.title = this.deadline = this.description = this.cost = this.gain = this.priority = "";
                this.showToast(data.message, "success");

            }, error => {
                this.loaded = true;
            })

            // fetch("http://127.0.0.1:8000/api/target", {
            //     method: "POST",
            //     headers: {
            //         Accept: "application/json",
            //         "Content-Type": "application/x-www-form-urlencoded",
            //         Authorization: "Bearer " + this.access_token,
            //     },
            //     body: payload,
            // })
            //     .then((response) => response.json())
            //     .then((data) => {
            //         this.loaded = true;

            //         if (!data.errors) {
            //             this.selected_categories = this.selected_subcategories = [];
            //             this.title = this.deadline = this.description = this.cost = this.gain = this.priority = "";
            //             this.showToast(data.message, "success");
            //         } else {
            //             this.displayErrors(data.errors);
            //         }
            //     });
        },

        addCategory(categories , selected_categories, selected_category) {
            let category = categories.find(
                (c) => c.id == selected_category
            );
            selected_categories.push(category);

            if(category.is_father) this.subcategories = this.subcategories.concat(category.categories)

            categories.find(
                (c) => c.id == selected_category
            ).disabled = "disabled";
        },

        removeCategory(category, categories, selected_categories) {
            const index = selected_categories.indexOf(category);
            if (index > -1) { // only splice array when item is found
                selected_categories.splice(index, 1); // 2nd parameter means remove one item only
            }

            if(category.is_father) { // add subcategories on subcategories input
                this.subcategories = this.subcategories.filter(subcategory => !category.categories.includes(subcategory));
                this.selected_subcategories = this.selected_subcategories.filter(subcategory => !category.categories.includes(subcategory))
                category.categories.forEach(subcategory => {
                    subcategory.disabled = null;
                });
            }

            categories.find(
                (c) => c.id == category.id
            ).disabled = null;
        },

        fetchCategories() {
            this.get('category/categories', (data) => {
                this.loaded = true;
                if (!data.error) {
                    this.categories = data;
                } else {
                    alert(data.error);
                }
            }, null, true)
        }
    },

    components: {Loader},

    mixins: [AppendToast, Api]
};

function encodeUrl(payload) {
    var formBody = [];
    for (var property in payload) {
        if (Array.isArray(payload[property])) {
            for (var item in payload[property]) {
                var encodedKey = encodeURIComponent(property);
                var encodedValue = encodeURIComponent(payload[property][item]);
                formBody.push(encodedKey + "=" + encodedValue);
            }
        } else {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(payload[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
    }
    formBody = formBody.join("&");

    return formBody;
}
</script>
