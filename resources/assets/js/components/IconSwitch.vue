<style></style>

<template>
    <span class="icon-switch-component" :class="componentClass">
        <div class="switch-outer">
            <slot name="label"></slot>
            <label :for="`switch-${unique}`" class="switch-container" :class="{'active': is_on}">
                <slot name="icon"></slot>
                <input type="checkbox" v-model="is_on" :id="`switch-${unique}`" @change="syncStatus" :disabled="syncing">
            </label>
        </div>
    </span>
</template>

<script type="text/babel">
    export default {

        props: ['url', 'switch-field', 'initial', 'unique', 'component-class'],

        data() {
            return {
                is_on: false,
                syncing: false,
                previous_state: false,
            };
        },

        mounted() {
            this.inflateFromProps();
        },

        methods: {

            inflateFromProps() {
                this.is_on = this.initial;
            },

            syncStatus() {
                this.syncing = true;
                this.previous_status = ! this.is_on;
                axios.post(this.url, {[this.switchField]: this.is_on})
                    .then(({data}) => this.onSuccess(data))
                    .catch(err => this.onFailure(err.response));
            },

            onSuccess(response) {
                this.syncing = false;
                this.is_on = response.new_status;
                this.$emit('switch-flipped', {current_status: this.is_on});
            },

            onFailure(error) {
                this.syncing = false;
                this.is_on = this.previous_status;
            }
        }
    }
</script>