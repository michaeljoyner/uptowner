<style></style>

<template>
    <span class="event-form-component">
        <button class="dd-btn btn" @click="modalOpen = true">{{ buttonText }}</button>
        <modal :show="modalOpen">
            <div slot="header">
                <h3>{{ formType === 'create' ? 'Add A New Page' : 'Update this Page' }}</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
                <form action="" class="dd-form" @submit.stop.prevent="submit">
                    <div class="form-group" :class="{'has-error': form.errors.name}">
                        <label for="name">Name</label>
                        <span class="error-message" v-show="form.errors.name">{{ form.errors.name }}</span>
                        <input type="text" name="name" v-model="form.data.name" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.zh_name}">
                        <label for="zh_name">Chinese name</label>
                        <span class="error-message" v-show="form.errors.zh_name">{{ form.errors.zh_name }}</span>
                        <input type="text" name="zh_name" v-model="form.data.zh_name" class="form-control">
                    </div>
                    <div class="modal-form-button-bar">
                        <button class="dd-btn btn" type="button" @click="modalOpen = false">Cancel</button>
                        <button class="btn dd-btn" type="submit" :disabled="waiting">
                            <span v-show="!waiting">{{ formType === 'create' ? 'Add' : 'Update' }} Item</span>
                            <div class="spinner" v-show="waiting">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">
    import Form from './Form';

    export default {

        props: {
            'form-attributes': {
                type: Object,
                required: false,
                default() {
                    return {};
                }
            },
            url: {
                required: true,
                type: String
            },
            'form-type': {
                type: String,
                default: 'create'
            },
            'button-text': {
                type: String,
                default: 'add page'
            }
        },

        data() {
            return {
                modalOpen: false,
                form: new Form({
                    name: this.formAttributes.name || '',
                    zh_name: this.formAttributes.zh_name || ''
                }),
                waiting: false,
                mainError: ''
            };
        },

        methods: {

            submit() {
                this.clearErrors();

                if (!this.canSubmit()) {
                    return;
                }

                this.waiting = true;
                axios.post(this.url, this.form.data)
                    .then(res => this.onSuccess(res))
                    .catch(({response}) => this.onFailure(response));
            },

            canSubmit() {
                return true;
            },

            onSuccess(res) {
                const updated_data = {
                    name: res.data.name,
                    zh_name: res.data.zh_name
                };
                this.waiting = false;
                this.form.clearForm(this.formType === 'create' ? {} : updated_data);
                this.modalOpen = false;
                this.emitEvent(updated_data);
            },

            emitEvent(updated_data) {
                if (this.formType === 'create') {
                    return eventHub.$emit('menu-page-added', updated_data);
                }

                if (this.formType === 'update') {
                    return this.$emit('menu-page-updated', updated_data);
                }
            },

            onFailure(res) {
                this.waiting = false;
                if (res.status === 422) {
                    return this.form.setValidationErrors(res.data);
                }

                this.mainError = 'There was an unexpected failure. Please refresh and try again later.';
            },

            clearErrors() {
                this.form.clearErrors();
                this.mainError = '';
            }
        }
    }
</script>