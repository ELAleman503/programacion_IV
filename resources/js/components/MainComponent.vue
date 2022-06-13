<template>
    <div class="container-fluid h-100">
        <div class="row m-0 justify-content-center h-100">
            <div class="col-md-12 h-100">
                <div class="row h-100">
                    <div class="bg-light h-100 p-0 col-md-4 rounded">
                        <div v-for="sala in salas" class="list-group-item p-0 w-100 m-0 d-flex row align-items-center container-hover" :key="sala.id" @click="abrirSala(sala.detalle_salas, sala.id)">
                            <div class="col-md-4">
                                <img :src="sala.detalle_salas.imagen" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <span class="font-weight-bold fs-1-5">{{ sala.detalle_salas.usuario }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white h-100 p-0 col-md-8 rounded d-flex flex-column justify-content-between" v-if="sala != null">
                        <div class="row d-flex justify-content-center align-items-center bg-primary p-2 w-100 m-0 rounded">
                            <div class="col-md-2">
                                <img :src="sala.imagen" class="img-fluid" style="max-width: 50px;">
                            </div>
                            <div class="col-md-8 d-flex flex-row justify-content-end">
                                <span class="font-weight-bold fs-3 text-white">{{ sala.usuario }}</span>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center bg-primary p-2 w-100 rounded">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Escribe un mensaje..." v-model="mensaje" @keyup.enter="enviarMensaje">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        chat: {
            type: Object,
            required: false,
        },
    },
    data() {
        return {
            salas: [],
            mensajes: [],
            sala: null,
            mensaje: '',
        }
    },
    methods: {
        conseguirAmigos() {
            queries('get', 'salas')
            .then(response => {
                this.salas = response;
                this.salas.forEach(sala => {
                    if (sala.tipo_sala == 1) {
                        sala.detalle_salas = sala.detalle_salas[0];
                    }
                });
            })
            .catch(error => {
                console.log(error);
            });
        },
        abrirSala(sala, sala_id) {
            this.sala = sala;
            this.sala.id = sala_id;
            this.conseguirMensajes(sala.id);
        },
        conseguirMensajes(sala_id) {
            queries('get', 'mensajes/' + sala_id)
            .then(response => {
                this.mensajes = response;
            })
            .catch(error => {
                console.log(error);
            });
        },
        enviarMensaje() {
            //
        },
    },
    mounted() {
        this.conseguirAmigos();
        if (this.chat) {
            this.sala = this.chat;
        }
    },
}
</script>

<style>
.container-hover:hover {
    cursor: pointer;
    filter: brightness(0.9);
}
</style>