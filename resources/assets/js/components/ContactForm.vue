<style></style>

<template>
    <form action="POST" @submit.stop.prevent="submit">
        <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
        <div class="form-group" :class="{'has-error': form.errors.name}">
            <label for="name">Name</label>
            <span class="error-message" v-show="form.errors.name">{{ form.errors.name }}</span>
            <input type="text" name="name" v-model="form.data.name" class="form-control">
        </div>
        <div class="form-group" :class="{'has-error': form.errors.email}">
            <label for="email">Email</label>
            <span class="error-message" v-show="form.errors.email">{{ form.errors.email }}</span>
            <input type="text" name="email" v-model="form.data.email" class="form-control">
        </div>
        <div class="form-group" :class="{'has-error': form.errors.phone}">
            <label for="phone">Phone</label>
            <span class="error-message" v-show="form.errors.phone">{{ form.errors.phone }}</span>
            <input type="text" name="phone" v-model="form.data.phone" class="form-control">
        </div>
        <div class="form-group" :class="{'has-error': form.errors.enquiry}">
            <label for="enquiry">Message</label>
            <span class="error-message" v-show="form.errors.enquiry">{{ form.errors.enquiry }}</span>
            <input type="text" name="enquiry" v-model="form.data.enquiry" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</template>

<script type="text/babel">
    import Form from "./Form";
    import formMixin from "./mixins/formMixin";


    export default {

        mixins: [formMixin],

        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    phone: '',
                    enquiry: ''
                })
            }
        },

        methods: {

            canSubmit() {
              return true;
            },

            getUpdatedDataFromResponseData(data) {
                return {
                };
            },

            getStoreActionEventName() {
                return 'contact-message-sent';
            },

            getUpdateActionEventName() {
                return 'contact-message-updated'
            }
        }
    }
</script>