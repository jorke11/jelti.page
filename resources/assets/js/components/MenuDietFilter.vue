<template>
    <div>
        <list-filter :listData="diets"/>
    </div>
</template>

<script>
import listFilter from "./ListFilter.vue";

export default {
  components: {
    "list-filter": listFilter
  },
  computed: {
    diets() {
      return this.$store.getters.diets;
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