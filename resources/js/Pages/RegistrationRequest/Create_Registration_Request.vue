
    <template>
        <Layout title="Agents">
            <v-app>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">assignment</i>
                                    </div>
                                    <h4 class="card-title">Create Registration Request</h4>
                                </div>
                                <div class="card-body">
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div>
                                        <form @submit.prevent="submit">
                                            <!--                <label for="userid">User Id:</label><br>-->
                                            <!--                <input type="text" id="userid" name="userid"  v-model="form.id"><br>-->

                                            <label for="name">Name:</label><br>
                                            <input type="text" id="name" name="name"  v-model="form.name" required><br>

                                            <label for="Address">Address:</label><br>
                                            <input type="text" id="Address" name="name"  v-model="form.address" required><br><br>

                                            <label for="customer_type">Customer Type:</label>
                                            <select class="custom-select" id="customer_type" v-model="form.cusType" required>
                                                <option selected></option>
                                                <option value="Doctor">Doctor</option>
                                                <option value="Pharmacy">Pharmacy</option>
                                                <option value="Other">Other</option>
                                            </select><br><br>

                                            <label for="phone_number">Phone Number:</label><br><br>
                                            <input type="text" id="phone_number" name="name"  v-model="form.telephone" required><br><br>



                                            <v-btn color="blue" dark ><input type="submit" value="Submit"></v-btn>
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
import Layout from "../../Shared/Admin/Layout";

export default {
    name: "Create_Registration_Request",
    components:{
        Layout,

    },

    data() {
        return {
            form: {
                name:'',
                address:'',
                cusType:'',
                telephone:'',

            },
        }
    },

    methods:{
        submit:function(){
            this.$inertia.post('/add',this.form);
        }
    }
}
</script>

<style scoped>

</style>
