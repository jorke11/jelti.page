export default {
    state:{
        diets:[],
        categories:[],
        newProducts:[],
        appPath:"http://localhost:8000/"
    },
    
    getters:{
        diets(state){
            return state.diets
        },
        categories(state){
            return state.categories
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
        }
    }
}