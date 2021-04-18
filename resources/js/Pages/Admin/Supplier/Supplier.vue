<template>
    <Layout title="Supplier">
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Supplier Management</h4>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

                                <div class="material-datatables">
                                    <!-- DATATABLE-->


                                    <v-card>
                                        <div style="text-align: right; padding: 20px">

                                            <v-row class="d-flex justify-end mb-6">
                                                <v-dialog
                                                    v-model="addform"
                                                    persistent
                                                    max-width="500px"
                                                >
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-btn
                                                            color="primary"
                                                            dark
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        >
                                                            Add Supplier
                                                        </v-btn>
                                                    </template>
                                                    <v-card>
                                                        <v-card-title>
                                                            <span class="headline">Supplier Details</span>
                                                        </v-card-title>
                                                        <v-card-text>
                                                            <v-container >
                                                                <v-form
                                                                    ref="addfrm"
                                                                    lazy-validation
                                                                >
                                                                    <v-row>
                                                                        <v-col cols="12">
                                                                            <v-text-field
                                                                                label="Name"
                                                                                v-model="supName"
                                                                                :counter="100"
                                                                                :rules="nameRules"
                                                                                required
                                                                            ></v-text-field>
                                                                        </v-col>
                                                                        <v-col cols="12">
                                                                            <v-text-field
                                                                                label="Email "
                                                                                v-model="email"
                                                                                :rules="emailRules"
                                                                                required
                                                                            ></v-text-field>

                                                                        </v-col>
                                                                        <v-col cols="12">

                                                                            <v-text-field
                                                                                label="Address "
                                                                                v-model="address"
                                                                                :counter="255"
                                                                                :rules="addressRules"
                                                                                required
                                                                            ></v-text-field>

                                                                        </v-col>
                                                                        <v-col cols="12">

                                                                            <v-text-field
                                                                                label="Telephone No"
                                                                                v-model="telephone"
                                                                                :counter="10"
                                                                                :rules="telephoneRules"
                                                                                required
                                                                            ></v-text-field>

                                                                        </v-col>

                                                                    </v-row>
                                                                </v-form>
                                                            </v-container>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn
                                                                color="blue darken-1"
                                                                text
                                                                @click="addform = false;clear;"
                                                            >
                                                                Close
                                                            </v-btn>
                                                            <v-btn
                                                                color="blue darken-1"
                                                                text
                                                                @click="addform = false;submit;"
                                                            >
                                                                Save
                                                            </v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-dialog>
                                            </v-row>

                                        </div>
                                        <v-card-title>
                                            <v-text-field
                                                v-model="search"
                                                append-icon="search"
                                                label="Search"
                                                single-line
                                                hide-details
                                            ></v-text-field>
                                        </v-card-title>


                                        <v-data-table
                                            :headers="headers"
                                            :items="suppliers"
                                            :search="search"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >
                                            <template v-slot:item="row">
                                                <tr>
                                                    <td>{{ row.item.id }}</td>
                                                    <td>{{ row.item.supName }}</td>
                                                    <td>{{ row.item.email }}</td>
                                                    <td>{{ row.item.address}}</td>
                                                    <td>{{ row.item.telephone }}</td>
                                                    <td>
                                                        <v-col
                                                            cols="12"
                                                            sm="3"
                                                        >
                                                            <v-btn
                                                                icon
                                                                color="indigo"
                                                                @click="edit(row.item)"
                                                            >
                                                                <v-icon>mdi-pencil</v-icon>
                                                            </v-btn>
                                                        </v-col>
                                                        </td>
                                                        <td>
                                                        <v-col
                                                            cols="12"
                                                            sm="3"
                                                        >
                                                            <v-btn
                                                                icon
                                                                color="red"
                                                                @click="deleteAgent(row.item.id)"
                                                            >
                                                                <v-icon>delete</v-icon>
                                                            </v-btn>
                                                        </v-col>
                                                    </td>
                                                </tr>
                                            </template>
                                        </v-data-table>
                                    </v-card>

                                </div>
                                <br><br>
                                <div style="text-align: right; padding-right: 20px">
                                    <v-btn color="blue" dark href="">
                                        <v-icon  dark>book</v-icon>
                                        Generate Report
                                    </v-btn>
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

import { validationMixin } from 'vuelidate'
import { required, email} from 'vuelidate/lib/validators'

export default {
    name: "SupplierDetails",
    components:{
        Layout,
    },
    props:{
        suppliers:Array,
        supplier: Object,
    },

    validations: {
        supName: { required},
        email: { required, email},
        address: { required },
        telephone: { required },
    },

    data(){
        return {
            addform: false,

            //form fields
            supName:'',
            email:'',
            address:'',
            telephone:'',

            addfrm:{
                supName:null,
                email:null,
                address:null,
                telephone:null,
            },

            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 100) || 'Name must be less than 100 characters',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],

            addressRules: [
                v => !!v || 'Address is required',
                v => (v && v.length <= 255) || 'Address must be less than 255 characters',
            ],

            telephoneRules: [
                v => !!v || 'Telephone is required',
                v => (v && v.length <= 10) || 'Telephone no must be less than 255 characters',
            ],

            search: '',
            headers: [
                {
                    text: 'Supplier ID',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },

                { text: 'Name', value: 'SupName' },
                { text: 'Email', value: 'email' },
                { text: 'Address', value: 'address' },
                { text: 'Telephone No.', value: 'telephone' },
                {
                    text: '',
                    value: '' ,
                    width:'1%',
                    sortable: false,

                },
                {
                    text: '',
                    value: '' ,
                    width:'1%',
                    sortable: false,

                },
            ],

        }
    },


    methods:{
        edit:function (data){
            console.log("hello")
            this.$inertia.post('/agentDetails/edit', data)
        },
        deleteAgent:function (data){
            console.log("hello")
            this.$inertia.post('/agentDetails/delete/' + data)
        },
        submit() {
            this.$v.$touch()
            this.$inertia.post('/supplier/store', this.addfrm)
        },
        clear () {
            this.$v.$reset()
            this.supName=''
            this.email=''
            this.address=''
            this.telephone=''
        },
    }
}
</script>
