<style></style>

<template>
    <span class="add-menu-item-component">
        <button class="dd-btn btn" @click="modalOpen = true">{{ buttonText }}</button>
        <modal :show="modalOpen"  class="form-modal">
            <div slot="header">
                <h3>{{ formType === 'create' ? 'Add A New Menu Item' : 'Update this Menu Item' }}</h3>
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
                        <label for="zh_name">Chinese Name</label>
                        <span class="error-message" v-show="form.errors.zh_name">{{ form.errors.zh_name }}</span>
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
                              v-show="form.errors.zh_description"
                        >{{ form.errors.zh_description }}</span>
                        <textarea name="zh_description"
                                  v-model="form.data.zh_description"
                                  class="form-control"
                        ></textarea>
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.price}">
                        <label for="price">Price</label>
                        <span class="error-message" v-show="form.errors.price">{{ form.errors.price }}</span>
                        <input type="number" step="1" min="0" max="99999" name="price" v-model="form.data.price"
                               class="form-control">
                    </div>
                    <div class="modal-form-button-bar">
                        <button class="dd-btn btn btn-grey" type="button" @click="modalOpen = false">Cancel</button>
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
                required: false,
                type: Object,
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
                default: 'add menu item'
            }
        },

        data() {
            return {
                modalOpen: false,
                form: new Form({
                    name: this.formAttributes.name || '',
                    zh_name: this.formAttributes.zh_name || '',
                    description: this.formAttributes.description || '',
                    zh_description: this.formAttributes.zh_description || '',
                    price: this.formAttributes.price || 0
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
                const menuItem = {
                    name: res.data.name,
                    zh_name: res.data.zh_name,
                    description: res.data.description,
                    zh_description: res.data.zh_description,
                    price: res.data.price
                };
                this.waiting = false;
                this.form.clearForm(this.formType === 'create' ? {} : menuItem);
                this.modalOpen = false;
                this.emitEvent(menuItem);
            },

            emitEvent(menuItem) {
                if (this.formType === 'create') {
                    return eventHub.$emit('menu-item-added', menuItem);
                }

                if (this.formType === 'update') {
                    return this.$emit('item-updated', menuItem);
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