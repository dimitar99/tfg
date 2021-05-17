<template>
    <div class="row el-element-overlay">
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
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __("tfg.routines.new") }}
                                    </div>

                                    <div class="card-body">
                                        <div class="form">
                                            <label for="name"
                                                >Nombre:
                                            </label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                id="name"
                                                v-model="routine.name"
                                                placeholder="Pecho con mancuernas"
                                                value="{{ old('name', $routine->name) }}"
                                            />
                                        </div>
                                    </div>
                                </div>
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
                            Guardar</button
                        >1
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
                                    <a class="btn btn-success"
                                        ><i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a type="button" class="btn btn-dark">
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
</template>
<script>
export default {
    data() {
        return {
            routines: {},
            routine:{
                name: "",
                description: "",

            },
            laravelData: {},
            modificar: false,
            tituloModal: "",
            id: 0,
            errors: {}
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        async getResults(page = 1) {
            axios.get("/cmsapi/routines?page=" + page).then(response => {
                this.laravelData = response.data;
            });
        }
    },
    created() {
        this.getResults();
    }
};
</script>
<style></style>
