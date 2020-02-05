<template>
    <div class="modal fade" id="delete-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title text-center">Are You Sure To Delete?</h5>
                    <div class="text-center pt-3 pb-3">
                        <i class="ik ik-alert-octagon text-warning display-2"></i>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close')">Cancel</button>
                        <form class="d-inline-block">
                            <button type="submit" class="btn btn-danger confirm-delete" @click.prevent="deleteModel()">Yes Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</template>

<style scoped>

</style>

<script>
    export default {
        props:['url'],
        created(){
           
        },
        methods:{
            deleteModel(){
                if(this.url){
                    axios.delete(this.url)
                    .then(response => {
                        $('#delete-modal').modal('hide');
                        this.$emit('close');
                        this.$emit('notify', response.data);
                        this.$emit('getUsers');                        
                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        }
    }
</script>