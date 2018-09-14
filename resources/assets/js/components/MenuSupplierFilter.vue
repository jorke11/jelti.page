<template>
    <div>
      <list-filter-item
          v-for="(row,index) in listSupplier" 
          :data="row"
          :key="row.id"
          @update="updateFilter(index, ...arguments)"
          />

    </div>
</template>

<script>
import listFilterItem from "./ListFilterItem.vue";

export default {
  components: {
    "list-filter-item": listFilterItem
  },
  computed: {
    listSupplier() {
      return this.$store.getters.listSupplier;
    },
    appPath() {
      return this.$store.getters.appPath;
    }
  },
  mounted() {
    this.$store.dispatch("getListSupplier");
  },
  methods: {
    updateFilter(index, row) {
       this.$emit("update",row);
    /*   let diets = this.$store.getters.listSupplier
        .filter(item => item.checked === true)
        .map(item => item.slug)
        .join("&");
      let categories = this.$store.getters.categories
        .filter(item => item.checked === true)
        .map(item => item.slug)
        .join("&");
        
      let diets = this.$store.getters.diets
        .filter(item => item.checked === true)
        .map(item => item.slug)
        .join("&");

      console.log(diets);
      console.log(categories); */
    }
  }
};
</script>