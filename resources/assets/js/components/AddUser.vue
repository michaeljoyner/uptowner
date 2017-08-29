<style></style>

<template>
    <span class="add-user-component">
        <button class="dd-btn btn" @click="modalOpen = true">Add User</button>
        <modal :show="modalOpen" class="form-modal">
            <div slot="header">
                <h3>Register a New User</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
                <form action="" class="dd-form" @submit.stop.prevent="submit">
                    <div class="form-group" :class="{'has-error': form.errors.name}">
                        <label for="name">Name</label>
                        <span class="error-message" v-show="form.errors.name">{{ form.errors.name }}</span>
                        <input type="text" name="name" v-model="form.data.name" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.email}">
                        <label for="email">Your email</label>
                        <span class="error-message" v-show="form.errors.email">{{ form.errors.email }}</span>
                        <input type="email" v-model="form.data.email" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.password}">
                        <label for="password">Password</label>
                        <span class="error-message" v-show="form.errors.password">{{ form.errors.password }}</span>
                        <input type="password" name="password" v-model="form.data.password" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.password_confirmation}">
                        <label for="password_confirmation">Confirm Password</label>
                        <span class="error-message" v-show="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</span>
                        <input type="password" name="password_confirmation" v-model="form.data.password_confirmation"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="dd-checkbox-option">
                            <input type="checkbox" id="superadmin" name="superadmin" v-model="form.data.superadmin">
                            <label for="superadmin">Is Super Admin</label>
                        </div>
                    </div>
                    <div class="modal-form-button-bar">
                        <button class="dd-btn btn btn-grey" type="button" @click="modalOpen = false">Cancel</button>
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
    import Form from './Form';
    
    export default {

        data() {
            return {
                modalOpen: false,
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    superadmin: false
                }),
                waiting: false,
                mainError: ''
            };
        },

        methods: {

            submit() {
                this.clearErrors();

                if(! this.canSubmit()) {
                    return;
                }

                this.waiting = true;
                axios.post('/admin/users', this.form.data)
                        .then(res => this.onSuccess(res))
                        .catch(({response}) => this.onFailure(response));
            },

            canSubmit() {
                if(this.form.data.password !== this.form.data.password_confirmation) {
                    this.form.errors.password_confirmation = 'Password confirmation does not match password';
                    return false;
                }

                return true;
            },

            onSuccess(res) {
                this.waiting = false;
                this.form.clearForm();
                this.modalOpen = false;
                eventHub.$emit('user-added', res.data);
            },

            onFailure(res) {
                this.waiting = false;
                if(res.status === 422) {
                    return this.form.setValidationErrors(res.data);
                }

                this.mainError = 'Unable to register new user. Please refresh and try again later.';
            },

            clearErrors() {
                this.form.clearErrors();
                this.mainError = '';
            }
        }
    }
</script>