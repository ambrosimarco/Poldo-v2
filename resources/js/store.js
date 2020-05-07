import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    panini :[
        {
          id: 1,
          nome: 'Piadina cotto',
          ingredienti: ['prosciutto cotto'],
          prezzo: 2.00,
          numero: 0,
          stato: 'caldo'
        },
        {
          id: 2,
          nome: 'Maxi pizza',
          ingredienti: ['pomodoro','mozzarella'],
          prezzo: 2.00,
          numero: 0,
          stato: 'caldo'
        },
        {
          id: 3,
          nome: 'Focaccia',
          ingredienti: ['prosciutto cotto'],
          prezzo: 1.30,
          numero: 0,
          stato: 'freddo'
        }
    ],
    sortby: 1,
    filter: "tutti"
  },
  mutations: {
    increment (state,payload) {
        let newid = payload;
      const panino = state.panini.find(panino => newid === panino.id);
      panino.numero++;
    },
    decrease (state,payload){
        let newid = payload;
        const panino = state.panini.find(panino => newid === panino.id);
        if(panino.numero!=0){
            panino.numero--;
        }
    },
    sortby(state,payload){
      state.sortby=payload;
    },
    filter(state,payload){
      state.filter=payload;
    },
    loaddata(state,payload){
      state.panini=payload;
    }
  },
  actions:{
    increment(context,payload){
        context.commit('increment',payload);
    },
    decrease(context,payload){
        context.commit('decrease',payload);
    },
    sortby(context,payload){
      context.commit('sortby',payload);
    },
    filter(context,payload){
      context.commit('filter',payload);
    },
    loaddata(context){
      Vue.axios.get('http://localhost:8000/api/sandwiches').then(response => (context.commit('loaddata',response)));
    }
  },
  getters: {
    getpanini(state) {
      return state.panini;
    },
    getsortedpanini(state) {
      let sortedpanini=[];
      let by=state.sortby;
      switch(by){
        case "1":
          sortedpanini=state.panini.sort((a, b) => {
            return a.nome.localeCompare(b.nome);
          });
          break;
        case "2":
          sortedpanini=state.panini.sort((a, b) => {
            return b.nome.localeCompare(a.nome);
          });
          break;
        case "3":
          sortedpanini=state.panini.sort((a, b) => {
            return a.prezzo-b.prezzo;
          });
          break;
        case "4":
          sortedpanini=state.panini.sort((a, b) => {
            return b.prezzo-a.prezzo;
          });
          break;
        default:
          sortedpanini=state.panini.sort((a, b) => {
            return a.nome.localeCompare(b.nome);
          });
          break;
      }
      return sortedpanini;
    },
    getfilteredpanini(state,getters){
      let sortedpanini=getters.getsortedpanini;
      let filteredpanini=[];
      let filter=state.filter;
      switch(filter){
        case "tutti":
          filteredpanini=sortedpanini;
          break;
        case "caldi":
          filteredpanini=sortedpanini.filter((a) => {
            return a.stato==="caldo";
          });
          break;
        case "freddi":
          filteredpanini=sortedpanini.filter((a) => {
            return a.stato==="freddo";
          });
          break;
        default:
          filteredpanini=sortedpanini;
          break;
      }
      return filteredpanini;
    }
  }
})
export default store;