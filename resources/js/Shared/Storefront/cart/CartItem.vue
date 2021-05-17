<template>
	<tr>
		<td data-th="Product">
			<div class="row">
				<div class="col-sm-2 d-none d-sm-block">
					<img :src="cartItem.listing.imagePath" alt="..." class="img-fluid"/>
				</div>
				<div class="col-sm-10">
					<h4 class="nomargin">{{ cartItem.listing.name }}</h4>
					<p>{{ cartItem.listing.id*14584457 }}</p>
				</div>
			</div>
		</td>
		<td data-th="Price">{{ cartItem.listing.unitPrice }}</td>
		<td data-th="Quantity">
			<input type="number" class="form-control text-center"
				:value="cartItem.quantity"
				@input="updateQuantity"
				min="0">
		</td>
		<td data-th="Subtotal" class="text-center">Rs {{ subtotal }}</td>
		<td class="actions" data-th="">
			<button class="btn btn-danger btn-sm" @click="removeItem"><i class="fa fa-trash-o"></i></button>
		</td>
	</tr>
</template>

<script>
	export default {
		props: ['cartItem'],
		computed: {
			subtotal() {
				return this.cartItem.quantity * this.cartItem.listing.unitPrice;
			}
		},
		methods: {
			removeItem() {
				this.$inertia.post('/store/cart/remove',{item_id:this.cartItem.id});
			},
			updateQuantity(event) {
				/*let vm = this;
				this.updateCart({
					item: vm.cartItem,
					quantity: parseInt(event.target.value),
					isAdd: false
				});*/
                const cart_item = {
                    quantity: parseInt(event.target.value),
                    listing_id: this.cartItem.listing.id
                }
                this.$inertia.post('/store/cart/update',cart_item);

			}
		}
	}
</script>
