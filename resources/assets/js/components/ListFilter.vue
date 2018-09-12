<template>
    <div>
        <div v-for="row in listData" :key="row.id" >
            <li class="list-group-item pb-0 pt-0">
                <div class="row" style="cursor:pointer" >
                    <div class="col-12">
                        <a href="javascript:;" class="list-group-item list-group-item-action" @:click="reloadCategories('{{row.slug}}', this);">
                            <div class="row">
                                <div class="col-lg-10">
                                    {{row.description}} ({{row.subcategories}})
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
    listData:{
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