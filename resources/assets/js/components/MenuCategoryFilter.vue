<template>
    <div>
        <list-filter :categories="categories"/>
    </div>
</template>

<script>
import listFilter from "./ListFilter.vue";

export default {
   components: {
    "list-filter":listFilter
  }, 
  computed: {
    categories() {
      return this.$store.getters.categories;
    },
    appPath() {
      return this.$store.getters.appPath;
    }
  },
  mounted() {
    console.log("Component mounted card diets menu.");
  },
  methods: {}
};
</script>