<style></style>

<template>
    <span class="delete-button-component">
        <div class="delete-button-outer" :class="{'alerted': alert}">

            <div class="delete-actual">
                <form action="" @submit.stop.prevent="doDelete">
                    <button>
                        <span v-show="!waiting">Do it!</span>
                        <div class="spinner" v-show="waiting">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </button>
                </form>
            </div>
            <div @click="toggleAlertState" class="delete-button-slider">
                <span v-text="slide_label"></span>
            </div>
        </div>
    </span>
</template>

<script type="text/babel">
    export default {

        props: ['delete-url'],

        data() {
            return {
                alert: false,
                waiting: false
            };
        },

        computed: {

            slide_label() {
                return this.alert ? 'No, wait.' : 'Delete';
            }
        },

        methods: {

            doDelete() {
                this.waiting = true;
                axios.delete(this.deleteUrl)
                        .then(res => this.onSuccess(res))
                        .catch(err => this.onFailure(err));
            },

            onSuccess(res) {
                this.waiting = false;
                this.alert = false;
                this.$emit('item-deleted', {response: res});
            },

            onFailure(err) {
                this.waiting = false;
                this.alert = false;
                eventHub.$emit('user-alert', {
                    type: 'error',
                    text: 'An error has occurred. Please delete and try again later. Thanks.',
                    title: 'Damn it!',
                    confirm: true
                });
            },

            toggleAlertState() {
                this.alert = ! this.alert;
            }

        }
    }
</script>