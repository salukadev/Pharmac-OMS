<!-- Base Layout for the Web app -->
<template>
    <html>
    <header>
<!--        <inertia-link href="/">Home</inertia-link>
        <inertia-link href="/register">Register</inertia-link>-->
        <title>
            Pharmac OMS
        </title>
    </header>
    <body class="">
        <div class="wrapper ">
            <Sidebar v-bind:currentUser="currentUser"/>

            <div class="main-panel">
                <Navbar :title="title"/>

                <div class="content">
                    <slot/> <!-- yield body content-->
                </div>

                <Footer/>
            </div>
        </div>
    </body>
    </html>
</template>

<script>
import Footer from './Footer'
import Navbar from './Navbar'
import Sidebar from './Sidebar'

export default {
    name: "Layout.vue",
    components:{
        Navbar,
        Sidebar,
        Footer,
    },
    props:['title','currentUser'],
    data(){
        return{
            currentUser:this.currentUser

        }
    }
}
</script>

<style lang="scss" scoped>
    @import './all.css';
</style>
