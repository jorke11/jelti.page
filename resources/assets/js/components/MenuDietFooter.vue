
<template>
    <div>
        <div v-for="diet in diets" :key="diet.id" >
            <li class="list-group-item"><a class="link-white" v-bind:href="'search/c='+diet.slug+''">{{diet.description.toUpperCase()}}</a></li>
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
    //this.$store.dispatch("getDiets");
    console.log("Component mounted card diets menu.");
  },

  methods: {}
};
</script>