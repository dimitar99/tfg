<template>

</template>

<script>
export default {

}
</script>

<style>

</style>



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
            {{ __("Create Category") }}
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
                        <h4 v-if="modificar == true" class="modal-title">
                            {{ __("Edit Category") }}
                        </h4>
                        <h4 v-else class="modal-title">
                            {{ __("Create Category") }}
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label for="name">{{ __("Name") }}:</label>
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
                            {{ __("Cancel") }}
                        </button>
                        <button
                            v-if="modificar == true"
                            v-on:click="save()"
                            type="button"
                            class="btn btn-success"
                        >
                            {{ __("Update") }}
                        </button>
                        <button
                            v-else
                            v-on:click="save()"
                            type="button"
                            class="btn btn-success"
                        >
                            {{ __("Save") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{ __("Name") }}</th>
                    <th scope="col">{{ __("Created at") }}</th>
                    <th scope="col" colspan="2">{{ __("Actions") }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in laravelData.data" :key="category.id">
                    <th scope="row">{{ category.id }}</th>
                    <td>{{ category.name }}</td>
                    <td>{{ category.created_at | formatDate }}</td>
                    <td>
                        <button
                            v-on:click="
                                modificar = true;
                                openModal(1, category);
                            "
                            class="btn btn-success"
                        >
                            {{ __("Edit") }}
                        </button>
                        <button
                            v-on:click="destroy(category.id)"
                            class="btn btn-danger"
                        >
                            {{ __("Delete") }}
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination
            :data="laravelData"
            @pagination-change-page="getResults"
            align="right"
        ></pagination>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('hh:mm MM/DD/YYYY')
    }
});

export default {
    data() {
        return {
            categories: {},
            category: {
                name: ""
            },
            modificar: false,
            id: 0,
            errors: {},
            laravelData: {}
        };
    },

    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        async getResults(page = 1) {
            axios.get("/cmsapi/categories?page=" + page).then(response => {
                this.laravelData = response.data;
            });
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
                        this.getResults();
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
                        this.getResults();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
            this.errors = {};
        },
        async destroy(id) {
            axios.delete("/cmsapi/categories/" + id);
            this.getResults();
        },
        openModal: function(titulo, data = {}) {
            if (titulo == 0) {
                this.id = 0;
                this.category.name = "";
            } else {
                this.id = data.id;
                this.category.name = data.name;
            }
            $("#modal_categoria").modal("show");
        },
        closeModal: function() {
            $("#modal_categoria").modal("hide");
            this.errors = {};
        }
    },
    created() {
        this.getResults();
    }
};
</script>

<style></style>
