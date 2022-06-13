<template>
    <div class="container-fluid h-100">
        <div class="row m-0 justify-content-center h-100">
            <div class="col-md-12 h-100">
                <div class="bg-white h-100 p-3 col-md-12 rounded mb-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center">Solicitudes recibidas</h5>
                        </div>
                    </div>
                    <div v-for="solicitud in solicitudes.recibidas" class="list-group-item d-flex row align-items-center container-hover" :key="solicitud.id">
                        <div class="col-md-4">
                            <img :src="solicitud.imagen" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <span class="font-weight-bold fs-1-5">{{ solicitud.usuario }}</span>
                            <!-- botones para aceptar o rechazar la solicitud -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-success" @click="aceptarSolicitud(solicitud.id)">Aceptar</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-danger" @click="rechazarSolicitud(solicitud.id)">Rechazar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center">Solicitudes enviadas</h5>
                        </div>
                    </div>
                    <div v-for="solicitud in solicitudes.enviadas" class="list-group-item d-flex row align-items-center container-hover" :key="solicitud.id">
                        <div class="col-md-4">
                            <img :src="solicitud.imagen" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <span class="font-weight-bold fs-1-5">{{ solicitud.usuario }}</span>
                            <button class="btn btn-danger btn-sm" @click="cancelarSolicitud(solicitud.id)">Cancelar</button>
                        </div>
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
            solicitudes: {
                enviadas: [],
                recibidas: [],
            },
        }
    },
    methods: {
        conseguirSolicitudes() {
            queries('get', 'solicitudes')
            .then(response => {
                this.solicitudes.enviadas = response.enviadas;
                this.solicitudes.recibidas = response.recibidas;
            })
            .catch(error => {
                console.log(error);
            });
        },
        cancelarSolicitud(id) {
            queries('delete', '/delsolicitudes', {usuario: id, enviado: true})
                .then(response => {
                    this.solicitudes.enviadas = this.solicitudes.enviadas.filter(solicitud => solicitud.id != id);
                }).catch(error => {
                    console.log(error);
                }
            );
        },
        aceptarSolicitud(id) {
                queries('post', 'amigos', {usuario: id})
                    .then(response => {
                        this.solicitudes.recibidas = this.solicitudes.recibidas.filter(solicitud => solicitud.id != id);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            rechazarSolicitud(id) {
                queries('delete', '/delsolicitudes', {usuario: id, enviado: false})
                    .then(response => {
                        this.solicitudes.recibidas = this.solicitudes.recibidas.filter(solicitud => solicitud.id != id);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
    },
    mounted() {
        this.conseguirSolicitudes();
    },
}
</script>
