import '@babel/polyfill'
import 'mutationobserver-shim'
import Vue from 'vue'
import './plugins/bootstrap-vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import store from './store'
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

Vue.config.productionTip = false

store.dispatch('Auth/checkToken').then(() => {
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
});
