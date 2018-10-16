<template>
    <div>
         <div class="row center-block ml-0 mr-0 pl-0 pr-0" id="general-filters">
                        <div class="col-12 category-filter">
                            <ul class="list-group">
                                <li class="list-group-item category-filter-item"
                                    data-toggle="collapse" onclick="obj.eventCategory(null,'content-filter-categories')"><b>CATEGORIAS</b> ()
                                    <span style="float:right" id="plus-icon" class="d-none">
                                        <svg id="i-minus" viewBox="0 0 32 32" width="28" height="28" fill="black"  style="cursor:pointer"
                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M2 16 L30 16" />
                                        </svg>
                                    </span>
                                    <span style="float:right" id="minus-icon">
                                        <svg id="i-plus" viewBox="0 0 35 35" width="28" height="28" fill="black" stroke="#000000" 
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                        <path d="M16 2 L16 30 M2 16 L30 16" />
                                        </svg>

                                    </span>
                                </li>
                                <div id="content-filter-categories" class="collapse">
                                        <menu-category-filter @update="updateFilter(index, ...arguments)"/>
                                </div>
                            </ul>
                            <ul class="list-group">
                                <li class="list-group-item category-filter-item" 
                                    data-toggle="collapse" onclick="obj.eventCategory('subcat','content-subcategories')"><b>SUBCATEGORIAS</b> ()

                                    <span style="float:right" id="plus-icon-subcat">
                                        <svg id="i-plus" viewBox="0 0 35 35" width="28" height="28" fill="black" stroke="#000000" 
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                        <path d="M16 2 L16 30 M2 16 L30 16" />
                                        </svg>
                                    </span>
                                    <span style="float:right" id="minus-icon-subcat" class="d-none">
                                        <svg id="i-minus" viewBox="0 0 32 32" width="28" height="28" fill="black"  style="cursor:pointer"
                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M2 16 L30 16" />
                                        </svg>
                                    </span>

                                </li>
                                <div id="content-subcategories" class="collapse">
<<<<<<< HEAD
                                   <menu-subcategory-filter @update="updateFilter(index, ...arguments)"/>
=======
                                   
>>>>>>> master
                                </div>
                            </ul>
                            <ul class="list-group">
                                <li class="list-group-item category-filter-item"
                                    data-toggle="collapse" onclick="obj.eventCategory('sup','content-supplier')"><b>PROVEEDORES</b> ()
                                    <span style="float:right" id="plus-icon-sup">
                                        <svg id="i-plus" viewBox="0 0 35 35" width="28" height="28" fill="black" stroke="#000000" 
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                        <path d="M16 2 L16 30 M2 16 L30 16" />
                                        </svg>
                                    </span>
                                    <span style="float:right" id="minus-icon-sup" class="d-none">
                                        <svg id="i-minus" viewBox="0 0 32 32" width="28" height="28" fill="black"  style="cursor:pointer"
                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M2 16 L30 16" />
                                        </svg>
                                    </span></li>
                                <div id="content-supplier" class="collapse">
                                        <menu-supplier-filter @update="updateFilter(index, ...arguments)"/>
                                </div>
                            </ul>
                            <ul class="list-group" id="filter-diet">
                                <li class="list-group-item"  style=" border-bottom: 3px solid #ccd07b;margin-bottom: 20px;"
                                    data-toggle="collapse" onclick="obj.eventCategory('diet','content-dietas')"><b>DIETAS</b> ({{total_categories}})
                                    <span style="float:right" id="plus-icon-diet">
                                        <svg id="i-plus" viewBox="0 0 35 35" width="28" height="28" fill="black" stroke="#000000" 
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="cursor:pointer">
                                        <path d="M16 2 L16 30 M2 16 L30 16" />
                                        </svg>
                                    </span>
                                    <span style="float:right" id="minus-icon-diet" class="d-none">
                                        <svg id="i-minus" viewBox="0 0 32 32" width="28" height="28" fill="black"  style="cursor:pointer"
                                            stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M2 16 L30 16" />
                                        </svg>
                                    </span></li>
                                <div id="content-dietas" class="collapse">
<<<<<<< HEAD
                                    <menu-diet-filter @update="updateFilter(index, ...arguments)"/>
=======
                                    <filter-diet @update="updateFilter(index, ...arguments)"/>
>>>>>>> master
                                </div>
                            </ul>
                        </div>
                    </div>
    </div>
</template>
<script>
export default {
    props:["total_categories"],
<<<<<<< HEAD
  mounted() {
      
  },
=======
  computed: {},
  mounted() {},
>>>>>>> master
  methods: {
    updateFilter(index, row) {
     /*  let diets = this.$store.getters.listSupplier
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
  },

  computed: {}
};
</script>