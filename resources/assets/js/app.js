
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import sweetalert from "sweetalert";

import Vue from 'vue';
window.Vue = Vue;

import Datepicker from 'vuejs-datepicker';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import PasswordEmail from './components/PasswordEmailRequest.vue';
import Modal from './components/Modal.vue';
import AddUser from './components/AddUser.vue';
import DeleteButton from './components/DeleteButt.vue';
import UserApp from './components/UsersApp.vue';
import MenuGroupForm from './components/MenuGroupForm.vue';
import MenuGroupApp from './components/MenuGroupApp.vue';
import MenuGroup from './components/MenuGroup.vue';
import MenuItemForm from './components/MenuItemForm.vue';
import MenuItemApp from './components/MenuItemsApp.vue';
import MenuItem from './components/MenuItem.vue';
import SingleUpload from './components/Singleupload.vue';
import SmallSwitch from './components/SmallSwitch.vue';
import IconSwitch from './components/IconSwitch.vue';
import EventForm from './components/EventForm.vue';
import EventApp from './components/EventsApp.vue';
import EventItem from './components/EventItem.vue';
import SpecialForm from './components/SpecialForm.vue';
import SpecialApp from './components/SpecialsApp.vue';
import SpecialItem from './components/Special.vue';
import FeaturedApp from './components/FeaturedItemApp.vue';
import MenuItemSmall from './components/MenuItemSmall.vue';
import FeaturedItem from './components/FeaturedItem.vue';
import MenuPageForm from './components/MenuPageForm.vue';
import MenuPageApp from './components/MenuPagesApp.vue';
import MenuPage from './components/MenuPage.vue';
import MenuPageGroupsApp from './components/MenuPageGroupsApp.vue';
import DraggableMenuGroup from './components/DraggableMenuGroup.vue';
import AssignedMenuGroup from './components/AssignedMenuGroup.vue';
import ItemOrderer from './components/ItemOrderer.vue';
import MenuOrderApp from './components/MenuOrderApp.vue';

Vue.component('password-email', PasswordEmail);
Vue.component('modal', Modal);
Vue.component('add-user', AddUser);
Vue.component('delete-button', DeleteButton);
Vue.component('user-app', UserApp);
Vue.component('menu-group-form', MenuGroupForm);
Vue.component('menu-group-app', MenuGroupApp);
Vue.component('menu-group', MenuGroup);
Vue.component('menu-item-form', MenuItemForm);
Vue.component('menu-item-app', MenuItemApp);
Vue.component('menu-item', MenuItem);
Vue.component('single-upload', SingleUpload);
Vue.component('small-switch', SmallSwitch);
Vue.component('icon-switch', IconSwitch);
Vue.component('event-form', EventForm);
Vue.component('event-app', EventApp);
Vue.component('event-item', EventItem);
Vue.component('special-form', SpecialForm);
Vue.component('special-app', SpecialApp);
Vue.component('special-item', SpecialItem);
Vue.component('featured-app', FeaturedApp);
Vue.component('menu-item-small', MenuItemSmall);
Vue.component('featured-item', FeaturedItem);
Vue.component('menu-page-form', MenuPageForm);
Vue.component('menu-page-app', MenuPageApp);
Vue.component('menu-page', MenuPage);
Vue.component('menu-page-groups-app', MenuPageGroupsApp);
Vue.component('draggable-menu-group', DraggableMenuGroup);
Vue.component('assigned-menu-group', AssignedMenuGroup);
Vue.component('item-orderer', ItemOrderer);
Vue.component('menu-order-app', MenuOrderApp);

Vue.component('datepicker', Datepicker);

window.eventHub = new Vue();
window.swal = sweetalert;

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
