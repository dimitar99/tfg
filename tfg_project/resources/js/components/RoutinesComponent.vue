<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-primary mb-4"
            v-on:click="openModal(true)"
        >
            {{ __("tfg.routines.new") }}
        </button>
        <div class="row el-element-overlay">
            <!-- Modal -->
            <div
                class="modal"
                id="modal_rutina"
                tabindex="-1"
                aria-labelledby="modalCenterTitle"
                aria-hidden="false"
                data-backdrop="false"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="modificar">
                                {{ __("tfg.routines.edit") }}
                            </h4>
                            <h4 class="modal-title" v-else>
                                {{ __("tfg.routines.create") }}
                            </h4>
                            <button
                                type="button"
                                class="close"
                                v-on:click="closeModal()"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- <div v-if="routine.image") class="my-4">
                                <img
                                    class="rounded mx-auto d-block"
                                    src="/storage/routines/image_26.jpg"
                                    style="max-height: 100px; max-width: 300px"
                                />
                            </div> -->
                            <div>
                                <label for="name"
                                    >{{ __("tfg.forms.fields.name") }}:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    v-model="routine.name"
                                    :class="errors.name ? 'is-invalid' : ''"
                                />
                                <div
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                >
                                    {{ errors.name[0] }}
                                </div>
                            </div>
                            <div class="my-4">
                                <label for="type"
                                    >{{ __("tfg.forms.fields.type") }}:
                                </label>
                                <select
                                    v-model="routine.routine_type_id"
                                    name="type"
                                    id="type"
                                    class="form-control"
                                >
                                    <option disabled value=""></option>
                                    <option
                                        v-for="routineType in routineTypes.data"
                                        :key="routineType.id"
                                        :value="routineType.id"
                                        >{{ routineType.name }}</option
                                    >
                                </select>
                            </div>
                            <div class="my-4">
                                <label for="description">
                                    {{ __("tfg.forms.fields.description") }}:
                                </label>
                                <small>{{
                                    __("tfg.forms.small.description-info")
                                }}</small>
                                <textarea
                                    maxlength="600"
                                    name="description"
                                    id="description"
                                    cols="50"
                                    rows="8"
                                    class="form-control"
                                    v-model="routine.description"
                                    :class="
                                        errors.description ? 'is-invalid' : ''
                                    "
                                ></textarea>
                                <div
                                    v-if="errors.description"
                                    class="invalid-feedback"
                                >
                                    {{ errors.description[0] }}
                                </div>
                            </div>

                            <div class="my-4">
                                <label for="image">
                                    {{ __("tfg.forms.fields.image") }}:
                                </label>
                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    class="dropify"
                                    ref="image"
                                    v-on:change="getImage"
                                    :class="errors.image ? 'is-invalid' : ''"
                                />
                                <div
                                    v-if="errors.image"
                                    class="invalid-feedback d-block"
                                >
                                    {{ errors.image[0] }}
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button
                                type="button"
                                v-on:click="closeModal()"
                                class="btn btn-danger"
                            >
                                {{ __('tfg.buttons.cancel') }}
                            </button>
                            <button
                                v-on:click="save()"
                                type="button"
                                class="btn btn-success"
                            >
                                {{ __('tfg.buttons.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                v-for="routine in laravelData.data"
                :key="routine.id"
                class="col-lg-3 col-md-6"
            >
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1">
                            <img
                                :src="routine.image"
                                class="rounded mx-auto d-block"
                                style="height: 250px; width: auto"
                            />
                            <div class="el-overlay">
                                <ul class="el-info">
                                    <li>
                                        <a
                                            type="button"
                                            class="btn btn-dark"
                                            v-on:click="
                                                modifcar = true;
                                                openModal(false, routine);
                                            "
                                        >
                                            <i class="icon-pencil"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            v-on:click="destroy(routine.id)"
                                            class="btn btn-danger"
                                        >
                                            <i class="icon-trash"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="el-card-content">
                            <p>
                                <strong>{{ routine.name }}</strong>
                            </p>
                            <small>{{
                                routine.description.substring(0, 50) + "..."
                            }}</small>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="float-right">
            <pagination
                :data="laravelData"
                @pagination-change-page="getResults"
                align="right"
            ></pagination>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            routines: {},
            routine: {
                name: "",
                routine_type_id: 1,
                image: "",
                description: ""
            },
            routineTypes: {},
            laravelData: {},
            modificar: false,
            id: 0,
            errors: {}
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        getImage: function() {
            this.routine.image = this.$refs.image.files[0];
        },
        async getResults(page = 1) {
            axios.get("/cmsapi/routines?page=" + page).then(response => {
                this.laravelData = response.data;
            });
        },
        async save() {
            this.getImage();
            let data = new FormData();
            data.append("name", this.routine.name);
            data.append("description", this.routine.description);
            data.append("routine_type_id", this.routine.routine_type_id);
            data.append("image", this.routine.image ? this.routine.image : "");
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            };
            if (this.modificar) {
                axios
                    .put("/cmsapi/routines/" + this.id, data, config)
                    .then(response => {
                        this.closeModal();
                        this.getResults();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            } else {
                axios
                    .post("/cmsapi/routines", data, config)
                    .then(response => {
                        this.closeModal();
                        this.getResults();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
            this.errors = {};
            this.routine.image = "";
            $(".image").click();
        },
        async destroy(id) {
            axios.delete("/cmsapi/routines/" + id);
            this.getResults();
        },
        openModal: function(nuevo, data = {}) {
            if (nuevo) {
                this.id = 0;
                this.routine.name = "";
                this.routine_type_id = 0;
                this.routine.description = "";
                this.routine.image = "";
            } else {
                this.id = data.id;
                this.routine.name = data.name;
                this.routine_type_id = data.routine_type_id;
                this.routine.description = data.description;
                this.routine.image = data.image;
                $("#image").attr("data-default-file", this.routine.image);
                $(".dropify").dropify();
            }
            axios.get("/cmsapi/routineTypes").then(response => {
                this.routineTypes = response.data;
            });
            $("#modal_rutina").modal("show");
        },
        closeModal: function() {
            var event = $("#image").dropify();
            event = event.data("dropify");
            event.resetPreview();
            event.clearElement();
            $("#modal_rutina").modal("hide");
            this.routine.image = "";
            this.errors = {};
        }
    },
    created() {
        this.getResults();
        axios.get("/cmsapi/routineTypes").then(response => {
            this.routineTypes = response.data;
        });
    }
};
</script>
<style></style>
