<template>
    <div>
        <div class="table-responsive">
            <div class="container-flued">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select class="form-control" v-model="filters.itemPerPage" @input="getModel('','')">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-7"></div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="search here" v-model="filters.search" @input="getModel('','')">
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped data_table">
                <thead>
                <tr>
                    <th v-for="column in modifiedColumns" :key="column.label" @click="sortByColumn(column.label)">
                        {{ columnHead(column.label) }}
                        <span v-if="column.ordarable">
                            <span v-if="column.label === filters.column">
                                <i v-if="filters.dir === 'asc' " class="fas fa-arrow-up"></i>
                                <i v-else class="fas fa-arrow-down"></i>
                            </span>                                              
                        </span>
                    </th>
                </tr>
            </thead>
            <slot></slot>
            </table>
        </div>
        <div class="w-100 p-1"></div>
        <pagination :paginator="pagination" @prev="getModel" @next="getModel"></pagination>        
    </div>
</template>

<script>
    export default {
        props: {
            columns: {
                type: Array,
                required: true,
            },
            filters: {
                type: Object,
                default(){
                    return {
                        itemPerPage: 10,
                        search: '',
                        column: 'id',
                        dir: 'desc',
                    }
                }
            },
            pagination: {
                type: Object,
                default(){
                    return {
                        lastPage: '',
                        currentPage: '',
                        total: '',
                        lastPageUrl: '',
                        nextPageUrl: '',
                        prevPageUrl: '',
                        from: '',
                        to: ''
                    }
                }
            },
            link:{
                type:String,
                required:true,
            }
        },
        data(){
            return {
                modifiedColumns:[],
            }
        },
        created(){
            let index,obj;
            this.modifiedColumns = this.columns;
            for (index in this.modifiedColumns){
                obj = this.modifiedColumns[index];
                if(!('ordarable' in obj)){
                    obj.ordarable = false;
                }
            }
        },
        mounted(){
            this.getModel();
        },
        methods:{
            columnHead(value) {
                return value.toUpperCase();
            },
            getModel(url,filter){
                if(!filter){
                    filter = this.filters;
                }if(!url){
                    url = this.link;
                }
                this.$emit('getModel',url,filter);
            },
            sortByColumn(column) {
                let result = this.columns.filter(obj => {
                    return obj.label === column;
                });
                if(result && (result[0].ordarable)){
                    if (column === this.filters.column) {
                        this.filters.dir = (this.filters.dir === 'asc') ? 'desc' : 'asc';
                    } else {
                        this.filters.column = column;
                        this.filters.dir = 'asc';
                    }
                    this.getModel();
                }               
            },
            serialNumber(key) {
                return ((this.pagination.currentPage - 1) * this.filters.itemPerPage) + 1 + key;
            },
            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.lastPageUrl = data.last_page_url;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
        },
    }
</script>