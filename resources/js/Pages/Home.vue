<template>
    <Layout>
        <div>
            Home Page : {{ version }}
        </div>
    </Layout>
</template>

<script>
import Layout from '../Shared/Layout'

export default {
    components:{
      Layout,
    },
    props:['version']
}
</script>
