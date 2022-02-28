Vue.component('materia',{
    data:() => {
        return {
            buscar:'',
            dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
            materias:[],
            materia:{
                accion : 'nuevo',
                mostrar_msg : false,
                msg : '',
                codigo : '',
                nombre : '',
                docente : '',
                de : '',
                a : '',
                dia : '',
                aula : ''
            }
        }
    },
    methods:{
        buscandoMateria(){
            this.obtenerMaterias(this.buscar);
        },
        eliminarMateria(materia){
            if( confirm(`Esta seguro de eliminar el materia ${materia.nombre}?`) ){
                this.materia.idMateria = materia.idMateria;
                this.materia.accion = 'eliminar';
                this.guardarMateria();
            }
        },
        modificarMateria(datos){
            this.materia = JSON.parse(JSON.stringify(datos));
            this.materia.accion = 'modificar';
        },
        guardarMateria(){
            this.obtenerMaterias();
            let materias = JSON.parse(localStorage.getItem('materias')) || [];
            if(this.materia.accion=="nuevo"){
                this.materia.idMateria = generarIdUnicoFecha();
                materias.push(this.materia);
            } else if(this.materia.accion=="modificar"){
                let index = materias.findIndex(materia=>materia.idMateria==this.materia.idMateria);
                materias[index] = this.materia;
            } else if( this.materia.accion=="eliminar" ){
                let index = materias.findIndex(materia=>materia.idMateria==this.materia.idMateria);
                materias.splice(index,1);
            }
            localStorage.setItem('materias', JSON.stringify(materias));
            this.nuevaMateria();
            this.obtenerMaterias();
            this.materia.msg = 'Materia procesado con exito';
        },
        obtenerMaterias(valor=''){
            this.materias = [];
            let materias = JSON.parse(localStorage.getItem('materias')) || [];
            this.materias = materias.filter(materia=>materia.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
        },
        nuevaMateria(){
            this.materia.accion = 'nuevo';
            this.materia.msg = '';
            this.materia.mostrar_msg = false;
            this.materia.codigo = '';
            this.materia.nombre = '';
            this.materia.docente = '';
            this.materia.de = '';
            this.materia.a = '';
            this.materia.dia = '';
            this.materia.aula = '';
        }
    },
    created(){
        this.obtenerMaterias();
    },
    template:`
        <div class="container-fluid">
            <div class="card text-white" id="carMateria">
                <div class="card-header bg-primary">
                    Registro de Materias

                    <button type="button" class="btn-close text-end" data-bs-dismiss="alert" data-bs-target="#carMateria" aria-label="Close"></button>
                </div>
                <div class="card-body text-dark">
                    <form method="post" @submit.prevent="guardarMateria" @reset="nuevaMateria">
                        <div class="row p-1">
                            <div class="col col-md-2">Codigo:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese el codigo" v-model="materia.codigo" pattern="[0-9]{3,10}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Nombre:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese el nombre" v-model="materia.nombre" pattern="[A-Za-zñÑáéíóúü .#0-9_]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Docente:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese el docente" v-model="materia.docente" pattern="[A-Za-zñÑáéíóúü .]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">De:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese la hora de inicio" v-model="materia.de" required type="time" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">A:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese la hora de finalizacion" v-model="materia.a" required type="time" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Dia:</div>
                            <div class="col col-md-2">
                                <select title="Seleccione el dia" v-model="materia.dia" required class="form-control">
                                    <option value="">Seleccione una opcion</option>
                                    <option v-for="dia in dias" :value="dia">{{dia}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Aula:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese el aula" v-model="materia.aula" pattern="[A-Za-zñÑáéíóúü .#0-9_]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-5 text-center">
                                <div v-if="materia.mostrar_msg" class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{ materia.msg }}
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
            <div class="card text-white" id="carBuscarMateria">
                <div class="card-header bg-primary">
                    Busqueda de Materias

                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-bs-target="#carBuscarMateria" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th colspan="8">
                                    Buscar: <input @keyup="buscandoMateria" v-model="buscar" placeholder="buscar aqui" class="form-control" type="text" >
                                </th>
                            </tr>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Docente</th>
                                <th>De</th>
                                <th>A</th>
                                <th>Dia</th>
                                <th>Aula</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in materias" @click='modificarMateria( item )' :key="item.idMateria">
                                <td>{{item.codigo}}</td>
                                <td>{{item.nombre}}</td>
                                <td>{{item.docente}}</td>
                                <td>{{item.de}}</td>
                                <td>{{item.a}}</td>
                                <td>{{item.dia}}</td>
                                <td>{{item.aula}}</td>
                                <td>
                                    <button class="btn btn-danger" @click="eliminarMateria(item)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>`
});