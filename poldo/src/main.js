import Vue from 'vue'
import App from './App.vue'
import store from './store.js'
import router from './route.js'
Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  store,
  router,
  created(){
    this.$store.dispatch('loaddata');
  }
}).$mount('#app')
