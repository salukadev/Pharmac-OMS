<!-- Base Layout for the Web app -->
<template>
    <header>
        <inertia-link href="/">Home</inertia-link>
        <inertia-link href="/register">Register</inertia-link>
        <inertia-link href="/supplier">Supplier</inertia-link>
<<<<<<< HEAD
        <inertia-link href="/app">test</inertia-link>
=======
        <inertia-link href="/returns">Returns</inertia-link>
        <inertia-link href="/return_request">Return Request</inertia-link>
>>>>>>> 92a19004719bae2b8bdd1afbaeca1bafb75ad372
        <br>
        <br>
    </header>
    <main>
        <slot/> <!-- yield body content-->
    </main>
</template>

<script>

export default {
    name: "Layout.vue",
    components:{

    }
}
</script>

<style scoped>

</style>
