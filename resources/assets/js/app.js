
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
window.Vue = Vue;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('password-email', require('./components/PasswordEmailRequest.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('add-user', require('./components/AddUser.vue'));
Vue.component('delete-button', require('./components/DeleteButton.vue'));
Vue.component('user-app', require('./components/UsersApp.vue'));
Vue.component('add-menu-group', require('./components/AddMenuGroup.vue'));
Vue.component('menu-group-app', require('./components/MenuGroupApp.vue'));
Vue.component('menu-item-form', require('./components/MenuItemForm.vue'));
Vue.component('menu-item-app', require('./components/MenuItemsApp.vue'));
Vue.component('menu-item', require('./components/MenuItem.vue'));
Vue.component('single-upload', require('./components/Singleupload.vue'));
Vue.component('small-switch', require('./components/SmallSwitch.vue'));
Vue.component('icon-switch', require('./components/IconSwitch.vue'));
Vue.component('event-form', require('./components/EventForm.vue'));
Vue.component('event-app', require('./components/EventsApp.vue'));
Vue.component('event-item', require('./components/EventItem.vue'));
Vue.component('special-form', require('./components/SpecialForm.vue'));
Vue.component('special-app', require('./components/SpecialsApp.vue'));
Vue.component('special-item', require('./components/Special.vue'));
Vue.component('featured-app', require('./components/FeaturedItemApp.vue'));
Vue.component('menu-item-small', require('./components/MenuItemSmall.vue'));
Vue.component('featured-item', require('./components/FeaturedItem.vue'));

window.eventHub = new Vue();
window.swal = require('sweetalert');

const app = new Vue({
    el: '#app',

    created() {
        eventHub.$on('user-alert', this.showAlert)
    },

    methods: {
        showAlert(message) {
            swal({
                type: message.type,
                title: message.title,
                text: message.text,
                showConfirmButton: message.confirm
            });
        }
    }
});
