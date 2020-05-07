import Vue from 'vue'
import App from './App.vue'
import store from './store.js'
import router from './route.js'

const app = new Vue({
  el:"#app",
  render: h => h(App),
  store,
  router
});

export default app;