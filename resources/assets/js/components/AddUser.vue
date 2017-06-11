<style></style>

<template>
    <span class="add-user-component">
        <button class="dd-btn btn" @click="modalOpen = true">Add User</button>
        <modal :show="modalOpen">
            <div slot="header">
                <h3>Register a New User</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
                <form action="" class="dd-form" @submit.stop.prevent="submit">
                    <div class="form-group" :class="{'has-error': errors.name}">
                        <label for="name">Name</label>
                        <span class="error-message" v-show="errors.name">{{ errors.name }}</span>
                        <input type="text" name="name" v-model="form.name" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': errors.email}">
                        <label for="email">Your email</label>
                        <span class="error-message" v-show="errors.email">{{ errors.email }}</span>
                        <input type="email" v-model="form.email" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': errors.password}">
                        <label for="password">Password</label>
                        <span class="error-message" v-show="errors.password">{{ errors.password }}</span>
                        <input type="password" name="password" v-model="form.password" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': errors.password_confirmation}">
                        <label for="password_confirmation">Confirm Password</label>
                        <span class="error-message" v-show="errors.password_confirmation">{{ errors.password_confirmation }}</span>
                        <input type="password" name="password_confirmation" v-model="form.password_confirmation"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="dd-checkbox-option">
                            <input type="checkbox" id="superadmin" name="superadmin" v-model="form.superadmin">
                            <label for="superadmin">Is Super Admin</label>
                        </div>
                    </div>
                    <div class="modal-form-button-bar">
                        <button class="dd-btn btn" type="button" @click="modalOpen = false">Cancel</button>
                        <button class="btn dd-btn" type="submit" :disabled="waiting">
                            <span v-show="!waiting">Add User</span>
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
    export default {

        data() {
            return {
                modalOpen: false,
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    superadmin: false
                },
                errors: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    superadmin: ''
                },
                waiting: false,
                mainError: ''
            };
        },

        methods: {

            submit() {
                this.waiting = true;
                this.clearErrors();

                if(! this.canSubmit()) {
                    return;
                }

                axios.post('/admin/users', this.form)
                        .then(res => this.onSuccess(res))
                        .catch(({response}) => this.onFailure(response));
            },

            canSubmit() {
                if(this.form.password !== this.form.password_confirmation) {
                    this.errors.password_confirmation = 'Password confirmation does not match password';
                    return false;
                }

                return true;
            },

            onSuccess(res) {
                this.waiting = false;
                this.clearForm();
                this.modalOpen = false;
                eventHub.$emit('user-added', res.data);
            },

            onFailure(res) {
                this.waiting = false;
                if(res.status === 422) {
                    return this.showValidationErrors(res.data);
                }

                this.mainError = 'Unable to register new user. Please refresh and try again later.';
            },

            showValidationErrors(errors) {
                Object.keys(errors).forEach(field => {
                    if(this.errors.hasOwnProperty(field)) {
                        this.errors[field] = errors[field][0];
                    }
                });
            },

            clearErrors() {
                Object.keys(this.errors).forEach(field => this.errors[field] = '');
                this.mainError = '';
            },

            clearForm() {
                this.form = {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    superadmin: false
                }
            }
        }
    }
</script>