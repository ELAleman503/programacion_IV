Vue.component('alumno',{
    data:() => {
        return {
            buscar:'',
            alumnos:[],
            alumno:{
                accion : 'nuevo',
                mostrar_msg : false,
                msg : '',
                codigo: '',
                nombre: '',
                fechaNacimiento: '',
                direccion: '',
                telefono: '',
                dui: ''
            }
        }
    },
    methods:{
        buscandoAlumno(){
            this.obtenerAlumnos(this.buscar);
        },
        eliminarAlumno(alumno){
            if( confirm(`Esta seguro de eliminar el alumno ${alumno.nombre}?`) ){
                this.alumno.idAlumno = alumno.idAlumno;
                this.alumno.accion = 'eliminar';
                this.guardarAlumno();
            }
        },
        modificarAlumno(datos){
            this.alumno = JSON.parse(JSON.stringify(datos));
            this.alumno.accion = 'modificar';
        },
        guardarAlumno(){
            this.obtenerAlumnos();
            let alumnos = JSON.parse(localStorage.getItem('alumnos')) || [];
            if(this.alumno.accion=="nuevo"){
                this.alumno.idAlumno = generarIdUnicoFecha();
                alumnos.push(this.alumno);
            } else if(this.alumno.accion=="modificar"){
                let index = alumnos.findIndex(alumno=>alumno.idAlumno==this.alumno.idAlumno);
                alumnos[index] = this.alumno;
            } else if( this.alumno.accion=="eliminar" ){
                let index = alumnos.findIndex(alumno=>alumno.idAlumno==this.alumno.idAlumno);
                alumnos.splice(index,1);
            }
            localStorage.setItem('alumnos', JSON.stringify(alumnos));
            this.nuevoAlumno();
            this.obtenerAlumnos();
            this.alumno.msg = 'Alumno procesado con exito';
        },
        obtenerAlumnos(valor=''){
            this.alumnos = [];
            let alumnos = JSON.parse(localStorage.getItem('alumnos')) || [];
            this.alumnos = alumnos.filter(alumno=>alumno.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
        },
        nuevoAlumno(){
            this.alumno.accion = 'nuevo';
            this.alumno.msg = '';
            this.alumno.codigo = '';
            this.alumno.nombre = '';
            this.alumno.fechaNacimiento = '';
            this.alumno.direccion = '';
            this.alumno.telefono = '';
            this.alumno.dui = '';
        }
    },
    created(){
        this.obtenerAlumnos();
    },
    template:`
        <div class="container-fluid">
            <div class="card text-white" id="carAlumno">
                <div class="card-header bg-primary">
                    Registro de Alumnos

                    <button type="button" class="btn-close text-end" data-bs-dismiss="alert" data-bs-target="#carAlumno" aria-label="Close"></button>
                </div>
                <div class="card-body text-dark">
                    <form method="post" @submit.prevent="guardarAlumno" @reset="nuevoAlumno">
                        <div class="row p-1">
                            <div class="col col-md-2">Codigo:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese el codigo" v-model="alumno.codigo" pattern="[0-9]{3,10}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Nombre:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese el nombre" v-model="alumno.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Fecha de Nacimiento:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese la fecha de nacimiento" v-model="alumno.fechaNacimiento" required type="date" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Direccion:</div>
                            <div class="col col-md-3">
                                <input title="Ingrese la direccion" v-model="alumno.direccion" pattern="[0-9#.A-Za-zñÑáéíóúü ]{3,100}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">Telefono:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese el tel" v-model="alumno.telefono" pattern="[0-9]{4}-[0-9]{4}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-2">DUI:</div>
                            <div class="col col-md-2">
                                <input title="Ingrese el DUI" v-model="alumno.dui" pattern="[0-9]{8}-[0-9]{1}" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-5 text-center">
                                <div v-if="alumno.mostrar_msg" class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{ alumno.msg }}
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
            <div class="card text-white" id="carBuscarAlumno">
                <div class="card-header bg-primary">
                    Busqueda de Alumnos

                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-bs-target="#carBuscarAlumno" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th colspan="7">
                                    Buscar: <input @keyup="buscandoAlumno" v-model="buscar" placeholder="buscar aqui" class="form-control" type="text" >
                                </th>
                            </tr>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>FECHA DE NACIMIENTO</th>
                                <th>DIRECCION</th>
                                <th>TEL</th>
                                <th>DUI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in alumnos" @click='modificarAlumno( item )' :key="item.idAlumno">
                                <td>{{item.codigo}}</td>
                                <td>{{item.nombre}}</td>
                                <td>{{item.fechaNacimiento}}</td>
                                <td>{{item.direccion}}</td>
                                <td>{{item.telefono}}</td>
                                <td>{{item.dui}}</td>
                                <td>
                                    
                                    <button class="btn btn-danger" @click="eliminarAlumno(item)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>`  
});