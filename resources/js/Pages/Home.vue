<template>
    <Layout>
        <div>
            Home Page ASD : {{ version }}
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
