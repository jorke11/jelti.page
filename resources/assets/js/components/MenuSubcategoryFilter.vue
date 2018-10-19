<template>
    <div>
      {{subcategories}}
     <list-filter-item
          v-for="(row,index) in subcategories" 
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
    "list-filter-item":listFilterItem
  }, 
  
  computed: {
    subcategories() {
        return this.$store.getters.listSubcategories;
    },
    appPath() {
      return this.$store.getters.appPath;
    }
  },
  mounted() {
    this.$store.dispatch("getSubcategories");
    console.log("Component mounted card diets menu  asd.");
  },
  methods: {
    updateFilter(index, row) {
      console.log(row)
      console.log(this.$store.getters.diets);
    }
  }
};
</script>