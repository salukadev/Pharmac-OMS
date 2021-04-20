<template>
    <Layout>
        <div>
            <h3 align="center">Welcome to Pharmac OMS Dashboard</h3>
        </div>
    </Layout>
</template>

<script>
import Layout from '../Shared/Admin/Layout'

export default {
    components:{
      Layout,
    },
    props:['version']
}
</script>
