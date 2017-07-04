<style></style>

<template>
    <span class="add-special-component">
        <button class="dd-btn btn" @click="modalOpen = true">{{ formType === 'create' ? 'New Special' : 'Edit' }}</button>
        <modal :show="modalOpen">
            <div slot="header">
                <h3>{{ formType === 'create' ? 'Create a New Special' : 'Update This Special' }}</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
                <form action="" class="dd-form" @submit.stop.prevent="submit">
                    <div class="form-group" :class="{'has-error': form.errors.title}">
                        <label for="name">Title</label>
                        <span class="error-message" v-show="form.errors.title">{{ form.errors.title }}</span>
                        <input type="text" name="title" v-model="form.data.title" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.zh_title}">
                        <label for="zh_title">Chinese Title</label>
                        <span class="error-message" v-show="form.errors.zh_title">{{ form.errors.zh_title }}</span>
                        <input type="text" name="zh_title" v-model="form.data.zh_title" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.description}">
                        <label for="description">Description</label>
                        <span class="error-message" v-show="form.errors.description">{{ form.errors.description }}</span>
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
                        <input type="number" step="1" min="0" max="99999" name="price" v-model="form.data.price" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.start_date}">
                        <label for="start_date">Start Date</label>
                        <span class="error-message" v-show="form.errors.start_date">{{ form.errors.start_date }}</span>
                        <input type="date" name="start_date" v-model="form.data.start_date" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.end_date}">
                        <label for="end_date">End Date</label>
                        <span class="error-message" v-show="form.errors.end_date">{{ form.errors.end_date }}</span>
                        <input type="date" name="end_date" v-model="form.data.end_date" class="form-control">
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
    import moment from 'moment';

    export default {
        props: {
            url: {
                required: true,
                type: String
            },
            'form-type': {
                required: true,
                type: String
            },
            'form-attributes': {
                required: false,
                type: Object,
                default() {
                    return {};
                }
            }
        },

        data() {
            return {
                modalOpen: false,
                waiting: false,
                mainError: '',
                form: new Form({
                    title: this.formAttributes.title || '',
                    zh_title: this.formAttributes.zh_title || '',
                    description: this.formAttributes.description || '',
                    zh_description: this.formAttributes.zh_description || '',
                    price: this.formAttributes.price || 0,
                    start_date: this.formAttributes.start_date || moment().add(7, 'days').format('YYYY-MM-DD'),
                    end_date: this.formAttributes.end_date || moment().add(14, 'days').format('YYYY-MM-DD')
                }),
            };
        },

        methods: {

            submit() {
                this.clearErrors();

                if(! this.canSubmit()) {
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
                const updated_special = res.data;
                this.waiting = false;

                if(this.formType === 'create') {
                    this.form.clearForm();
                } else {
                    this.form.clearForm({
                        title: updated_special.title,
                        zh_title: updated_special.zh_title,
                        description: updated_special.description,
                        zh_description: updated_special.zh_description,
                        price: updated_special.price,
                        start_date: updated_special.start_date,
                        end_date: updated_special.end_date
                    });
                }

                this.modalOpen = false;
                this.emitEvent(updated_special);
            },

            emitEvent(special_data) {
                if(this.formType === 'create') {
                    return eventHub.$emit('special-added');
                }
                this.$emit('special-updated', special_data);
            },

            onFailure(res) {
                this.waiting = false;
                if(res.status === 422) {
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