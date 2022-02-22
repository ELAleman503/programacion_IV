Vue.component('lectura',{
    data:()=>{
        return {
            buscar:'',
            lecturas:[],
            lectura:{
                accion : 'nuevo',
                mostrar_msg : false,
                msg : '',
                idlectura : '',
                codigo: '',
                IdCliente: '',
                fecha: '',
                pago:'',
                
            }
        }
    },
    methods:{
        buscandolectura(){
            this.obtenerlecturas(this.buscar);
        },
        eliminarlectura(lectura){
            if( confirm(`Esta seguro de eliminar el lectura ${lectura.IdCliente}?`) ){
                this.lectura.accion = 'eliminar';
                this.lectura.idlectura = lectura.idlectura;
                this.guardarlectura();
            }
            this.nuevolectura();
        },
        modificarlectura(datos){
            this.lectura = JSON.parse(JSON.stringify(datos));
            this.lectura.accion = 'modificar';
        },
        guardarlectura(){
            this.obtenerlecturas();
            let lecturas = JSON.parse(localStorage.getItem('lecturas')) || [];
            if(this.lectura.accion=="nuevo"){
                this.lectura.idlectura = generarIdUnicoFecha();
                lecturas.push(this.lectura);
            } else if(this.lectura.accion=="modificar"){
                let index = lecturas.findIndex(lectura=>lectura.idlectura==this.lectura.idlectura);
                lecturas[index] = this.lectura;
            } else if( this.lectura.accion=="eliminar" ){
                let index = lecturas.findIndex(lectura=>lectura.idlectura==this.lectura.idlectura);
                lecturas.splice(index,1);
            }
            localStorage.setItem('lecturas', JSON.stringify(lecturas));
            this.nuevolectura();
            this.obtenerlecturas();
            this.lectura.msg = 'lectura procesado con exito';
        },
        obtenerlecturas(valor=''){
            this.lecturas = [];
            let lecturas = JSON.parse(localStorage.getItem('lecturas')) || [];
            this.lecturas = lecturas.filter(lectura=>lectura.IdCliente.toLowerCase().indexOf(valor.toLowerCase())>-1);
        },
        nuevolectura(){
            this.lectura.accion = 'nuevo';
            this.lectura.msg = '';
            this.lectura.idlectura = '';
            this.lectura.codigo = '';
            this.lectura.IdCliente = '';
            this.lecturas.fecha = '';
            this.lectura.pago = '';
        }
    },
    created(){
        this.obtenerlecturas();
    },
    template:`
        <div id="appCiente">
            <div class="card text-white" id="carlectura">
                <div class="card-header bg-primary">
                    Registro de lecturas

                    <button type="button" class="btn-close text-end" data-bs-dismiss="alert" data-bs-target="#carlectura" aria-label="Close"></button>
                </div>
                <div class="card-body text-dark">
                    <form method="post" @submit.prevent="guardarlectura" @reset="nuevolectura">
                        <div class="row p-1">
                            <div class="col col-md-2">Codigo:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese el codigo" v-model="lectura.codigo" pattern="[0-9]{3,10}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">IdCliente:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese el IdCliente" v-model="lectura.IdCliente" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">fecha:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese fecha" v-model="lectura.fecha" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">pago:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese el pago" v-model="lectura.pagp" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-5 text-center">
                                <div v-if="lectura.mostrar_msg" class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{ lectura.msg }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col col-md-5 text-center">
                                <input class="btn btn-success" type="submit" value="Guardar">
                                <input class="btn btn-warning" type="reset" value="Nuevo">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card text-white" id="carBuscarlectura">
                <div class="card-header bg-primary">
                    Busqueda de lecturas

                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-bs-target="#carBuscarlectura" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    Buscar: <input @keyup="buscandolectura" v-model="buscar" placeholder="buscar aqui" class="form-control" type="text" >
                                </th>
                            </tr>
                            <tr>
                                <th>CODIGO</th>
                                <th>IdCliente</th>
                                <th>fecha</th>
                                <th>pago</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in lecturas" @click='modificarlectura( item )' :key="item.idlectura">
                                <td>{{item.codigo}}</td>
                                <td>{{item.IdCliente}}</td>
                                <td>{{item.fecha}}</td>
                                <td>{{item.pago}}</td>
                                <td>
                                    <button class="btn btn-danger" @click="eliminarlectura(item)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    `
});