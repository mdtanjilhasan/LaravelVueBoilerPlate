<template>
    <div class="col-md-12">
        <div class="card" style="min-height: 484px;">
            <div class="card-header d-flex justify-content-between">
                <h3>Users</h3>
                  <button type="button" v-if="userCreate" class="btn btn-primary" @click="openModal('')" data-toggle="modal" data-target="#user-add-edit">Add New</button>
            </div>

            <div class="card-body">
                <error-success-message v-if="showMessage" :message="message" @close="showMessage = false"></error-success-message>
                <!-- if use default filters then you don't  need to pass this props to data table -->
                <data-table ref="dataTable" :columns="columns" :link="fetchUrl" @getModel="getUsers">
                    <tbody>
                        <tr v-for="(user,index) in users" :key="user.id">
                            <th>{{ obj.serialNumber(index) }}</th>
                            <td>{{ user.name}}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <span class="badge badge-pill badge-dark">{{ user.role_name }}</span>
                            </td>
                            <td>
                                <span class="badge badge-pill" :class="user.status_class">{{ user.user_status }}</span>
                            </td>
                            <td>
                                <button title="EDIT" type="button" v-if="userEdit" class="btn btn-info" data-toggle="modal" data-target="#user-add-edit" @click="openModal(user.id)">Edit</button>
                                <button title="DELETE" type="button" v-if="userDelete" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" @click="openDeleteModal(user.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </data-table>
            </div>
        </div>

        <!-- use the modal component, pass in the prop -->
        <div v-if="isShow">
            <modal-component @close="isShow = false" :id="selected" @getUsers="getUsers" @notify="notify"></modal-component>
        </div>
        <div v-if="showDelModal">
            <delete-modal @close="showDelModal = false" :url="deleteUrl" @getUsers="getUsers" @notify="notify"></delete-modal>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users:[],
                deleteUrl:'',
                obj:'',
                fetchUrl:'/users/data',
                loadPreloader:false,
                isShow:false,
                selected:'',
                userCreate: false,
                userEdit: false,
                userDelete: false,
                message:{
                    message: '',
                    type: ''
                },
                columns:[
                    {label: 'id', ordarable: true },
                    {label: 'name', ordarable: true },
                    {label: 'email', ordarable: true },
                    {label: 'role'},
                    {label: 'status'},
                    {label: 'action'},
                ],                
                showMessage: false,
                showDelModal: false,
            }
        },
        methods:{
            openModal(id) {
                this.selected = id;
                this.isShow = true;
            },
            openDeleteModal(id){
                this.deleteUrl = '/delete-user/'+id; // this must be full delete url
                this.showDelModal = true;
            }, 
            getUsers(url = '/users/data',filter = ''){
                this.obj = this.$refs.dataTable;
                axios.get(url, {params: filter}).then(response => {
                    this.users = response.data.users.data;
                    this.userCreate = response.data.user_create;
                    this.userEdit = response.data.user_edit;
                    this.userDelete = response.data.user_delete;
                    this.obj.configPagination(response.data.users);
                });
            },
            notify(msg) {
                if (msg) {
                    this.showMessage = true;
                    this.message = msg;
                }
            },
        }
    }
</script>
<style scoped="">
    .bd-example-modal-lg .modal-dialog{
    display: table;
    position: relative;
    margin: 0 auto;
    top: calc(50% - 24px);
  }

  .bd-example-modal-lg .modal-dialog .modal-content{
    background-color: transparent;
    border: none;
  }
</style>
