<style></style>

<template>
    <div class="event-item-component">
        <div class="event-header">
            <p class="event-date">{{ formatted_date }}</p>
        </div>
        <div class="event-body">
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
            <event-form :url="`/admin/events/${itemId}`"
                        form-type="update"
                        button-text="edit"
                        :item-name="itemName"
                        :item-zh-name="itemZhName"
                        :item-time-of-day="itemTimeOfDay"
                        :item-zh-time-of-day="itemZhTimeOfDay"
                        :item-description="itemDescription"
                        :item-zh-description="itemZhDescription"
                        :item-event-date="itemEventDate"
                        @event-updated="updateEvent"
            ></event-form>
            <icon-switch switch-field="published"
                         :initial="itemPublished"
                         :url="`/admin/events/${itemId}/publish`"
                         :unique="`pub-${itemId}`"
                         component-class="slide-switch"
            >
                <span slot="label">Publish</span>
                <div slot="icon">
                    <div class="switch-rail"></div>
                    <div class="switch-knob"></div>
                </div>
            </icon-switch>
            <delete-button :delete-url="`/admin/events/${itemId}`" @item-deleted="removeItem"></delete-button>
        </div>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';

    export default {

        props: [
            'item-id',
            'item-event-date',
            'item-name',
            'item-zh-name',
            'item-description',
            'item-zh-description',
            'item-time-of-day',
            'item-zh-time-of-day',
            'item-published'
        ],

        data() {
            return {
                id: null,
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
            this.inflateFromProps();
        },

        methods: {

            inflateFromProps() {
                this.id = this.itemId;
                this.event_date = this.itemEventDate;
                this.name = this.itemName;
                this.zh_name = this.itemZhName;
                this.time_of_day = this.itemTimeOfDay;
                this.zh_time_of_day = this.itemZhTimeOfDay;
                this.description = this.itemDescription;
                this.zh_description = this.itemZhDescription;
            },

            removeItem() {
                this.$emit('remove-event', {id: this.id});
            },

            updateEvent(updated_data) {
                this.event_date = updated_data.event_date;
                this.name = updated_data.name;
                this.zh_name = updated_data.zh_name;
                this.time_of_day = updated_data.time_of_day;
                this.zh_time_of_day = updated_data.zh_time_of_day;
                this.description = updated_data.description;
                this.zh_description = updated_data.zh_description;
            }
        }
    }
</script>