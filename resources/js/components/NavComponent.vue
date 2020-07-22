
<template>

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Ecommerce</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" :href="this.url">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li v-show="!isToken" class="nav-item">

          <a  class="nav-link" :href="this.url+'/register'">register</a>
          </li>
          <li v-if="!isToken" class="nav-item">
            <a class="nav-link" :href="this.url+'/login'">login</a>
          </li>
          <li v-else class="nav-item">
           <a class="nav-link" v-on:click='logout' href="#">log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</template>

<script>
export default {
    props: ['url'],
    data() {
        return {
            isToken: true,
        }
    },
    mounted() {


        if(Vue.$cookies.isKey('token'))
        {
            this.isToken = true;
        }
        else
        {
            this.isToken = false;
        }
    },
    methods: {
        logout: function()
        {
            Vue.$cookies.remove('token');
            this.isToken = false;
        }
    },
}
</script>
