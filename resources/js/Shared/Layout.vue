<!-- Base Layout for the Web app -->
<template>
    <header>
        <inertia-link href="/">Home</inertia-link>
        <inertia-link href="/register">Register</inertia-link>
        <inertia-link href="/upload">Upload Cheque</inertia-link>
        <inertia-link href="/all-cheques">All Cheques</inertia-link>
        <inertia-link href="/pending-cheques">Pending Cheques</inertia-link>
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
