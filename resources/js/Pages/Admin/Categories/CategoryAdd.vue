<template>
    <Layout title="Category">
        <v-app>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Add Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">

                            </div>

                    <div>
                        <form @submit.prevent="submit(categories)">

                            <label for="name">Name</label>
                            <input class="form-control" required id="name" v-model="form.catName"/><br><br>
                            <v-btn color="blue" dark ><input type="submit" value="submit"></v-btn>
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

export default {
    name: "CategoryEdit",
    components:{
        Layout,
    },
    props:['categories'],
    data() {
        return {
            form: {
                catName: null,
            }
        }
    },
    methods:{
      submit:function (data){
          this.$inertia.post('/category/store', this.form)
      }
    }
}
</script>

<style scoped>

</style>
