export default {
    state:{
        diets:[],
        categories:[],
        newProducts:[],
        listProducts:[],
        appPath:"http://localhost:8000/"
    },
    
    getters:{
        diets(state){
            return state.diets
        },
        categories(state){
            return state.categories
        },
        listProduct(state){
            return state.listProducts
        },
        AppPath(state){
            return state.appPath
        },
        
    },
    mutations:{
        updateDiets(state,payload){
            return state.diets = payload
        },
        updateCategories(state,payload){
            return state.categories = payload
        },
        updateNewProducts(state,payload){
            return state.newProducts = payload
        },
        updateListProduct(state,payload){
            return state.listProducts = payload
        }
    },
    actions:{
        getDiets(context){
            axios.get("/card-diets").then(response => {
                context.commit("updateDiets",response.data)
            });
        },

        getCategories(context){
            axios.get("/categories").then(response => {
                context.commit("updateCategories",response.data)
            });
        },
        getNewProducts(context){
            axios.get("/new-products").then(response => {
                context.commit("updateNewProducts",response.data)
            });
        },
        getListProduct(context){
            axios.get("/list-products").then(response => {
                context.commit("updateListProduct",response.data)
            });
        }
    }
}