<template>
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-mini">
            PD
        </a>
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                Pharmac LTD
            </a></div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="img/default-avatar.png" />
                </div>
                <div class="user-info">
                    <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                Admin User
                <b class="caret"></b>
              </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-mini"> MP </span>
                                    <span class="sidebar-normal"> My Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-mini"> EP </span>
                                    <span class="sidebar-normal"> Edit Profile </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="sidebar-mini"> S </span>
                                    <span class="sidebar-normal"> Settings </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/dashboard">
                        <i class="material-icons">dashboard</i>
                        <p> Dashboard </p>
                    </inertia-link>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
                        <i class="material-icons">local_shipping</i>
                        <p> Orders
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="tablesExamples">
                        <ul class="nav">
                            <li class="nav-item ">
                                <inertia-link class="nav-link" href="/orders">
                                    <span class="sidebar-mini">
                                    <i class="material-icons">receipt</i>
                                    </span>
                                    <span class="sidebar-normal"> Manage Orders </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item ">
                                <inertia-link class="nav-link" href="/recurringorder">
                                    <i class="material-icons">schedule</i>
                                    <span class="sidebar-normal"> Recurring Orders </span>
                                </inertia-link>
                            </li>
                            <li class="nav-item ">
                                <inertia-link class="nav-link" href="/returns">
                                    <i class="material-icons">local_shipping</i>
                                    <span class="sidebar-normal"> Returns</span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/agentDetails">

                        <i class="material-icons">people</i>
                        <p> Agents </p>
                    </inertia-link>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/client_reg_request">

                        <i class="material-icons">Stock</i>
                        <p> Registration Request </p>
                    </inertia-link>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/complaint">

                        <i class="material-icons">Stock</i>
                        <p> Complaints </p>
                    </inertia-link>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/stock">

                        <i class="material-icons">Stock</i>
                        <p> Stock </p>
                    </inertia-link>
                    <a class="nav-link" data-toggle="collapse" href="#tablesExamples1">
                        <i class="material-icons">Stock</i>
                        <p> Inventory
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="tablesExamples1">
                        <ul class="nav">
                            <li class="nav-item ">
                                <inertia-link class="nav-link" href="/supplier">
                                    <i class="material-icons">Stock</i>
                                    <span class="sidebar-normal">Stock</span>
                                </inertia-link>
                            </li>
                            <li class="nav-item ">
                                <inertia-link class="nav-link" href="/supplier">
                                    <i class="material-icons">Category</i>
                                    <span class="sidebar-normal">Category</span>
                                </inertia-link>
                            </li>
                            <li class="nav-item ">
                                <inertia-link class="nav-link" href="/supplier">
                                    <i class="material-icons">local_shipping </i>
                                    <span class="sidebar-normal">Supplier</span>
                                </inertia-link>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/category">
                        <i class="material-icons"> Category </i>
                        <p> Category </p>
                    </inertia-link>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/list">
                        <i class="material-icons"> list_alt </i>
                        <p> Products </p>
                    </inertia-link>
                </li>

                <li class="nav-item ">
                    <inertia-link class="nav-link" href="/discount">
                        <i class="material-icons"> local_offer </i>
                        <p> Discount Plans </p>
                    </inertia-link>
                </li>






            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar"
}
</script>

<style scoped>

</style>
