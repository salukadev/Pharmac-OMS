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
            <button class="btn btn-dark float-right" @click="checkout" :disabled="cartValue==0">
              <span class="text-nowrap">Scheduled Order <i class="fa fa-angle-right d-inline"></i
              ></span>
            </button>
        </div>
        </div>
    </StoreLayout>
</template>

<script>
import StoreLayout from "../../../Shared/Storefront/StoreLayout";
import CartItem from "../../../Shared/Storefront/cart/CartItem";
export default {
    name: "Cart",
    props:['items'],
    components: {StoreLayout,appCartItem: CartItem},
    data(){
      return {
          total:0
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
