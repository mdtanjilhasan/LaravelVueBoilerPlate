<template>
	<div v-if="validateErrors">        
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="d-block">Oops! Have a look</strong>
            <ul>
                <li v-for="(value, key, index) in validateErrors">{{ value }}</li>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
    	props: ['myErrors'],

    	data(){
                return {
                    
                }
            },
        mounted() {
            //console.log('Component mounted.')
        },
        computed: {
            validateErrors(){
                let error = Object.values(this.myErrors);
                error = error.flat();
                return error;
            }
        }
    }
</script>
