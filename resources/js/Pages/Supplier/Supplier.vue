
<template>
    <Layout>

      <h1>Suppliers</h1>
      <br/><br/>

      <button id="supform" @click="hideform = !hideform">Upload</button>

      <div id="uploadform" v-if="hideform">
        <button id="supform" @click="hideform = !hideform">&times;</button>
          <form @submit.prevent="submit">
            <input type="text" v-model="form.supName" placeholder="supName"> <br/><br/>
            <input type="text" v-model="form.email"  placeholder="email"> <br/><br/>
            <input type="text" v-model="form.address" placeholder="Address"> <br/><br/>
            <input type="number" v-model="form.telephone" placeholder="Telephone"> <br/><br/>
            <button id="btnSubmit" type="submit" @click="upload();hideform = !hideform;">Submit</button>
            </form>
      </div>

      
      
      <br/><br/>
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
    el:'#supform',
    components:{
        Layout,
    },
    props:{
      suppliers:Array
    },
    data(){
      
      return{
          hideform:false,
          form:{
              supName: null,
              email: null,
              address: null,
              telephone: null,
          }
      }
    },
    methods:{

      // function for create supplier
      upload:function (){
        this.$inertia.post('/supplier',this.form);
        this.form = {
          supName: null,
          email: null,
          address: null,
          telephone: null,
        }
      },

      // function for update supplier details
      update:function (){
        this.$inertia.post('/supplier',this.form);
        this.form = {
          supName: null,
          email: null,
          address: null,
          telephone: null,
        }
      }
    }
}
</script>
