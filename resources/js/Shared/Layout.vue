<!-- Base Layout for the Web app -->
<template>
    <header>
        <inertia-link href="/">Home</inertia-link>
        <inertia-link href="/register">Register</inertia-link>
        <inertia-link href="/complaint">Complaint</inertia-link>
        <inertia-link href="/create">Create Complaint</inertia-link>
        <inertia-link href="/clientRequest">Client Request</inertia-link> 

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
