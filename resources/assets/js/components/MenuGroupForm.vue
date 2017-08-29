<style></style>

<template>
    <span class="add-menu-group-component">
        <button class="dd-btn btn" @click="modalOpen = true">{{ buttonText }}</button>
        <modal :show="modalOpen" class="form-modal">
            <div slot="header">
                <h3>{{ formType === 'create' ? 'Create a New Menu Group' : 'Edit this Menu Group' }}</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
                <form action="" class="dd-form" @submit.stop.prevent="submit">
                    <div class="form-group" :class="{'has-error': form.errors.name}">
                        <label for="name">Name</label>
                        <span class="error-message" v-show="form.errors.name">{{ form.errors.name }}</span>
                        <input type="text" name="name" v-model="form.data.name" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.name}">
                        <label for="zh_name">Chinese Name</label>
                        <span class="error-message" v-show="form.errors.zh_name">{{ form.errors.name }}</span>
                        <input type="text" name="zh_name" v-model="form.data.zh_name" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.description}">
                        <label for="description">Description</label>
                        <span class="error-message"
                              v-show="form.errors.description">{{ form.errors.description }}</span>
                        <textarea name="description"
                                  v-model="form.data.description"
                                  class="form-control"
                        ></textarea>
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.zh_description}">
                        <label for="zh_description">Chinese description</label>
                        <span class="error-message"
                              v-show="form.errors.zh_description">{{ form.errors.zh_description }}</span>
                        <textarea name="zh_description"
                                  v-model="form.data.zh_description"
                                  class="form-control"
                        ></textarea>
                    </div>
                    <div class="modal-form-button-bar">
                        <button class="dd-btn btn btn-grey" type="button" @click="modalOpen = false">Cancel</button>
                        <button class="btn dd-btn" type="submit" :disabled="waiting">
                            <span v-show="!waiting">{{ formType === 'create' ? 'Add Group' : 'Save Changes' }}</span>
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
                default: 'add menu group'
            }
        },

        data() {
            return {
                modalOpen: false,
                form: new Form({
                    name: this.formAttributes.name || '',
                    zh_name: this.formAttributes.zh_name || '',
                    description: this.formAttributes.description || '',
                    zh_description: this.formAttributes.zh_description || ''
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
                    .then(({data}) => this.onSuccess(data))
                    .catch(({response}) => this.onFailure(response));
            },

            canSubmit() {
                return true;
            },

            onSuccess(data) {
                const updated_data = {
                    name: data.name,
                    zh_name: data.zh_name,
                    description: data.description,
                    zh_description: data.zh_description
                };
                this.waiting = false;
                this.form.clearForm();
                this.modalOpen = false;
                this.emitEvent(updated_data);
            },

            onFailure(res) {
                this.waiting = false;
                if (res.status === 422) {
                    return this.form.setValidationErrors(res.data);
                }

                this.mainError = 'Unable to create menu group. Please refresh and try again later.';
            },

            emitEvent(updated_data) {
                if (this.formType === 'create') {
                    return eventHub.$emit('menu-group-added', updated_data);
                }

                this.$emit('menu-group-updated', updated_data);
            },

            clearErrors() {
                this.form.clearErrors();
                this.mainError = '';
            }
        }
    }
</script>