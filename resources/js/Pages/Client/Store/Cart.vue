<template>
    <StoreLayout>
        <div class="container table-responsive">
            <table id="cart" class="table table-hover table-sm">
                <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
                </thead>

                <transition-group name="list-shopping-cart" tag="tbody">
                    <app-cart-item
                        v-for="cartItem in items"
                        :cartItem="cartItem"
                        :key="cartItem.id"
                    ></app-cart-item>
                </transition-group>

                <tfoot>
                <tr class="d-table-row d-sm-none">
                    <td class="text-center">
                        <strong>Total Rs {{ cartValue }}</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-warning" @click="saveShoppingCartLocal">
                            <i class="fa fa-angle-left"></i> Save and Continue Shopping
                        </button>
                    </td>
                    <td colspan="2" class="d-none d-sm-table-cell"></td>
                    <td class="d-none d-sm-table-cell text-center">
                        <strong>Total Rs {{ cartValue }}</strong>
                    </td>
                    <td class="px-0">
                        <button class="btn btn-success" @click="checkout" :disabled="cartValue==0">
              <span class="text-nowrap"
              >Checkout <i class="fa fa-angle-right d-inline"></i
              ></span>
                        </button>
                    </td>
                </tr>
                </tfoot>
            </table>


            <div class="float-end">
                <v-app>
                <v-dialog
                    v-model="form"
                    persistent
                    max-width="500px"
                    data-color="primary"
                >
                    <template v-slot:activator="{ on, attrs }">
<!--                        <v-btn
                            color="primary"
                            dark
                            v-bind="attrs"
                            v-on="on"
                        >
                            <v-icon dark>add</v-icon>
                            Create
                        </v-btn>-->
                        <button class="btn btn-dark float-right" v-bind="attrs"
                                v-on="on" color="primary" dark :disabled="cartValue==0">
              <span class="text-nowrap">Scheduled Order <i class="fa fa-angle-right d-inline"></i
              ></span>
                        </button>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Create a Recurring Order</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container >

                                <v-form
                                    ref="addform"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-text-field
                                        label="Frequency (Days)"
                                        v-model="addform.frequency"
                                        :counter="3"
                                        :rules="[v => !!v || 'Frequency is required']"
                                        required
                                    ></v-text-field>
                                    <br>
                                    <h4>Repeat Until (Select Date):</h4>
                                    <v-row
                                        cols="6"
                                        sm="6"
                                        class="my-2 px-1"
                                    >
                                        <v-date-picker
                                            ref="picker"
                                            v-model="addform.endDate"
                                            width="260"
                                            class="mt-3"
                                            :min="minDate"
                                            :landscape="landscape"

                                        ></v-date-picker>
                                    </v-row>

                                    <v-btn
                                        color="error"
                                        class="mr-4"
                                        @click="closeForm"
                                    >
                                        Close
                                    </v-btn>
                                    <v-btn
                                        color="error"
                                        class="mr-4"
                                        @click="submit"
                                    >
                                        Save
                                    </v-btn>
                                </v-form>
                            </v-container>
                        </v-card-text>

                    </v-card>
                </v-dialog>

<!--            <button class="btn btn-dark float-right" @click="checkout" :disabled="cartValue==0">
              <span class="text-nowrap">Scheduled Order <i class="fa fa-angle-right d-inline"></i
              ></span>
            </button>-->
                </v-app>
        </div>
            
        </div>
    </StoreLayout>
</template>

<script>
import StoreLayout from "../../../Shared/Storefront/StoreLayout";
import CartItem from "../../../Shared/Storefront/cart/CartItem";
export default {
    name: "Cart",
    props:['items','customerId'],
    components: {StoreLayout,appCartItem: CartItem},
    data(){
      return {
          total:0,
          form:false,
          valid:true,
          editing:false,
          landscape: true, //for date picker
          minDate: new Date().toISOString().slice(0,10),
          addform:{
              customer_id:this.customerId,
              cart_id:this.items[0].cart_id,
              frequency:'',
              endDate:new Date().toISOString().slice(0,10),
          },
      }
    },
    computed:{
        cartValue(){
            let res = 0;
            this.items.map(item => {
                res += item.listing.unitPrice * item.quantity;
            });
            this.total = res;
            return res;
        }
    },
    methods:{
        saveShoppingCartLocal(){
            this.$inertia.visit('/store');
        },
        checkout(){
            this.$inertia.post('/store/cart/clear',{total:this.total});
            this.$swal('Order Created Successfully !');
        },
        reset() {
            this.form = false
            this.$refs.addform.reset()
        },
        closeForm(){
            this.$refs.addform.reset();
            this.editing=false;
            this.form = false;
        },
        submit(){
            if(this.$refs.addform.validate()){
                //this.$inertia.post('/recurringorder/create', this.addform);
                axios.post('/recurringorder/create', this.addform).then(function (response) {

                });
                this.$swal('Recurring Order Created !');
                this.closeForm();
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.list-shopping-cart-leave-active {
    transition: all 0.4s;
}

.list-shopping-cart-leave-to {
    opacity: 0;
    transform: translateX(50px);
}

.table-sm {
    font-size: 0.875rem;
::v-deep h4 {
    font-size: 1.25rem;
}
}
</style>
