<template>
    <v-app>
    <html lang="en">

    <head>
        <title>
            Login
        </title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    </head>

    <body class="off-canvas-sidebar">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
        <div class="container">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="javascript:;">Login Page</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">
                            <i class="material-icons">dashboard</i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item ">
                        <inertia-link href="/" class="nav-link">
                            <i class="material-icons">store</i>
                            Store
                        </inertia-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('/img/login.jpg'); background-size: cover; background-position: top center;">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                        <form class="form" @submit.prevent="submit">
                            <div class="card card-login card-hidden">
                                <div class="card-header card-header-rose text-center">
                                    <h3 class="card-title">Login</h3>

                                </div>
                                <div class="card-body ">
                                    <p class="card-description text-center">Insert your credentials.</p>
                                    <span class="bmd-form-group">

                  </span>
                                    <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email..." v-model="form.email">
                    </div>
                  </span>
                                    <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" class="form-control" placeholder="Password..." v-model="form.password">
                    </div>
                  </span>
                                    <br/>
                                    <h5 class="text-center text-danger">{{ errors.password }}</h5>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <button type="submit" class="btn btn-success btn-link btn-lg">Authenticate</button>
                                </div>
                            </div>



                        </form>

                            <!--<Create_Registration_Request pop up window  -->
                            <v-dialog
                                v-model="forms"
                                persistent
                                max-width="600px"
                            >

                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="success"
                                        dark
                                        v-bind="attrs"
                                        v-on="on"
                                    >

                                        <!-- make a button for popup-->
                                        <v-icon dark>add</v-icon>
                                              Add a New Request
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title>
                                        <h2>Add a New Request</h2>
                                    </v-card-title>
                                    <v-card-text>
                                        <v-container>
                                            <v-form
                                                ref="addRequest"
                                                v-model="valid"
                                                lazy-validation
                                            >

                                                <v-row>

                                                    <!--input text field -->
                                                    <v-col cols="12">
                                                        <v-text-field
                                                            v-model="addRequest.name"
                                                            :counter="25"
                                                            :rules="nameRules"
                                                            label="Name"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>

                                                    <!--input text field -->
                                                    <v-col cols="12">
                                                        <v-text-field
                                                            v-model="addRequest.address"
                                                            :counter="20"
                                                            :rules="addressRules"
                                                            label="Address"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>

                                                    <!--input text field -->
                                                    <v-col cols="12">
                                                        <v-select
                                                            v-model="addRequest.cusType"
                                                            :items="itm"
                                                            :rules="cusTypeRules"
                                                            label="Customer Type"
                                                            required
                                                        ></v-select>
                                                    </v-col>

                                                    <!--input text field -->
                                                    <v-col cols="12">
                                                        <v-text-field
                                                            v-model="addRequest.telephone"
                                                            :counter="10"
                                                            :rules="telephoneRules"
                                                            label="Telephone Number"
                                                            type="number"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>



                                                </v-row>

                                                <v-card-actions>

                                                    <v-btn
                                                        color="error"
                                                        class="mr-4"
                                                        @click="reset"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn
                                                        color="success"
                                                        class="mr-4"
                                                        @click="submits"
                                                    >
                                                        Add Request
                                                    </v-btn>
                                                </v-card-actions>
                                                <!--input submit button -->


                                            </v-form>     <!--end form -->

                                        </v-container>
                                    </v-card-text>

                                </v-card>
                            </v-dialog>        <!--end popup-->


                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="float-left">
                        <ul></ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;
                        2021, Pharmac Distributors PVT LTD         <!-- company name -->
                    </div>
                </div>
            </footer>
        </div>
    </div>

    </body>

    </html>
    </v-app>
</template>

<script>
// import registration request page
import Create_Registration_Request from "./RegistrationRequest/Create_Registration_Request"


export default {
    name: "Login",
    //export components
    components:{
        Create_Registration_Request
    },


    props: {
        errors: Object,
    },
    data(){
      return {
          form: {
              email: '',
              password: ''
          },

          addRequest: {
              name:'',
              address:'',
              cusType:'',
              telephone:'',
          },

          itm: [
              'Doctor',
              'Pharmacy',
              'Other',

          ],

          //name validation
          nameRules: [
              v => !!v || 'Name is required',
          ],

          //address validation
          addressRules: [
              v => !!v || 'Address is required',
              v => (v && v.length <= 20) || 'Address must be less than 20 characters',
          ],

          //customer type validation
          cusTypeRules: [
              v => !!v || 'Customer Type is required',

          ],

          // telephone number validation
          telephoneRules: [
              v => !!v || 'Contact Number is required',
              v => (v && v.length === 10) || 'Contact Number must be  10 numbers',
          ],
        }
    },
    mounted(){
        md.checkFullPageBackgroundImage();
        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700);
    },
    methods: {
        submit() {
            this.$inertia.post('/login', this.form)
        },

        reset() {
            this.forms = false
            this.$refs.addRequest.reset()
        },

        closeForm(){
            this.$refs.addRequest.reset();
            this.editing = false;
            this.forms = false;
        },



        validate() {
            this.$refs.addRequest.validate()
        },

        submits:function(){
            if(this.$refs.addRequest.validate()) {
                this.$inertia.post('/add', this.addRequest);
                this.$refs.addRequest.reset();
                this.forms = false;
            }

        },
    },
}
</script>

<style scoped>

</style>
