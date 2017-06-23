<style></style>

<template>
    <span class="small-switch-component">
        <div class="switch-outer">
            <span>{{ switchLabel }}</span>
            <label :for="`switch-checkbox-${unique}`" class="switch-container" :class="{'active': is_on}">
                <input type="checkbox"
                       :disabled="syncing"
                       v-model="is_on"
                       @change="syncStatus"
                       :id="`switch-checkbox-${unique}`">
                <div class="switch-rail"></div>
                <div class="switch-knob"></div>
            </label>
        </div>
    </span>
</template>

<script type="text/babel">
    export default {
        props: ['url', 'switch-field', 'initial', 'switch-label', 'unique'],

        data() {
            return {
                is_on: false,
                syncing: false,
                previous_state: false
            };
        },

        mounted() {
            this.is_on = this.initial;
        },

        methods: {

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
            },

            onFailure(error) {
                this.syncing = false;
                this.is_on = this.previous_status;
            }
        }
    }
</script>