<template>
    <StoreLayout>
        <v-app>
    <div class="container" :class="{loadingItem: isProductLoading}">
        <div class="row action-panel">
            <div>
                    <button @click="logout">Logout</button>
            </div>
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

                <v-dialog
                    v-model="form"
                    persistent
                    max-width="600px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="success"
                            class="mr-4"
                            v-bind="attrs"
                            v-on="on"
                        >
                            Add Product Request
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Add Product Request</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-form
                                    ref="addProductRequest"
                                    v-model="valid"
                                    lazy-validation
                                >

                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="addProductRequest.generic"
                                                :counter="100"
                                                :rules="genericRules"
                                                label="Generic"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="addProductRequest.brand"
                                                :counter="100"
                                                :rules="brandRules"
                                                label="Brand"
                                                type="text"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="addProductRequest.description"
                                                :counter="100"
                                                :rules="descriptionRules"
                                                label="Description"
                                                type="text"
                                            ></v-text-field>
                                        </v-col>

                                    </v-row>
                                </v-form>
                            </v-container>
                        </v-card-text>
                        <!--                        form action buttons-->
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="error"
                                class="mr-4"
                                @click="reset"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                color="success"
                                class="mr-4"
                                @click="submit"
                            >
                                Add
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-app>
    </StoreLayout>
</template>

<script>
import ProductItem from "../../../Shared/Storefront/product/ProductItem";
import StoreLayout from "../../../Shared/Storefront/StoreLayout";
export default {
    name: "Store",
    props:['products','items'],
    data(){
        return{
            isProductLoading:false,
            displayList: false,
            valid:true,
            form: false,
            addProductRequest:{
                generic:'',
                brand:'',
                description:'',
            },

            //form validation Rules
            genericRules: [
                v => !!v || 'Generic is required',
                v => (v && v.length <= 100) || 'Generic must be less than 100 characters',
            ],
            brandRules: [
                v => !!v || 'Brand is required',
                v => (v && v.length <= 100) || 'Brand must be less than 100 characters',
            ],
            descriptionRules: [
                v => !!v || 'Description is required',
                v => (v && v.length <= 100) || 'Description must be less than 100 characters',
            ],
        }
    },
    components:{
        StoreLayout,
        appProductItem: ProductItem,
    },
    computed:{
        cartValue(){
            let res = 0;
            this.items.map(item => {
                res += item.listing.unitPrice * item.quantity;
            });
            return res;
        },
        cartCount(){
            return this.items.length;
        }
    },
    methods: {
        changeDisplay(isList) {
            this.displayList = isList;
        },
        validate () {
            this.$refs.addProductRequest.validate()
        },
        reset () {
            this.form = false
            this.$refs.addProductRequest.reset()
        },
        submit() {
            if(this.$refs.addProductRequest.validate()) {
                this.$swal({
                    title: "Done",
                    text: "Request Sent Successfully",
                    icon: "success",
                    buttons: true,
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    dangerMode: false,
                });

                this.$inertia.post('/productRequest/storeRequest', this.addProductRequest)
                this.$refs.addProductRequest.reset()
                this.form = false
            }


        },
        logout(){
            this.$inertia.get('/logout')
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
