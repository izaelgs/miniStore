<template>
    <div class="text-center">
        <Loader v-show="!loaded"></Loader>
        <div class="p-1 position-absolute top-0 end-0 mx-4 bg-light" style="z-index: 10;">
            <button @click="editFields()" class="btn px-2">
                <i :class="['bi', edit ? 'bi-x-lg' :  'bi-pencil']"></i>
            </button>
            <button class="btn px-2 text-danger"><i class="bi bi-trash"></i></button>
        </div>
        <!-- <form v-show="edit" class="row g-3">
                <div class="col-12">
                    <input
                        type="name"
                        class="form-control"
                        id="title"
                        v-model="target.title"
                        placeholder="insira um titulo"
                    />
                </div>
                <div class="col-12">
                    <textarea
                        class="form-control"
                        id="description"
                        v-model="target.description"
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
                <div class="col-6">
                    <label for="deadline" class="form-label">Prazo</label>
                    <input
                        type="date"
                        class="form-control"
                        id="deadline"
                        v-model="target.deadline"
                    />
                </div>
                <div class="col-6">
                    <label for="priority" class="form-label">Prioridade</label>
                    <input
                        type="number"
                        class="form-control"
                        id="priority"
                        v-model="target.priority"
                        min="0"
                        max="10"
                    />
                </div>
                <div class="col-6">
                    <label for="cost" class="form-label">Custo</label>
                    <input
                        type="number"
                        class="form-control"
                        id="cost"
                        v-model="target.cost"
                        min="0"
                        max="10"
                    />
                </div>
                <div class="col-6">
                    <label for="gain" class="form-label">Ganho</label>
                    <input
                        type="number"
                        class="form-control"
                        id="gain"
                        v-model="target.gain"
                        min="0"
                        max="10"
                    />
                </div>
                <div class="col-12 d-grid gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        Salvar Alterações
                    </button>
                </div>
        </form> -->
        <div v-show="!edit">
            <h2>{{ target.title }}</h2>
            <div>
                <span
                    v-for="category in target.categories"
                    class="badge bg-primary"
                >
                    {{ category.title }}
                </span>
            </div>
            <div>
                <span class="badge text-bg-secondary">
                    Custo: {{ target.cost }}
                </span>
                <span class="badge text-bg-secondary">
                    Retorno: {{ target.gain }}
                </span>
                <span class="badge text-bg-secondary">
                    Prioridade: {{ target.priority }}
                </span>
                <span class="badge text-bg-secondary">
                    Prazo: {{ target.deadline }}
                </span>
                <span class="badge text-bg-secondary">
                    Urgência: {{ target.sugested_priority }}
                </span>
                <span class="badge text-bg-secondary">
                    Status: {{ target.status }}
                </span>
            </div>
            <p>{{ target.description }}</p>
        </div>
        <div class="list-group text-start">
            <form
                v-for="stage in editableStages"
                @submit.stop.prevent="submitEdit(stage)"
                class="list-group-item card bg-secondary text-light my-2 d-flex flex-row align-items-center"
            >
                <input
                    v-model="stage.status"
                    @change="checkStage(stage)"
                    class="form-check-input me-1 pointer"
                    type="checkbox"
                />
                <div class="vr me-2"></div>
                <div class="w-100">
                    <div class="d-flex w-100 justify-content-between">
                        <input
                            v-show="stage.edit"
                            v-model="stage.title"
                            type="text"
                            name="title"
                            class="form-control mt-3"
                        />
                        <h5 v-show="!stage.edit" class="mb-1">
                            {{ stage.title }}
                            <button
                                @click.prevent="edit_stage(stage)"
                                class="btn text-light px-2"
                            >
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button
                                @click.prevent="delete_stage(stage)"
                                class="btn text-light px-2"
                            >
                                <i class="bi bi-trash"></i>
                            </button>
                        </h5>
                        <small v-show="!stage.edit">{{ stage.deadline }}</small>
                        <button
                            v-show="stage.edit"
                            @click.prevent="edit_stage(stage)"
                            class="btn text-light px-2 mt-3"
                        >
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div v-show="stage.edit" class="row">
                        <div class="col-12">
                            <textarea
                                v-show="stage.edit"
                                v-model="stage.description"
                                name="description"
                                class="form-control my-2"
                                cols="30"
                                rows="5"
                            ></textarea>
                        </div>
                        <div class="col col-md-4">
                            <label for="deadline" class="mt-1">Prazo:</label>
                            <input
                                v-model="stage.deadline"
                                type="date"
                                class="form-control mb-1"
                                id="deadline"
                            />
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="complexity" class="mt-1"
                                >Complexidade:</label
                            >
                            <input
                                v-model="stage.complexity"
                                type="number"
                                class="form-control mb-1"
                                id="complexity"
                            />
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="tolerance" class="mt-1"
                                >Tolerância:</label
                            >
                            <input
                                v-model="stage.tolerance"
                                type="number"
                                class="form-control mb-1"
                                id="tolerance"
                            />
                        </div>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-primary" type="submit">
                                Salvar
                            </button>
                        </div>
                    </div>
                    <span v-show="!stage.edit" class="badge text-bg-primary">
                        Complexidade: {{ stage.complexity }}
                    </span>
                    <span v-show="!stage.edit" class="badge text-bg-primary">
                        Tolerância: {{ stage.tolerance }}
                    </span>
                    <br />
                    <small v-show="!stage.edit">{{ stage.description }}</small>
                </div>
            </form>
            <form
                @submit.stop.prevent="submit"
                class="list-group-item card bg-secondary text-light my-2 p-3"
            >
                <div class="w-100">
                    <h2 class="accordion-header" id="headingOne">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#new-stage"
                            aria-expanded="true"
                            aria-controls="new-stage"
                        >
                            <i class="bi bi-journal-plus fs-5"></i> Adicionar Etapa
                        </button>
                    </h2>
                    <div class="row collapse" id="new-stage">
                        <div class="col-12">
                            <label for="title" class="mt-1">Titulo:</label>
                            <input
                                v-model="title"
                                type="text"
                                id="title"
                                class="form-control"
                            />
                        </div>
                        <div class="col-12">
                            <label for="description" class="mt-1"
                                >Descrição:</label
                            >
                            <textarea
                                v-model="description"
                                id="description"
                                class="form-control my-2"
                                cols="30"
                                rows="5"
                            ></textarea>
                        </div>
                        <div class="col col-md-4">
                            <label for="deadline" class="mt-1">Prazo:</label>
                            <input
                                v-model="deadline"
                                type="date"
                                class="form-control mb-1"
                                id="deadline"
                            />
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="complexity" class="mt-1"
                                >Complexidade:</label
                            >
                            <input
                                v-model="complexity"
                                type="number"
                                class="form-control mb-1"
                                id="complexity"
                            />
                        </div>
                        <div class="col-6 col-md-4">
                            <label for="tolerance" class="mt-1"
                                >Tolerância:</label
                            >
                            <input
                                v-model="tolerance"
                                type="number"
                                class="form-control mb-1"
                                id="tolerance"
                            />
                        </div>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-primary" type="submit">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
            edit: false,
            target: {},

            title: "",
            description: "",
            deadline: "",
            complexity: "",
            tolerance: "",

            access_token: "",
        };
    },

    created() {
        this.$watch(
            () => this.$route.params,
            (toParams, previousParams) => {
                this.getTarget()
            }
        );
        this.access_token = Cookie.get("access_token");

        this.getTarget()
    },

    computed: {
        editableStages() {
            return this.target.stages;
        }
    },

    methods: {
        edit_stage(stage) {
            stage.edit = !stage.edit;
        },

        editFields() {
            this.edit = !this.edit;
        },

        checkStage(stage) {
            const payload = {
                status: stage.status ? 1 : 0,
            };

            this.patch("stage/" + stage.id, payload, data => {
                let emojis = stage.status
                    ? [
                            "arrow-through-heart-fill",
                            "calendar-check-fill",
                            "check-circle-fill",
                            "clipboard-heart-fill",
                            "emoji-kiss-fill",
                            "emoji-smile-fill",
                            "emoji-wink-fill",
                            "hand-thumbs-up-fill",
                            "heart-fill",
                            "hearts",
                            "stars",
                            "emoji-heart-eyes-fill",
                            "emoji-laughing-fill",
                            "emoji-sunglasses-fill",
                        ]
                    : [
                            "emoji-dizzy-fill",
                            "emoji-expressionless-fill",
                            "emoji-frown-fill",
                            "heartbreak-fill",
                        ];

                this.showToast(
                    data.message,
                    "success",
                    `${this.getEmoji(emojis)} text-body fs-5`
                );
            }, null, true);
        },

        submit() {
            const payload = {
                title: this.title,
                description: this.description,
                target_id: this.target.id,
                tolerance: this.tolerance,
                deadline: this.deadline,
                complexity: this.complexity,
            };

            this.post("stage/", payload, data => {
                let emojis = [
                    "check-circle-fill",
                    "emoji-laughing-fill",
                    "emoji-sunglasses-fill",
                    "check2-circle-fill",
                ];
                this.title = this.description = this.tolerance = this.deadline = this.complexity = '';
                this.getTarget();
            }, error => {
                this.loaded = true;
            })

        },

        submitEdit(stage) {
            this.loaded = false;
            const payload = {
                title: stage.title,
                description: stage.description,
                target_id: stage.target_id,
                tolerance: stage.tolerance,
                deadline: stage.deadline,
                complexity: stage.complexity,
                stageid: stage.stageid,
            };

            this.put("stage/" + stage.id, payload, data => {
                this.getTarget();
            }, error => {
                this.loaded = true;
            })
        },

        delete_stage(stage) {

            this.del("stage/" + stage.id, data => {
                const index = this.target.stages.indexOf(stage);
                if (index > -1) {
                    // only splice array when item is found
                    this.target.stages.splice(index, 1); // 2nd parameter means remove one item only
                }
            });
        },

        getTarget() {
            this.loaded = false;
            this.get("target/" + this.$route.params.id, data => {
                data.stages = data.stages.map((stage) => {
                    stage.edit = false;
                    return stage;
                });
                this.loaded = true;
                this.target = data;
            }, error => {
                this.loaded = true;
            }, true);
        }
    },

    components: {Loader},

    mixins: [appendToast, Api],
};
</script>
