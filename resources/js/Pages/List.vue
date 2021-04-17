<template>
    <Layout>
        <div>
            <div class="btn1">
                <a href="product/create" class="btn btn-primary ">Add New Product</a>

            </div>
            <table border="1">
                <thead>

                <th>Product ID</th>
                <th>Stock ID</th>
                <th>Name</th>
                <th>image</th>
                <th>unitPrice</th>
                <th>Discount ID</th>
                <th>Update/Delete/View</th>


                </thead>

                <tbody>
                <!--display data-->
                <tr v-for="l in lists">

                    <td>{{l.id}}</td>
                    <td>{{l.stock_id}}</td>
                    <td>{{l.name}}</td>
                    <td> <img class="pic" v-bind:src="l.imagePath"></td>
                    <td>{{l.unitPrice}}</td>
                    <td>{{l.discount_id}}</td>

                    <td>
                        <button @click="edit(l)" >Edit</button>
                        <button @click="remove(l)">Remove</button>
                        <button @click="view(l)">View</button>
                    </td>

                </tr><!-- end of display data-->
                </tbody>
            </table>
        </div>
    </Layout>
</template>

<script>
import Layout from '../Shared/Layout'

export default {
    components: {
        Layout,
    },
    props: ['lists'],

    methods: {
        edit:function (data){
            this.$inertia.post('/update/', this.form)
        },
        remove:function(data){
            this.$inertia.delete('/delete' + this.form.id)
        },
        view:function(data){
            this.$inertia.get('/display'+data.id)
        },
    }

}


</script>
<style scoped>
.pic{
    width:150px;
    height: 150px;
}
</style>
