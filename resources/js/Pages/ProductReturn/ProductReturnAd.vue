<template>
    <div>
        <table>

        <tr>
            <th>Order ID</th>
            <th>Email</th>
            <th>Address</th>
            <th>Telephone</th>
            <th>Remark</th>
            <th>Images</th>
            <th>Type</th>
            <th>Return Status</th>
          <th></th>
        </tr>

        <tr v-for="data in retdata" :key="data.id">
            <td>{{ data.order_id }}</td>
            <td>{{ data.reason }}</td>
            <td>{{ data.date}}</td>
            <td>{{ data.remark }}</td>
            <td>{{ data.images }}</td>
            <td>{{ data.type }}</td>
            <td>{{ data.date}}</td>
            <td>{{ data.returnStatus }}</td>
            <td><button type="button" name="edit_supplier">Edit</button></td>
            <td><button type="button" name="del_supplier">Delete</button></td>

        </tr>



        </table>
    </div>

    <input type="file" multiple @change="onFileChange" />
    
</template>

<script>
    import Layout from '../../Shared/Layout'

    export default {
        components:{
            Layout,
        },
        props:{
            retdata:Array,
        },
        data() {
            return {
                postFormData: new FormData(),
            };
        },

        methods: {
            onFileChange(event) {
                for(var key in event.target.files){
                    this.postFormData.append('images[]', event.target.files[key]);
                }
            },
            addPost() {
                axios.post('/api/v1/post', this.postFormData)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
