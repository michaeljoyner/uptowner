<style></style>

<template>
    <div class="password-email-request-component">
        <div class="notification-box">
            <div class="notification-message success" v-show="linkSent">
                <span>A password link has been sent to your email address.</span>
                <span class="close-btn" @click="clearNotification">&times;</span>
            </div>
            <div class="notification-message failure" v-show="failMessage">
                <span>{{ failMessage }}</span>
                <span class="close-btn" @click="clearNotification">&times;</span>
            </div>
        </div>
        <form @submit.stop.prevent="requestLink" class="password-email-form" :class="{'waiting': waiting}">
            <div class="buttoned-input">
                <input type="email" v-model="email">
                <button :disabled="waiting" type="submit">{{ waiting ? 'Wait' : 'Send' }}</button>
            </div>
        </form>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['form-action'],

        data() {
            return {
                linkSent: false,
                failMessage: '',
                email: '',
                waiting: false
            };
        },

        methods: {

            requestLink() {
                this.linkSent = false;
                this.waiting = true;
                axios.post(this.formAction, {email: this.email})
                        .then(({data}) => this.onSuccess(data))
                        .catch((err) => this.onFail(err.response))
            },

            onSuccess(res) {
                console.log(res);
                this.linkSent = true;
                this.waiting = false;
            },

            onFail({data}) {
                this.failMessage = data.email[0];
                this.waiting = false;
            },

            clearNotification() {
                this.failMessage = '';
                this.linkSent = false;
            }

        }
    }
</script>