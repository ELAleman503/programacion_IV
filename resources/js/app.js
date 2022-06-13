/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', VueSelect);

window.queries = async (method = 'POST', url = '', data = null) => {
    const response = await axios({
        method,
        url,
        data: data,
    })
    .then(response => {
        return response.data;
    })
    .catch(error => {
        console.log(error);
        return {err: error.response.data, status: 'error'};
    });
    return response;
};
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('v-main', require('./components/MainComponent.vue').default);
Vue.component('v-buscar', require('./components/PerfilComponent.vue').default);
Vue.component('v-solicitud', require('./components/SolicitudesComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        prop: null,
        tabs: {
            main: {mostrar: true},
            buscar: {mostrar: false},
            solicitud: {mostrar: false},
        }
    },
    methods: {
        mostrarTab(tab, newprop = false) {
            this.tabs[tab].mostrar = true;
            for (let key in this.tabs) {
                if (key != tab) {
                    this.tabs[key].mostrar = false;
                }
            }
            if (!newprop) {
                this.prop = null;
            }
        },
        onFileChange(e, image_ref, input_ref) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.$refs[image_ref].src = e.target.result;
                this.$refs[input_ref].value = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    },
    beforeMount() {
        this.$root.$on('abrirTab', (data) => {
            console.log(data);
            if (data.props) {
                this.prop = data.props;
                this.mostrarTab(data.tab, true);
            } else {
                this.mostrarTab(data.tab);
            }
        });
    }
});
