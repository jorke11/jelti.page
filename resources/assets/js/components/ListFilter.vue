<template>
    <div>
        <div v-for="category in categories" :key="category.id" >
            <li class="list-group-item pb-0 pt-0">
                <div class="row" style="cursor:pointer" >
                    <div class="col-12">
                        <a href="javascript:;" class="list-group-item list-group-item-action" @:click="reloadCategories('{{category.slug}}', this);">
                            <div class="row">
                                <div class="col-lg-10">
                                    {{category.description}} ({{category.subcategories}})
                                </div>
                                <div class="col-lg-2">
                                    <input type="checkbox" class="form-control list-category" name="categories[]">
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </li>
        </div>
    </div>
</template>

<script>

const props = {

    categories:{
        type: Array
    }

} 


export default {
  props:props,
  mounted() {  
  },
  methods: {}
};
</script>