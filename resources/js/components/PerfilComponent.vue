<template>
    <div class="container-fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="bg-white p-3 col-md-12 rounded mb-3">
                    <v-select :options="usuarios" label="label" v-model="usuario" @input="cargarUsuario" @change="cargarUsuario">
                        <template #option="{ imagen, name, usuario }">
                            <div class="row">
                                <div class="col-md-2">
                                    <img :src="imagen" alt="title" class="img-fluid rounded-circle"/>
                                </div>
                                <div class="col-md-10">
                                    <h3 style="margin: 0">{{ name }}</h3>
                                    <em><em>@</em>{{ usuario }}</em>
                                </div>
                            </div>
                        </template>
                    </v-select>
                </div>
                <div class="bg-white p-3 col-md-12 rounded" v-if="mostrar">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-4">
                            <img :src="usuario.imagen" class="img-fluid rounded-circle img-thumbnail" :alt="usuario.name" />
                        </div>
                        <div class="col-md-8 d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-md-2 text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <div class="col-md-10">
                                    <h3 style="margin: 0">{{ usuario.name }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                </div>
                                <div class="col-md-10">
                                    <em>{{ usuario.usuario }}</em>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                </div>
                                <div class="col-md-10">
                                    <em>{{ usuario.email }}</em>
                                </div>
                            </div>
                            <div class="row" v-if="solicitud.send">
                                <div class="col-md-12">
                                    <div class="alert alert-success" role="alert" :class="{ 'alert-dismissible': solicitud.dismissible }">
                                        <strong>{{ solicitud.mensaje }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-4" v-if="!usuario.solicitud && !usuario.recibido && !usuario.amigo">
                            <button class="btn btn-primary" @click="enviarSolicitud">Enviar solicitud</button>
                        </div>
                        <div class="col-md-4" v-else-if="usuario.solicitud && !usuario.recibido">
                            <button class="btn btn-primary" @click="cancelarSolicitud">Cancelar solicitud</button>
                        </div>
                        <div class="col-md-4" v-else-if="usuario.recibido">
                            <button class="btn btn-primary" @click="aceptarSolicitud">Aceptar solicitud</button>
                        </div>
                        <div class="col-md-4" v-if="usuario.recibido">
                            <button class="btn btn-primary" @click="rechazarSolicitud">Rechazar solicitud</button>
                        </div>
                        <div class="col-md-4" v-if="usuario.amigo">
                            <button class="btn btn-primary" @click="eliminarAmigo">Eliminar amigo</button>
                        </div>
                        <div class="col-md-4" v-if="usuario.amigo">
                            <button class="btn btn-primary" @click="enviarMensaje">Enviar mensaje</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    
    export default {
        components: {
            'v-select': VueSelect
        },
        data() {
            return {
                usuarios: [],
                mostrar: false,
                usuario: {},
                solicitud: {
                    send: false,
                    mensaje: '',
                    dismissible: false
                },
            }
        },
        methods: {
            obtenerUsuarios() {
                queries('get', 'usuarios', {})
                    .then(response => {
                        this.usuarios = response;
                        this.usuarios.map(usuario => {
                            return usuario.label = usuario.name + ' @' + usuario.usuario;
                        });
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            enviarSolicitud() {
                queries('post', 'solicitudes', {usuario: this.usuario.id})
                    .then(response => {
                        this.solicitud.send = true;
                        this.solicitud.mensaje = response.mensaje;
                        this.solicitud.dismissible = response.dismissible;
                        this.usuario.solicitud = true;
                        setTimeout(() => {
                            this.solicitud.send = false;
                        }, 3000);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            cancelarSolicitud() {
                queries('delete', '/delsolicitudes', {usuario: this.usuario.id, enviado: true})
                    .then(response => {
                        this.solicitud.send = true;
                        this.solicitud.mensaje = response.mensaje;
                        this.solicitud.dismissible = response.dismissible;
                        this.usuario.solicitud = false;
                        setTimeout(() => {
                            this.solicitud.send = false;
                        }, 3000);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            aceptarSolicitud() {
                queries('post', 'amigos', {usuario: this.usuario.id})
                    .then(response => {
                        this.solicitud.send = true;
                        this.solicitud.mensaje = response.mensaje;
                        this.solicitud.dismissible = response.dismissible;
                        this.usuario.recibido = false;
                        this.usuario.amigo = true;
                        setTimeout(() => {
                            this.solicitud.send = false;
                        }, 3000);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            rechazarSolicitud() {
                queries('delete', '/delsolicitudes', {usuario: this.usuario.id, enviado: false})
                    .then(response => {
                        this.solicitud.send = true;
                        this.solicitud.mensaje = response.mensaje;
                        this.solicitud.dismissible = response.dismissible;
                        this.usuario.recibido = false;
                        setTimeout(() => {
                            this.solicitud.send = false;
                        }, 3000);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            eliminarAmigo() {
                queries('delete', '/delamigos', {usuario: this.usuario.id})
                    .then(response => {
                        this.solicitud.send = true;
                        this.solicitud.mensaje = response.mensaje;
                        this.solicitud.dismissible = response.dismissible;
                        this.usuario.amigo = false;
                        console.log(response);
                        setTimeout(() => {
                            this.solicitud.send = false;
                        }, 3000);
                    }).catch(error => {
                        console.log(error);
                    }
                );
            },
            enviarMensaje() {
                this.$root.$emit('abrirTab', {tab: 'main', props: this.usuario});
            },
            cargarUsuario() {
                this.mostrar = true;
            },
        },
        mounted() {
            this.obtenerUsuarios();
        },
    }
</script>