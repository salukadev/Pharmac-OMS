<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <inertia-link class="navbar-brand mr-auto router-link-exact-active router-link-active" href="/store">Pharmac OMS</inertia-link>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarTop"
                aria-controls="navbarTop"
                aria-expanded="false"
                aria-label="Toggle navigation"
                @click="toggleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-row-reverse" id="navbarTop" :class="{show: isNavOpen}">
                <ul class="navbar-nav mr-auto">

                </ul>
                <ul class="nav navbar-nav ">
<!--                    <li>
                    <inertia-link href="/login" tag="li" v-if="!isLoggedIn" class="nav-item" active-class="active">
                        <a class="nav-link">Login</a>
                    </inertia-link>
                    </li>-->
                    <li v-if="isLoggedIn" class="li-pointer nav-item">
                        <a @click="logout" class="nav-link">Logout {{ userEmail }}</a>
                    </li>
                    <li class="nav-item" active-class="active">
                        <inertia-link as="button" type="button" href="/login" v-if="!isLoggedIn" >
                            <a class="nav-link">Logout  </a>
                        </inertia-link>
                    </li>
                    <li class="nav-item" active-class="active">
                    <inertia-link as="button" type="button" href="/order/4" v-if="!isLoggedIn" >
                        <a class="nav-link"> My Orders </a>
                    </inertia-link>
                    </li>
                    <li>
                        <inertia-link href="store/cart" class="btn btn-success navbar-btn" tag="button">
<!--                            Checkout <span class="badge bg-light text-dark">{{ numItems }} ($ {{ cartValue }})</span>-->
                            My Cart <span class="badge bg-light text-dark">{{itemCount}}</span>
                        </inertia-link>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container -->
    </nav>
</template>

<script>
export default {
    name: "Header",
    props:[],
    data() {
        return {
            isLoggedIn : false,
            isNavOpen: false,
            itemCount:0
        }
    },
    computed:{
        numItems() {
            return this.itemCount;
        },
        cartValue(){
          return 50;
        },
        userEmail() {
            return this.isLoggedIn ? this.currentUser.email : ''
            //return "user@phramac.com";
        }
    },
    methods:{
        toggleNavbar() {
            this.isNavOpen = !this.isNavOpen
        },
        updateCartCount(){
          //this.itemCount =  count;
            axios.get('/store/cart/list').then((response)=>{
                //this.itemCount = response.data.items.length
                let tot=0;
                response.data.items.map(item => {
                    tot += item.quantity;
                });
                this.itemCount=tot
            })
        }

    },
    created() {
        this.updateCartCount()
    },
    mounted(){
        this.$root.$on('cartItems',()=>{
            this.updateCartCount()
        });
    }
}
</script>

<style scoped >
.navbar-btn a {
    color: white;
}

.li-pointer {
    cursor: pointer;
}

.li-pointer:hover {
    cursor: pointer;
}
</style>
