<template>
    <div>
        <div class="table-responsive">
            <div class="container-flued">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select class="form-control" v-model="perPage" @input="">
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
                            <input type="text" class="form-control" placeholder="search here" v-model="filters.search" @input="$emit('getModel')">
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
        <pagination :paginator="paginate" @prev="getModel" @next="getModel"></pagination>        
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
                required: true,
            },
            link:{
                type:String,
                required:true,
            }
        },
        data(){
            return {
                paginate: '',
                modifiedColumns:[],
                perPage: 10,
            }
        },
        created(){
            // console.log(this.filters);
            let index,obj;
            this.modifiedColumns = this.columns;
            for (index in this.modifiedColumns){
                obj = this.modifiedColumns[index];
                if(!('ordarable' in obj)){
                    obj.ordarable = false;
                }
            }
            this.paginator();
        },
        mounted(){
            this.getModel();
        },
        methods:{
            columnHead(value) {
                return value.toUpperCase();
            },
            paginator(){
                this.paginate = this.pagination;
            },
            getModel(url){
                this.$emit('getModel',url);
            },
            sortByColumn(column) {
                // console.log('hello');
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
                    console.log(this.filters);
                    let newUrl = window.location.protocol+'//'+window.location.hostname+this.link+'?itemPerPage='+this.filters.itemPerPage+'&search='+this.filters.search+'&column='+this.filters.column+'&dir='+this.filters.dir;
                    this.getModel(newUrl);
                }                
            },
            onChange(event) {
                this.filters.itemPerPage = event.target.value;
                this.$emit('getModel');
            },
        },
    }
</script>