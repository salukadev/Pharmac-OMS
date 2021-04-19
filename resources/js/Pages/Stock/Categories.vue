<template>

    <layout>

    <div class="col-md-10">
        <button class="btn btn-sm btn-primary" @click="openModal()">Add New</button>
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
            <th >No.</th>
            <th>Category</th>
            <th>Action</th>
            </tr>
            </thead>
            <tr v-for="category in data" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.catName }}</td>
                <td width="130">
                    <button @click="edit(category)" class="btn btn-sm btn-primary">Edit</button>
                    <button @click="deleteCategory(category)" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        </table>

        <div class="modal fade" id="modal">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New category</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" required id="name" v-model="form.catName"/>
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
                    catName: null,
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
                    catName: null,
                }
            },
            save: function (data) {
                this.$inertia.post('/category', data)
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
                this.$inertia.post('/category/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            deleteCategory: function (data) {
                if (!confirm('Sure')) return;
                data._method = 'DELETE';
                this.$inertia.post('/category/' + data.id ,data)
                this.reset();
                this.closeModal();
            }
        }
    }
</script>
