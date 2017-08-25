<style></style>

<template>
    <form action="POST" @submit.stop.prevent="submit" class="w-con-600 mg-x-a w-95" :class="{'opaque': waiting}">
        <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
        <div class="form-group" :class="{'has-error': form.errors.name}">
            <label class="text-colour h6 uppercase" for="name">{{ name_label }}</label>
            <span class="error-message" v-show="form.errors.name">{{ form.errors.name }}</span>
            <input type="text" name="name" v-model="form.data.name" class="text-input">
        </div>
        <div class="form-group" :class="{'has-error': form.errors.email}">
            <label class="text-colour h6 uppercase" for="email">{{ email_label }}</label>
            <span class="error-message" v-show="form.errors.email">{{ form.errors.email }}</span>
            <input type="text" name="email" v-model="form.data.email" class="text-input">
        </div>
        <div class="form-group" :class="{'has-error': form.errors.phone}">
            <label class="text-colour h6 uppercase" for="phone">{{ phone_label }}</label>
            <span class="error-message" v-show="form.errors.phone">{{ form.errors.phone }}</span>
            <input type="text" name="phone" v-model="form.data.phone" class="text-input">
        </div>
        <div class="form-group" :class="{'has-error': form.errors.enquiry}">
            <label class="text-colour h6 uppercase" for="enquiry">{{ enquiry_label }}</label>
            <span class="error-message" v-show="form.errors.enquiry">{{ form.errors.enquiry }}</span>
            <textarea name="enquiry" v-model="form.data.enquiry" class="std-textarea"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="wmin-100 h4 text-colour uppercase bd-col bd-4 fw-700 rounded-2 pd-x-8 pd-y-2 bg-light block mg-x-a hover-btn-invert"><span v-show="!waiting">{{ submit_label }}</span>
                <div class="spinner" v-show="waiting">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </button>
        </div>
    </form>
</template>

<script type="text/babel">
    import Form from "./Form";
    import formMixin from "./mixins/formMixin";


    export default {

        props: ['form-locale'],

        mixins: [formMixin],

        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    phone: '',
                    enquiry: ''
                }),
                labels: {
                    name: {en: 'name', zh: '您的大名'},
                    email: {en: 'email', zh: '您的信箱'},
                    phone: {en: 'phone', zh: '手機號碼'},
                    enquiry: {en: 'your message', zh: '留言'},
                    submit: {en: 'Send Message', zh: '送出'}
                }
            }
        },

        computed: {
            name_label() {
                return this.labels.name[this.formLocale];
            },

            email_label() {
                return this.labels.email[this.formLocale];
            },

            phone_label() {
                return this.labels.phone[this.formLocale];
            },

            enquiry_label() {
                return this.labels.enquiry[this.formLocale];
            },

            submit_label() {
                return this.labels.submit[this.formLocale];
            }
        },

        mounted() {
          eventHub.$on('contact-message-sent', () => eventHub.$emit('user-alert', {
              type: 'success',
              title: 'Your Message has been Sent!',
              text: 'Thanks for getting in touch!',
              confirm: true
          }));
        },

        methods: {

            canSubmit() {
              return true;
            },

            getUpdatedDataFromResponseData(data) {
                return {
                };
            },

            getStoreActionEventName() {
                return 'contact-message-sent';
            },

            getUpdateActionEventName() {
                return 'contact-message-updated'
            }
        }
    }
</script>