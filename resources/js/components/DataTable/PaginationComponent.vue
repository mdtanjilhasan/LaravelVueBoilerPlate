<template>
    <nav class="paginator">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-center pl-0">
                    <span>Showing {{paginator.from}} to {{paginator.to}} of {{paginator.total}} entries</span>
                </div>
                <div class="col-sm-3 d-flex align-items-center pl-0">
                    <span>Showing  Page {{paginator.currentPage}} of {{paginator.lastPage}} pages</span>
                </div>
                <div class="col-sm-3 d-flex justify-content-end">
                    <a v-if="paginator.prevPageUrl" class="btn btn-sm btn-primary text-white mr-1" @click="$emit('prev',paginator.prevPageUrl);" title="Prev">
                        <i class="fa fa-angle-double-left mr-0"></i>
                    </a>
                    <a v-if="paginator.nextPageUrl" class="btn btn-sm btn-primary text-white" @click="$emit('next',paginator.nextPageUrl);" title="Next">
                        <i class="fa fa-angle-double-right mr-0"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</template>
<style scoped>

</style>

<script>
    export default {
        props: ['paginator']
    }
</script>