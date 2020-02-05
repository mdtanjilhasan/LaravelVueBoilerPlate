export const pagination = {
    data(){
        return {
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
            filters: {
                itemPerPage: 10,
                search: '',
                column: 'id',
                dir: 'desc',
            },
        }
    },
    methods:{
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
        serialNumber(key) {
            return ((this.pagination.currentPage - 1) * this.filters.itemPerPage) + 1 + key;
        },
    }
};