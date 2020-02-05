/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';
import VueRouter from 'vue-router';
Vue.use(VeeValidate);
Vue.use(VueRouter);

// an EventHub to share events between components
Vue.prototype.$hub = new Vue();
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('spinner-component', require('./components/SpinnerComponent.vue').default);
Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('login-component', require('./components/Auth/LoginComponent.vue').default);
Vue.component('validation-errors', require('./components/error-success/ValidateError.vue').default);
Vue.component('error-success-message', require('./components/error-success/InfoMessageComponent.vue').default);
Vue.component('delete-modal', require('./components/DeleteModalComponent.vue').default);
Vue.component('pagination', require('./components/DataTable/PaginationComponent.vue').default);
Vue.component('data-table', require('./components/DataTable/DataTable.vue').default);
Vue.component('sidebar-component', require('./components/SideBar.vue').default);

//users
Vue.component('user-index-component', require('./components/Users/IndexComponent.vue').default);

// custom directives

Vue.directive('can',{
	bind(el,binding,vnode){
		let permission = binding.arg;
		if(!window.Laravel.permissions.includes(permission)){
			const comment = document.createComment(' ');
			vnode.elm = comment;
    		vnode.text = ' ';
		    vnode.isComment = true;
		    vnode.context = undefined;
		    vnode.tag = undefined;
		    vnode.data.directives = undefined;
		}
	}
});

Vue.directive('permissions',{
	bind(el,binding,vnode){
		let permissions = binding.value;
		let flag = true;
		for(let permission in permissions){
			if(window.Laravel.permissions.indexOf(permissions[permission]) >= 0){
				flag = false;
				break;
			}
		}
		if(flag){
			const comment = document.createComment(' ');
			vnode.elm = comment;
    		vnode.text = ' ';
		    vnode.isComment = true;
		    vnode.context = undefined;
		    vnode.tag = undefined;
		    vnode.data.directives = undefined;
		}
	}
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
