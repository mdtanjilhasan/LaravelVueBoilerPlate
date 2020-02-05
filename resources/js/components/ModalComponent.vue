<template>
  <div class="modal fade" id="user-add-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">

            <h5 v-if="id" class="modal-title" id="exampleModalCenterTitle">Update User</h5>
            <h5 v-else class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" @click="$emit('close')">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
            <validation-errors :myErrors="validationErrors" v-if="validationErrors"></validation-errors>
              <form>
                <div class="form-group">
                  <label for="name" class="col-form-label">Name:</label>
                  <input type="text" :class="{'input': true, 'is-invalid': errors.has('name') }" v-validate="'required|alpha_spaces'" name="name" v-model="user.name" class="form-control" id="name" placeholder="Enter Name">
                  <div class="heightError invalid-feedback" v-show="errors.has('name')">{{ errors.first('name') }}</div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-form-label">Email:</label>
                  <input type="email" :class="{'input':true, 'is-invalid': errors.has('email')}" v-model="user.email" name="email" class="form-control" v-validate="'required|email'" id="email" placeholder="Enter Email">
                  <div class="heightError invalid-feedback" v-show="errors.has('email')">{{ errors.first('email') }}</div>
                </div>

                <div class="form-group">
                  <label for="role" class="col-form-label">Role:</label>
                  <select v-model="role_id" id="role" name="role" class="form-control">
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.display_name }}</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="status" class="col-form-label">Status:</label>
                  <select v-model="status_id" id="status" name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Banned</option>
                  </select>
                </div>
              </form>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')">Close</button>
            <button type="button" class="btn btn-primary" @click.prevent="save()">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  props:['id'],
  data() {
    return {
      user:{
        name:'',
        email:'',
      },
      validationErrors: '',
      roles: '',
      role_id: 1,
      status_id: 1,
    }
  },
  created(){
    if(this.id){
      axios.get('/user/'+this.id).then(response => {
            this.user = response.data.user;
            this.role_id = response.data.role_id;
            this.status_id = response.data.user.status;
        });
    }
    this.getRoles();
  },
  methods:{
    getRoles(){
        axios.get('/user-roles').then(response => {
          this.roles = response.data.roles;
        });
    },
    save(){
      this.$validator.validateAll().then((result) => {
        if (result) {
          if (this.id) {
              axios.post('/update-user/'+this.id, {
                    name: this.user.name,
                    email: this.user.email,
                    role: this.role_id,
                    user_id: this.id,
                    status: this.status_id,
                })
                .then(response => {
                    $('#user-add-edit').modal('hide');
                    this.$emit('getUsers');
                    this.$emit('notify', response.data);
                    this.$emit('close');
                })
                .catch(error => {
                  if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                  }
                  
                });
          }else{
            axios.post('/users-store', {
                    name: this.user.name,
                    email: this.user.email,
                    role: this.role_id,
                    status: this.status_id,
              })
              .then(response => {
                  $('#user-add-edit').modal('hide');
                  this.$emit('getUsers');
                  this.$emit('notify', response.data);
                  this.$emit('close');
              })
              .catch(error => {
                if (error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                  }
              });
          }
        }
      });
    }
  }
};
</script>

