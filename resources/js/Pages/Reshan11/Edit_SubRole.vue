<!--suppress ALL -->
<template>
    <layout>
        <form @submit.prevent="update(SubRoleUpdate)" class="col-lg-12 offset-lg-3">

            <div class="form-group col-md-10">
                <label for="formGroupExampleInput"> User ID</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Enter User Id" v-model="SubRoleUpdate.user_id">
                </div>
            </div>

            <div class="form-group col-md-10">
                <label for="formGroupExampleInput"> Name</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Enter name" v-model="SubRoleUpdate.name">
                </div>
            </div>

            <div class="form-group col-md-10">
                <label for="formGroupExampleInput"> Tel no</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Enter telephone" v-model="SubRoleUpdate.telephone">
                </div>
            </div>


            <div class="form-group col-md-10">
                <label for="formGroupExampleInput"> Department</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Enter depatment" v-model="SubRoleUpdate.department">
                </div>
            </div>

            <div class="form-group col-md-10">
                <label for="formGroupExampleInput"> Access Level</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Enter accsess lavels" v-model="SubRoleUpdate.accessLevel">
                </div>
            </div>


            <button type="submit" class="btn btn-behance"> Update </button>
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

    props:['SubRoleUpdate'],

    data() {
        return {
            form: {
                user_id: 'SubRoleUpdate.user_id',
                name: 'SubRoleUpdate.name',
                telephone: 'SubRoleUpdate.telephone',
                department: 'SubRoleUpdate.department',
                accessLevel: 'SubRoleUpdate.accessLevel',

            }
        }
    },

    methods:{

        update:function (SubRoleUpdate){

        this.$inertia.post("/SubRole/update/",SubRoleUpdate);
        }
    }
}

</script>

<style scoped>

</style>
