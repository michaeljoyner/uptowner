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

const options = {
    root: null,
    rootMargin: '135px 0px 0px 0px',
    threshold: [0.1]
};

const cb = (entries, obs) => {
    if(entries[0].intersectionRatio > 0.10) {
        toggleMenuClass(entries[0].target.id);
    }
    console.log(entries[0].target.id, entries[0].intersectionRatio);
};

const toggleMenuClass = (id) => {
    const sections = document.querySelectorAll('.menu-nav a');

    for(let x = 0; x < sections.length; x++) {
        if(sections[x].hash === '#' + id) {
            sections[x].classList.add('visible');
        } else {
            sections[x].classList.remove('visible');
        }
    }
};

const observer = new IntersectionObserver(cb, options);
if(document.querySelector('.menu-page-section')) {
    const sections = document.querySelectorAll('.menu-page-section');

    for(let x = 0; x < sections.length; x++) {
        observer.observe(sections[x]);
    }
}
