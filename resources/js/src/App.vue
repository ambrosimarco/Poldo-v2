<template>
  <p>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
      <a class="navbar-brand" href="#">Poldo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <router-link to="/"><a class="nav-link">home</a></router-link>
          </li>
        </ul>
      </div>
    </nav>
    <router-view></router-view>
    <button type="button" class="btn btn-danger"><i class="fa fa-chevron-up"></i></button>
  </p>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>

</style>
