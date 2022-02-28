var generarIdUnicoFecha = ()=>{
    let fecha = new Date();
    return Math.floor(fecha.getTime()/1000).toString(16);
};
var appSistema = new Vue({
    el: '#appAcademica',
    data: {
        forms:{
            'alumno':{mostrar:false},
            'materia':{mostrar:false},
            'inscribir':{mostrar:false}
        }
    },
});
document.addEventListener('DOMContentLoaded', e=>{
    let formularios = document.querySelectorAll('.mostrar').forEach(formulario=>{
        formulario.addEventListener('click', evento=>{
            let formulario = evento.target.dataset.form;
            appSistema.forms[formulario].mostrar = true;
        });
    });
});