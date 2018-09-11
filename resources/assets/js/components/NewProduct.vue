<template>
    <div>
        <div class="row justify-content-center">
            <div class='col-lg-4 col-xs-6 col-md-6' v-for="diet in diets" :key="diet.id">
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
  computed: {
    diets() {
      return this.$store.getters.diets;
    }
  },
  mounted() {
 
  },
  methods: {}
};
</script>