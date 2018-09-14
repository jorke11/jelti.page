
<template>
    <div>
        <div v-for="category in categories" :key="category.id" >
            <li class="list-group-item"><a class="link-white" v-bind:href="'\search/c='+category.slug+''">{{category.description.toUpperCase()}}</a></li>
        </div>
    </div>
</template>

<script>
export default {
 computed: {
    categories() {
        return this.$store.getters.categories;
    }
  },
  mounted() {
   this.$store.dispatch("getCategories");
    console.log("Component mounted card diets menu.");
  },

  methods: {}
};
</script>