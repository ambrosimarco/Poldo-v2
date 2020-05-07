<template>
  <div class="container bg-white" style="margin-top: 80px; margin-bottom: 80px; padding-bottom: 2%;">
    <div class="btn-toolbar" role="toolbar">
      <div class="dropdown">
        <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
           Ordina per:
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" @click="ordina('1')">Nome crescente</a>
          <a class="dropdown-item" href="#" @click="ordina('2')">Nome decrescente</a>
          <a class="dropdown-item" href="#" @click="ordina('3')">Prezzo crescente</a>
          <a class="dropdown-item" href="#" @click="ordina('4')">Prezzo decrescente</a>
        </div>
      </div>
      <div class="dropdown">
        <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
          Visualizza panini:
        </button>

        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" @click="filter('tutti')">Tutti</a>
          <a class="dropdown-item" href="#" @click="filter('caldi')">Caldi</a>
          <a class="dropdown-item" href="#" @click="filter('freddi')">Freddi</a>
        </div>
      </div>
    </div>
    <hr>
    <div v-for='panino in panini' v-bind:key='panino.id'>
    <panino v-bind:panino="panino"/>
    </div>
    <hr>
    <footer class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">&COPY; 2020 | Lorenzoni - Ambrosi - Du | Al Bar Poldo</a>
        </footer>
  </div>
</template>

<script>
import panino from './panino.vue';
export default {
  name: 'lista',
  computed:{
    panini(){
      return this.$store.getters['getfilteredpanini'];
    }
  },
  methods: {
    ordina(text){
      this.$store.dispatch('sortby',text);
    },
    filter(text){
      this.$store.dispatch('filter',text);
    }
  },
  components: {
    panino
  }
}
</script>


<style scoped>

</style>
