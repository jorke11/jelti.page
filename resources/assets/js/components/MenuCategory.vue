
<template>
    <div>
        <div v-for="category in categories" :key="category.id" >
            <a style="color:black" class="dropdown-item" v-bind:href="'/products/'+category.slug+''">{{category.description}}</a>
        </div>
    </div>
</template>

<script>
export default {
  computed: {
    categories() {
        return this.$store.getters.listCategories;
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