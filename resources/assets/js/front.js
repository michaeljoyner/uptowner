window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Flickity from "flickity-imagesloaded";
window.Flickity = Flickity;

window.swal = require('sweetalert');
window.Vue = require('vue');

import jump from "jump.js";
window.jump = jump;



Vue.component('modal', require('./components/Modal.vue'));
Vue.component('scroll-link', require('./components/ScrollToLink.vue'));
Vue.component('instagram-feed', require('./components/InstagramFeed.vue'));
Vue.component('contact-form', require('./components/ContactForm.vue'));
window.eventHub = new Vue();

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



const to_top = document.querySelector('.footer_logo_top_link');

if(to_top) {
    to_top.addEventListener('click', () => {
        jump('#app', {offset: -75});
    });
}