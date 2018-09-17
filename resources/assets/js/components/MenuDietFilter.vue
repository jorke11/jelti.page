<template>
    <div>
        <list-filter-item
          v-for="(row,index) in diets" 
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
    diets() {
      return this.$store.getters.diets;
    },
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
  methods: {
     updateFilter(index,row){
        
        let diets = this.$store.getters.diets.filter(item=>item.checked===true).map(item=>item.slug).join("&")
        let categories = this.$store.getters.categories.filter(item=>item.checked===true).map(item=>item.slug).join("&")
        /* let subcategories = this.$store.getters.subcategories.filter(item=>item.checked===true).map(item=>item.slug).join("&")
        let suppliers = this.$store.getters.listSupplier.filter(item=>item.checked===true).map(item=>item.slug).join("&") */ 
        
        console.log("diet",diets);
        console.log("cat",categories);
        /* 
        console.log(subcategories);
        console.log(suppliers); */
            //this.thoughts[index]=thought
      }
  }
};
</script>