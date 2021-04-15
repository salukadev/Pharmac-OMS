
<template>
    <Layout>

      <h1>Suppliers</h1>
      <br/>
      <inertia-link href="/add">Add</inertia-link>
      <br/><br/>
      <button type="button" name="add_supplier">Add</button>

      <table>

        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Telephone</th>
          <th></th>
        </tr>

        <tr v-for="supplier in suppliers" :key="supplier.id">
           <td>{{ supplier.supName }}</td>
            <td>{{ supplier.email }}</td>
            <td>{{ supplier.address}}</td>
            <td>{{ supplier.telephone }}</td>
            <td><button type="button" name="edit_supplier">Edit</button></td>
            <td><button type="button" name="del_supplier">Delete</button></td>

        </tr>



        </table>
    </Layout>
</template>

<script>
import Layout from '../../Shared/Layout'

export default {
    components:{
        Layout,
    },
    props:{
      suppliers:Array
    }
}
</script>
