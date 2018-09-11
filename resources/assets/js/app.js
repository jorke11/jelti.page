require('./bootstrap');
require('./components/Example');

window.Vue = require('vue');
import StoreData from './store'
import Vuex from "vuex";
import Router from 'vue-router'

Vue.use(Router)

const store = new Vuex.Store(StoreData)


// export default new Router({
//     routes: [
//       {
//         path: '/',
//         name: 'Hello',
//         component: Hello
//       }
//     ]
//   })



Vue.component('card-product', require('./components/CardProduct.vue'));
Vue.component('card-diet', require('./components/CardDiet.vue'));
Vue.component('card-diet-detail', require('./components/CardDietDetail.vue'));

let menuDietHeader = Vue.component('menu-diet', require('./components/MenuDiet.vue'));
let menuDietFooter = Vue.component('menu-diet-footer', require('./components/MenuDietFooter.vue'));

let menuCategoryHeader = Vue.component('menu-category', require('./components/MenuCategory.vue'));
let menuCategoryFooter = Vue.component('menu-category-footer', require('./components/MenuCategoryFooter.vue'));
Vue.component('card-product', require('./components/CardProduct.vue'));
//let newProducts = Vue.component('new-products', require('./components/NewProduct.vue'));


new Vue({
    el: '#menu-header',
    store,
    component: {
        menuDietHeader,
        menuCategoryFooter
    }
});

if (document.getElementById("divProduct")) {
    const app = new Vue({
        el: '#divProduct',
        store
    });
} 
    

if (document.getElementById("new-products")) {
    const app = new Vue({
        el: '#new-products',
        store
    });
} 

if (document.getElementById("list-products")) {
    const app = new Vue({
        el: '#list-products',
        store
    });
} 


new Vue({
    el: '#options-footer',
    store,
    component: {
        menuDietFooter,
        menuCategoryFooter
    }
});