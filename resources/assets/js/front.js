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



Vue.component('modal', require('./components/Modal.vue'));
Vue.component('scroll-link', require('./components/ScrollToLink.vue'));
Vue.component('instagram-feed', require('./components/InstagramFeed.vue'));
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

function showNavbar() {
    if(document.querySelector('.hero-cta')) {
        document.querySelector('.hero-cta').classList.remove('hidden');
    }
    document.querySelector('.main-navbar').classList.remove('hidden');
    window.removeEventListener('scroll', showNavbar);
}

window.addEventListener('scroll', showNavbar);
window.setTimeout(showNavbar, 2000);