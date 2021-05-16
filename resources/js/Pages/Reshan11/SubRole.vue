<!--suppress XmlInvalidId -->
<template>
    <layout>


        <form @submit.prevent="submit"  class="col-lg-15 offset-lg-3" >
                <div class="form-group col-md-10">
                    <!--suppress XmlInvalidId -->
                    <label for="formGroupExampleInput"> User ID</label>
                        <div class="col-sm-10">
                             <input  type="text" required class="form-control" placeholder="Enter User Id" v-model="form.user_id">
                        </div>
                </div>

            <div class="form-group col-md-10">
                <!--suppress XmlInvalidId -->
                <label for="formGroupExampleInput"> Name</label>
                <div class="col-sm-10">
                    <input type="text" required placeholder="Enter name" class="form-control" v-model="form.name">
                </div>
            </div>
            <div class="form-group col-md-10">
                <!--suppress XmlInvalidId -->
                <label for="formGroupExampleInput"> Tel.no</label>
                <div class="col-sm-10">
                    <input type="text" required placeholder="Enter telephone" class="form-control"
                           v-model="form.telephone">
                </div>
            </div>


            <div >
                    <label for="formGroupExampleInput"> Department</label>
                    <div class="col-sm-10">
                        <select  class="form-select form-select-lg mb-3" v-model="form.department" aria-label=".form-select-lg example">
                            <option selected > Choose..</option>
                            <option value="Finance">Finance</option>
                            <option value="Stock">Stock</option>
                            <option value="Sales">Sales</option>
                            <option value="Administration">Administration</option>

                        </select>
                    </div>
                </div>


                <div class="form-group col-md-10">
                     <label for="formGroupExampleInput"> Accsess Level</label>
                    <div class="col-sm-10">
                        <input type="text" required placeholder="Enter accsess lavels" class="form-control" v-model="form.accessLevel">
                    </div>
                </div>

            <button  type="submit" class="btn btn-behance"> Submit </button>
        </form>
    </layout>


</template>

<script>
import Layout from '../../Shared/Admin/Layout'

export default {
    name: "SubRole",
    components: {
        Layout
    },


    data() {
        return {
            form: {
                user_id: null,
                name: null,
                telephone: null,
                department: null,
                accessLevel: null,

            }
        }
    }
    ,

    methods: {
        submit: function() {

            this.$inertia.post('/getadd', this.form);
        }
    },




}

</script>

<style scoped>

</style>
