<template>
    <div>
         <li class="list-group-item pb-0 pt-0">
                <div class="row" style="cursor:pointer" >
                    <div class="col-12">
                            <a href="javascript:;" class="list-group-item list-group-item-action" @click="filterProducts(data);">
                            <div class="row">
                                <div class="col-lg-10">
                                    {{data.description}} ({{data.subcategories}})
                                </div>
                                <div class="col-lg-2">
                                    <input type="checkbox" class="form-control" v-model="data.checked">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        </li>
    </div>
</template>
<script>
export default {
  props: ["data"],
  computed: {},

  mounted() {},
  methods: {
    filterProducts(row) {
      row.checked = row.check = !row.check;
      this.$emit("update", row);
    }
  },

  computed: {}
};
</script>