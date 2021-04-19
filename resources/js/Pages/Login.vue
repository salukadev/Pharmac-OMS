<template>
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
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="float-left">
                        <ul>

                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;
                        2021, Pharmac Distributors PVT LTD
                    </div>
                </div>
            </footer>
        </div>
    </div>

    </body>

    </html>
</template>

<script>
export default {
    name: "Login",
    props: {
        errors: Object,
    },
    data(){
      return {
          form: {
              email: '',
              password: ''
          },
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
    },
}
</script>

<style scoped>

</style>
