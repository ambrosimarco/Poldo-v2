<template>
  <div class="media p-1">
  <img src="../img/pan1.jpg" class="media-object" style="width:65px; height:65px">
    <div class="media-body" style="margin-left: 10px; margin-bottom: auto;">
      <h4 class="media-heading">{{panino.name}}: {{panino.price}}€</h4>
      <div class="input-group">
      <input disabled :value="panino.description" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button type="button" class="btn btn-success" @click="increase()"><i class="fa fa-plus"></i></button>
          <div class="input-number input-number-adaptive"><input type="number"></div>
          <button type="button" class="btn btn-danger" @click="decrease()"><i class="fa fa-minus"></i></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'panino',
  props:['panino'],
  //methods: {
    //increase(){
      //this.$store.dispatch('increment',this.panino.id);
    //},
    //decrease(){
      //this.$store.dispatch('decrease',this.panino.id);
    //}
  //}
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>