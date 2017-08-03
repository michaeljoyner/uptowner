window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.swal = require('sweetalert');
window.Vue = require('vue');



Vue.component('modal', require('./components/Modal.vue'));
Vue.component('scroll-link', require('./components/ScrollToLink.vue'));
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

// import smooth from "smooth-scroll";



// window.sroller = require('smooth-scroll/dist/js/smooth-scroll');
// window.sroller = smooth;
// var scroll = new SmoothScroll('a[href*="#"]', {
//     // Selectors
//     ignore: '[data-scroll-ignore]', // Selector for links to ignore (must be a valid CSS selector)
//     header: null, // Selector for fixed headers (must be a valid CSS selector)
//
//     // Speed & Easing
//     speed: 500, // Integer. How fast to complete the scroll in milliseconds
//     offset: 0, // Integer or Function returning an integer. How far to offset the scrolling anchor location in pixels
//     easing: 'easeInOutCubic', // Easing pattern to use
//     customEasing: function (time) {}, // Function. Custom easing pattern
//
//     // Callback API
//     before: function () {}, // Callback to run before scroll
//     after: function () {} // Callback to run after scroll
// });