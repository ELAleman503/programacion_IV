Vue.component('inscribir',{
    data:() => {
        return {
            buscar:'',
            materias:[],
            alumnos:[],
            inscripciones:[],
            ciclos: ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'],
            inscripcion:{
                accion : 'nuevo',
                mostrar_msg : false,
                msg : '',
                num_materias: null,
                ciclo: '',
                idInscripcion : '',
                idAlumno : '',
                alumno : '',
                idMateria : [],
                materias : []
            }
        }
    },
    methods:{
        buscandoInscripcion(){
            this.obtenerInscripciones(this.buscar);
        },
        eliminarInscripcion(inscripcion){
            if( confirm(`Esta seguro de eliminar la inscripcion de ${inscripcion.alumno}?`) ){
                this.inscripcion.idInscripcion = inscripcion.idInscripcion;
                this.inscripcion.accion = 'eliminar';
                this.guardarInscripcion();
            }
        },
        modificarInscripcion(datos){
            this.inscripcion = JSON.parse(JSON.stringify(datos));
            this.inscripcion.accion = 'modificar';
        },
        guardarInscripcion(){
            this.obtenerInscripciones();
            let inscripciones = JSON.parse(localStorage.getItem('inscripciones')) || [];
            if (this.inscripcion.accion == 'nuevo') {
                console.log('nuevo');
                this.inscripcion.idInscripcion = generarIdUnicoFecha();
                inscripciones.push(this.inscripcion);
                let alumno = this.alumnos.find(alumno => alumno.idAlumno == this.inscripcion.idAlumno);
                this.inscripcion.alumno = alumno.nombre;
                let materias = this.materias.filter(materia => this.inscripcion.idMateria.includes(materia.idMateria));
                this.inscripcion.materias = materias.map(materia => materia.nombre);
            } else if (this.inscripcion.accion == 'modificar') {
                console.log('modificar');
                inscripciones.forEach(function(inscripcion, index){
                    if (inscripcion.idInscripcion == this.inscripcion.idInscripcion) {
                        inscripciones[index] = this.inscripcion;
                    }
                }, this);
                let materias = this.materias.filter(materia => this.inscripcion.idMateria.includes(materia.idMateria));
                this.inscripcion.materias = materias.map(materia => materia.nombre);
            } else if (this.inscripcion.accion == 'eliminar') {
                inscripciones.forEach(function(inscripcion, index){
                    if (inscripcion.idInscripcion == this.inscripcion.idInscripcion) {
                        inscripciones.splice(index, 1);
                    }
                }, this);
            }
            localStorage.setItem('inscripciones', JSON.stringify(inscripciones));
            this.nuevaInscripcion();
            this.obtenerInscripciones();
            this.obtenerAlumnos();
            this.inscripcion.msg = 'Inscripcion guardada correctamente';
        },
        comprobarCantidad() {
            if (this.inscripcion.idMateria.length > this.inscripcion.num_materias) {
                this.inscripcion.msg = 'No puede seleccionar mas materias de las que se ingresaron';
                this.inscripcion.mostrar_msg = true;
                this.inscripcion.idMateria = this.inscripcion.idMateria.slice(0, this.inscripcion.num_materias);
            } else {
                this.inscripcion.mostrar_msg = false;
            }
        },
        obtenerMaterias(valor=''){
            this.materias = [];
            let materias = JSON.parse(localStorage.getItem('materias')) || [];
            this.materias = materias.filter(materia=>materia.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
        },
        obtenerAlumnos(valor=''){
            this.alumnos = [];
            let alumnos = JSON.parse(localStorage.getItem('alumnos')) || [];
            this.alumnos = alumnos.filter(alumno=>alumno.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
            let inscripciones = JSON.parse(localStorage.getItem('inscripciones')) || [];
            this.alumnos = this.alumnos.filter(alumno=>!inscripciones.find(inscripcion=>inscripcion.idAlumno==alumno.idAlumno));
        },
        obtenerInscripciones(valor=''){
            this.inscripciones = [];
            let inscripciones = JSON.parse(localStorage.getItem('inscripciones')) || [];
            this.inscripciones = inscripciones.filter(inscrito=>inscrito.alumno.toLowerCase().indexOf(valor.toLowerCase())>-1);
        },
        nuevaInscripcion(){
            this.inscripcion.accion = 'nuevo';
            this.inscripcion.msg = '';
            this.inscripcion.mostrar_msg = false;
            this.inscripcion.num_materias = null;
            this.inscripcion.ciclo = '';
            this.inscripcion.idAlumno = '';
            this.inscripcion.alumno = '';
            this.inscripcion.idMateria = [];
            this.inscripcion.materias = [];
            this.obtenerMaterias();
            this.obtenerAlumnos();
        }
    },
    created(){
        this.obtenerMaterias();
        this.obtenerAlumnos();
        this.obtenerInscripciones();
    },
    template:`
    <div class="appAcademica" id="appAcademica">

        <div class="container-fluid">
            <div class="card text-white" id="carCliente">
                <div class="card-header bg-primary">
                    Registro de Inscripciones

                    <button type="button" class="btn-close text-end" data-bs-dismiss="alert" data-bs-target="#carCliente" aria-label="Close"></button>
                </div>
                <div class="card-body text-dark">
                    <form method="post" @submit.prevent="guardarInscripcion" @reset="nuevaInscripcion">
                        <div class="row p-1">
                            <div class="col col-md-3">Alumno:</div>
                            <div class="col col-md-6">
                                <select class="form-control" v-model="inscripcion.idAlumno" v-bind:disabled="inscripcion.accion != 'nuevo'" required title="Seleccione al alumno">
                                    <option v-for="alumno in alumnos" :value="alumno.idAlumno">{{ alumno.codigo }} - {{alumno.nombre}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1" v-if="inscripcion.accion == 'modificar'">
                            <div class="col col-md-3">Modificando a:</div>
                            <div class="col col-md-6">{{ inscripcion.alumno }}</div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-3">Ciclo:</div>
                            <div class="col col-md-6">
                                <select class="form-control" v-model="inscripcion.ciclo" required title="Seleccione el ciclo">
                                    <option v-for="ciclo in ciclos" :value="ciclo">{{ ciclo }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-3">Cantidad de Materias:</div>
                            <div class="col col-md-6">
                                <input type="text" class="form-control" v-model="inscripcion.num_materias" pattern="[1-5]{1}" title="Numeros del 1 al 5" placeholder="1-5"/>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-3">Lista de Materia:</div>
                            <div class="col col-md-6">
                                <select class="form-control" v-model="inscripcion.idMateria" multiple @change="comprobarCantidad" required title="Seleccione las materias">
                                    <option v-for="materia in materias" :value="materia.idMateria">{{ materia.codigo }} - {{materia.nombre}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col col-md-5 text-center">
                                <div v-if="inscripcion.mostrar_msg" class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{ inscripcion.msg }}
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
                    Busqueda de Inscripciones

                    <button type="button" class="btn-close" data-bs-dismiss="alert" data-bs-target="#carBuscarMateria" aria-label="Close"></button>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th colspan="8">
                                    Buscar: <input @keyup="buscandoInscripcion" v-model="buscar" placeholder="buscar aqui" class="form-control" type="text" >
                                </th>
                            </tr>
                            <tr>
                                <th>Alumno</th>
                                <th>Materia</th>
                                <th>Ciclo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in inscripciones" @click='modificarInscripcion( item )' :key="item.idInscripcion">
                                <td>{{item.alumno}}</td>
                                <td>
                                    <li v-for="materias in item.materias">
                                        {{ materias }}
                                    </li>
                                </td>
                                <td>{{item.ciclo}}</td>
                                <td>
                                    <button class="btn btn-danger" @click="eliminarInscripcion(item)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    `
});