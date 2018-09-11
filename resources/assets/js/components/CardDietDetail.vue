
<template>
    <div class="card">
        <img class="card-img-top" v-bind:src="diet.image" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title text-center title-diet" >{{diet.description}}</h2>
            <p class="text-center justify-content-center"><a v-bind:href="'search/c='+diet.search" class="link-green">Ver todos</a></p>
        </div>
    </div>
</template>

<script>
export default {
    props: ["diet"],
    
  data() {
    return {
      
    };
  },
  mounted() {
    console.log("Component mounted card diet.");
  },
  methods: {}
};
</script>