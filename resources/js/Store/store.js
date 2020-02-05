import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

new Vuex.Store({
	state:{
		filters:{
			itemPerPage: 10,
            search: '',
            column: 'id',
            dir: 'desc',
		}
	}
});