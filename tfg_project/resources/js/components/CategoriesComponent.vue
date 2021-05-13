<template>
    <div class="container">
        <!-- Button trigger modal -->
        <button
            v-on:click="
                modificar = false;
                openModal(0);
            "
            type="button"
            class="btn btn-primary my-4"
        >
            Añadir Categoria
        </button>

        <!-- Modal -->
        <div
            class="modal"
            id="modal_categoria"
            tabindex="-1"
            aria-labelledby="modalCenterTitle"
            aria-hidden="false"
            data-backdrop="false"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label for="name">Nombre:</label>
                            <input
                                class="form-control"
                                v-model="category.name"
                                type="text"
                                name="name"
                                id="name"
                                :class="errors.name ? 'is-invalid' : ''"
                            />
                            <div v-if="errors.name" class="invalid-feedback">
                                {{ errors.name[0] }}
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button
                            v-on:click="closeModal()"
                            type="button"
                            class="btn btn-danger"
                        >
                            Cancelar
                        </button>
                        <button
                            v-on:click="save()"
                            type="button"
                            class="btn btn-success"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <th scope="row">{{ category.id }}</th>
                    <td>{{ category.name }}</td>
                    <td>{{ category.created_at }}</td>
                    <td>
                        <button
                            v-on:click="
                                modificar = true;
                                openModal(1, category);
                            "
                            class="btn btn-success"
                        >
                            Editar
                        </button>
                        <button
                            v-on:click="destroy(category.id)"
                            class="btn btn-danger"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <pagination
                class="mb-0"
                :data="laravelData"
                @pagination-change-page="getResults"
                :limit="limit"
                :show-disabled="showDisabled"
                :size="size"
                :align="align"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import LaravelVuePagination from './LaravelVuePagination.vue';

export default {
    data() {
        return {
            categories: {},
            category: {
                name: ""
            },
            modificar: true,
            tituloModal: "",
            id: 0,
            errors: [],
            laravelData: {},
            laravelResourceData: {},
            limit: 2,
            showDisabled: false,
            size: "default",
            align: "left"
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        async list(page) {
            if (typeof page === "undefined") {
                page = 1;
            }

            const res = await axios.get("/cmsapi/categories?page=" + page);
            this.categories = res.data;
        },
        async getResults(page) {
            if (!page) {
                page = 1;
            }
            this.laravelData = {
                current_page: page,
                data: dummyData,
                from: page,
                last_page: dummyData.length,
                next_page_url: page < dummyData.length ? 'http://example.com/page/2' : null,
                per_page: 1,
                prev_page_url: page > 1 ? 'http://example.com/page/1' : null,
                to: page + 1,
                total: dummyData.length
            };
        },
        async save() {
            if (this.modificar) {
                axios
                    .put("/cmsapi/categories/" + this.id, {
                        id: this.category.id,
                        name: this.category.name
                    })
                    .then(response => {
                        this.closeModal();
                        this.list();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            } else {
                axios
                    .post("/cmsapi/categories", {
                        name: this.category.name
                    })
                    .then(response => {
                        this.closeModal();
                        this.list();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
            this.errors = [];
        },
        async destroy(id) {
            axios.delete("/cmsapi/categories/" + id);
            this.list();
        },
        openModal: function(titulo, data = {}) {
            if (titulo == 0) {
                this.id = 0;
                this.tituloModal = "Crear Categoria";
                this.category.name = "";
            } else {
                this.id = data.id;
                this.tituloModal = "Editar Categoria";
                this.category.name = data.name;
            }
            $("#modal_categoria").modal("show");
        },
        closeModal: function() {
            $("#modal_categoria").modal("hide");
            this.errors = [];
        }
    },
    created() {
        this.list();
    }
};
</script>

<style></style>
