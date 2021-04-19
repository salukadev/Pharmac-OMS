<template>

    <layout>

    <div class="col-md-10">
        <button class="btn btn-sm btn-primary" @click="openModal()">Add New</button>
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
            <th >No.</th>
            <th>Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>MFD</th>
            <th>EXP</th>
            <th>Supplier</th>
            <th>Batch No.</th>
            <th>Action</th>
            </tr>
            </thead>
            <tr v-for="product in data" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.category_id }}</td>
                <td>{{ product.brand }}</td>
                <td>{{ product.quantity }}</td>
                <td>{{ product.unitPrice }}</td>
                <td>{{ product.mnfDate }}</td>
                <td>{{ product.expDate }}</td>
                <td>{{ product.supplier_id }}</td>
                <td>{{ product.batchNo }}</td>
                <td width="130">
                    <button @click="edit(product)" class="btn btn-sm btn-primary">Edit</button>
                    <button @click="deleteproduct(product)" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        </table>

        <div class="modal fade" id="modal">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Product</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" required id="name" v-model="form.name"/>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <input class="form-control" required id="category" v-model="form.category_id"/>
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input class="form-control" required id="brand" v-model="form.brand"/>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type='number' class="form-control" required id="quantity" v-model="form.quantity"/>
                        </div>
                        <div class="form-group">
                            <label for="unitPrice">Unit Price</label>
                            <input type='number' class="form-control" required id="unitPrice" v-model="form.unitPrice"/>
                        </div>
                        <div class="form-group">
                            <label for="mfd">MFD</label>
                            <input type='date' class="form-control" required id="mfd" v-model="form.mnfDate"/>
                        </div>
                        <div class="form-group">
                            <label for="exp">EXP</label>
                            <input type='date' class="form-control" required id="exp" v-model="form.expDate"/>
                        </div>

                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <input class="form-control" required id="supplier" v-model="form.supplier_id"/>
                        </div>

                        <div class="form-group">
                            <label for="batchNo">Batch Number</label>
                            <input class="form-control" required id="batchNo" v-model="form.batchNo"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="closeModal()">Close</button>
                        <button type="submit" class="btn btn-primary" v-show="!editMode" @click="save(form)">Save
                        </button>
                        <button type="submit" class="btn btn-primary" v-show="editMode" @click="update(form)">Update
                        </button>
                    </div>
                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>

    </layout>

</template>

<script>
import Layout from '../../Shared/Layout.vue'

    export default {
  components: { Layout },
        props: ['data'],
        data() {
            return {
                editMode: false,
                form: {
                    name: null,
                    category_id: null,
                    brand: null,
                    quantity: null,
                    unitPrice: null,
                    mnfDate: null,
                    expDate: null,
                    supplier_id: null,
                    batchNo: null
                },
            }
        },
        methods: {
            openModal: function () {
                $('#modal').modal('show')
            },
            closeModal: function () {
                $('#modal').modal('hide')
                this.reset();
                this.editMode=false;
            },
            reset: function () {
                this.form = {
                    name: null,
                    category: null,
                    brand: null,
                    quantity: null,
                    unitPrice: null,
                    mfd: null,
                    exp: null,
                    supplier: null,
                    batchNo: null
                }
            },
            save: function (data) {
                this.$inertia.post('/stock', data)
                this.reset();
                this.closeModal();
                this.editMode = false;
            },
            edit: function (data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
                this.openModal();
            },
            update: function (data) {
                if (!confirm('Sure')) return;
                data._method = 'PUT';
                this.$inertia.post('/stock/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            deleteproduct: function (data) {
                if (!confirm('Sure')) return;
                data._method = 'DELETE';
                this.$inertia.post('/stock/' + data.id ,data)
                this.reset();
                this.closeModal();
            }
        }
    }
</script>
