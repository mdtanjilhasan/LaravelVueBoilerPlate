<template>
    <div v-if="message">
        <div class="alert alert-dismissible fade show" :class="className" role="alert">
            <strong>Success!</strong>
            {{ info }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="$emit('close')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<style scoped="scoped"></style>

<script>
    export default {
        props:['message'],
        data(){
            return{
                className: '',
                info: '',
            }            
        },
        created(){
           this.successMessage();
        },
        methods:{
            successMessage(){
                let instance = this;
                if(this.message){
                    if(this.message.type == 'success'){
                        instance.className = 'alert-success';
                        instance.info = this.message.message;
                    }
                    if(this.message.type == 'danger'){
                        instance.className = 'alert-danger';
                        instance.info = this.message.message;
                    }
                    setTimeout(event => {
                        this.$emit('close');
                    }, 3000)
                }
            }
        },
    }
</script>