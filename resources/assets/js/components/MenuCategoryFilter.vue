<template>
    <div>
<<<<<<< HEAD
            {{categories}}
=======
>>>>>>> master
     <list-filter-item
          v-for="(row,index) in categories" 
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
    categories() {
      return this.$store.getters.listCategories;
    },
    appPath() {
      return this.$store.getters.appPath;
    }
  },
  mounted() {
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