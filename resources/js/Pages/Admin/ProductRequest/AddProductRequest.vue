<template>
    <Layout title="Product Requests">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Add Product Request</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
        <div>
            <form @submit.prevent="submit">
                <label for="userid">User Id :</label><br>
                <input type="text" id="userid" name="userid"  v-model="form.user_id"><br>

                <label for="generic">Generic :</label><br>
                <input type="text" id="generic" name="generic"  v-model="form.generic"><br><br>

                <label for="brand">Brand :</label><br>
                <input type="text" id="brand" name="brand" v-model="form.brand"><br><br>

                <label for="description">Description:</label><br>
                <input type="text" id="description" name="description" v-model="form.description"><br><br>

                <input type="submit" value="Submit">
            </form>


        </div>
                            </div>
                            <!-- end content-->
                        </div>
                        <!--  end card  -->
                    </div>
                    <!-- end col-md-12 -->
                </div>
            </div>
        </v-app>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

// import { reactive } from 'vue'
// import { Inertia } from '@inertiajs/inertia'

export default {
    name: "AddProductRequest",
    components:{
        Layout,
    },
    // setup () {
    //     const form = reactive({
    //         user_id:null,
    //         generic:null,
    //         brand:null,
    //         description:null,
    //     })
    //
    //     function submit() {
    //         Inertia.post('/productRequest/store', form)
    //     }
    //
    //     return { form, submit }
    // },

    data() {
        return {
            form: {
                user_id:null,
                generic:null,
                brand:null,
                description:null,
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/productRequest/store', this.form)
        },
    },


}
</script>

<style scoped>

</style>
