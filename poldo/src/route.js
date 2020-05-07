import Router from 'vue-router'
import Vue from 'vue'
import lista from './components/lista.vue'
Vue.use(Router)
const router=new Router({
    routes:[
        {
            path: '/',
            name: 'home',
            component: lista
        },
    ]
})
export default router;