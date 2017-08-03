<style></style>

<template>
    <div class="event-item-component">
        <div class="event-header">
            <p class="event-date">{{ formatted_date }}</p>
        </div>
        <div class="event-body">
            <div class="event-image single-image-uploader-box">
                <single-upload :default="eventAttributes.image"
                               :url="`/admin/events/${eventAttributes.id}/image`"
                               size="preview"
                               :preview-width="200"
                               :preview-height="150"
                               :unique="eventAttributes.id"
                ></single-upload>
            </div>
            <div class="event-en">
                <p class="event-title">{{ name }}</p>
                <p class="time-of-day">{{ time_of_day }}</p>
                <p class="event-description">{{ description }}</p>
            </div>
            <div class="event-zh">
                <p class="event-title">{{ zh_name }}</p>
                <p class="time-of-day">{{ zh_time_of_day }}</p>
                <p class="event-description">{{ zh_description }}</p>
            </div>
        </div>
        <div class="event-actions">
            <icon-switch switch-field="feature"
                         :initial="eventAttributes.featured"
                         :url="`/admin/events/${eventAttributes.id}/feature`"
                         :unique="`feat-${eventAttributes.id}`"
                         component-class="slide-switch"
                         @switch-flipped="featuredChanged"
            >
                <span slot="label">Feature</span>
                <div slot="icon">
                    <div class="switch-rail"></div>
                    <div class="switch-knob"></div>
                </div>
            </icon-switch>
            <event-form :url="`/admin/events/${eventAttributes.id}`"
                        form-type="update"
                        button-text="edit"
                        :form-attributes="eventAttributes"
                        @event-updated="updateEvent"
            ></event-form>
            <icon-switch switch-field="published"
                         :initial="eventAttributes.published"
                         :url="`/admin/events/${eventAttributes.id}/publish`"
                         :unique="`pub-${eventAttributes.id}`"
                         component-class="slide-switch"
            >
                <span slot="label">Publish</span>
                <div slot="icon">
                    <div class="switch-rail"></div>
                    <div class="switch-knob"></div>
                </div>
            </icon-switch>
            <delete-button :delete-url="`/admin/events/${eventAttributes.id}`" @item-deleted="removeItem"></delete-button>
        </div>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';
    import setsData from './mixins/SetsDataFromObject';

    export default {

        props: ['event-attributes'],

        mixins: [setsData],

        data() {
            return {
                event_date: null,
                name: '',
                zh_name: '',
                description: '',
                zh_description: '',
                time_of_day: '',
                zh_time_of_day: ''
            };
        },

        computed: {
            formatted_date() {
                return moment(this.event_date).format("dddd, MMM Do YYYY");
            }
        },

        mounted() {
            this.setDataFrom(this.eventAttributes);
        },

        methods: {

            removeItem() {
                this.$emit('remove-event', {id: this.id});
            },

            updateEvent(updated_data) {
                this.setDataFrom(updated_data);
            },

            featuredChanged() {
                eventHub.$emit('event-featured');
            }
        }
    }
</script>