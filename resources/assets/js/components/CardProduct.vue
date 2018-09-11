
<template>
  <div class="panel panel-default">
                <div class="panel-heading">Publicado en</div>
                <div class="panel-body">
                </div>
    </div>

</template>

<script>
export default {
  
  data() {
    return {
      param:''
    }
  },
  mounted() {
    console.log(this.param)
    this.$store.dispatch("getListProduct");
    console.log("Component mounted.");
  }
};
</script>
