<style></style>

<template>
    <span class="event-form-component">
        <button class="dd-btn btn" @click="modalOpen = true">{{ buttonText }}</button>
        <modal :show="modalOpen">
            <div slot="header">
                <h3>{{ formType === 'create' ? 'Add A New Event' : 'Update this Event' }}</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger" v-show="mainError">{{ mainError }}</p>
                <form action="" class="dd-form" @submit.stop.prevent="submit">
                    <div class="form-group" :class="{'has-error': form.errors.event_date}">
                        <label for="event_date">Event date</label>
                        <span class="error-message" v-show="form.errors.event_date">{{ form.errors.event_date }}</span>
                        <input type="date" name="event_date" v-model="form.data.event_date" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.time_of_day}">
                        <label for="time_of_day">Time of day</label>
                        <span class="error-message"
                              v-show="form.errors.time_of_day">{{ form.errors.time_of_day }}</span>
                        <input type="text" name="time_of_day" v-model="form.data.time_of_day" class="form-control">
                    </div>
                    <div class="form-group" :class="{'has-error': form.errors.zh_time_of_day}">
                        <label for="zh_time_of_day">Time of day (Chinese)</label>
                        <span class="error-message"
                              v-show="form.errors.zh_time_of_day">{{ form.errors.zh_time_of_day }}</span>
                        <input type="text" name="zh_time_of_day" v-model="form.data.zh_time_of_day"
                               class="form-control">
                    </div>
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
            'item-event-date': {
                type: String,
                default: ''
            },
            'item-name': {
                type: String,
                default: ''
            },
            'item-zh-name': {
                type: String,
                default: ''
            },
            'item-description': {
                type: String,
                default: ''
            },
            'item-zh-description': {
                type: String,
                default: ''
            },
            'item-time-of-day': {
                type: String,
                default: ''
            },
            'item-zh-time-of-day': {
                type: String,
                default: ''
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
                default: 'add event'
            }
        },

        data() {
            return {
                modalOpen: false,
                form: new Form({
                    name: this.itemName,
                    zh_name: this.itemZhName,
                    description: this.itemDescription,
                    zh_description: this.itemZhDescription,
                    event_date: this.itemEventDate.substr(0,10),
                    time_of_day: this.itemTimeOfDay,
                    zh_time_of_day: this.itemZhTimeOfDay,
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
                this.waiting = false;
                this.form.clearForm({
                    name: res.data.name['en'],
                    zh_name: res.data.name['en'],
                    event_date: res.data.event_date.substr(0,10),
                    description: res.data.description['en'],
                    zh_description: res.data.description['zh'],
                    time_of_day: res.data.time_of_day['en'],
                    zh_time_of_day: res.data.time_of_day['zh']
                });
                this.modalOpen = false;
                this.emitEvent(res.data);
            },

            emitEvent(data) {
                if (this.formType === 'create') {
                    return eventHub.$emit('event-added', data);
                }

                if (this.formType === 'update') {
                    return this.$emit('event-updated', {
                        name: data.name['en'],
                        zh_name: data.name['zh'],
                        description: data.description['en'],
                        zh_description: data.description['zh'],
                        event_date: data.event_date,
                        time_of_day: data.time_of_day['en'],
                        zh_time_of_day: data.time_of_day['zh']
                    });
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