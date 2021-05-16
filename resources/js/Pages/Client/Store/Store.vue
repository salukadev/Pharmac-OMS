<template>
    <StoreLayout>
    <div class="container" :class="{loadingItem: isProductLoading}">
        <div class="row action-panel">
            <div class="col-12">
                <div class="btn-group btn-group-sm pull-right">
                    <button id="list" class="btn btn-outline-dark" @click.prevent="changeDisplay(true)">
                        <i class="fa fa-list" aria-hidden="true"></i> List
                    </button>
                    <button id="grid" class="btn btn-outline-dark" @click.prevent="changeDisplay(false)">
                        <i class="fa fa-th" aria-hidden="true"></i> Grid
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <app-product-item v-for="prod in products" :item="prod" :key="prod.id" :displayList="displayList"></app-product-item>
        </div>

    </div>
    </StoreLayout>
</template>

<script>
import ProductItem from "../../../Shared/Storefront/product/ProductItem";
import StoreLayout from "../../../Shared/Storefront/StoreLayout";
export default {
    name: "Store",
    props:['products'],
    data(){
        return{
            isProductLoading:false,
            displayList: false
        }
    },
    components:{
        StoreLayout,
        appProductItem: ProductItem,
    },
    methods: {
        changeDisplay(isList) {
            this.displayList = isList;
        }
    }
}
</script>

<style scoped>
.loadingItem {
    align-items: center;
    justify-content: center;
    display: flex;
}

.action-panel {
    margin-bottom: 10px;
    margin-right: 5px;
}
</style>
