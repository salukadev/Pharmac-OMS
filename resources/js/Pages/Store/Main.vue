<template>
    <Layout>
        <VmHero></VmHero>
        <VmProductsList></VmProductsList>
    </Layout>
</template>

<script>
import VmProductsList from '../../Shared/Store/products_list/ProductsListContainer';
import VmHero from '../../Shared/Store/hero/Hero';
import Layout from "../../Shared/Store/Layout";

export default {
    name: "Main",
    components: {
        Layout,
        VmProductsList,
        VmHero
    }
}
</script>

<style scoped>

</style>
