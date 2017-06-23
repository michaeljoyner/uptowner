<style></style>

<template>
    <div class="events-app-component">
        <event-item v-for="event in events" :key="event.id" @remove-event="removeEvent"
                    :item-id="event.id"
                    :item-event-date="event.event_date"
                    :item-name="event.name['en']"
                    :item-zh-name="event.name['zh']"
                    :item-description="event.description['en']"
                    :item-zh-description="event.description['zh']"
                    :item-time-of-day="event.time_of_day['en']"
                    :item-zh-time-of-day="event.time_of_day['zh']"
                    :item-published="event.published"
        ></event-item>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                events: []
            };
        },

        mounted() {
            this.fetchEvents();
            eventHub.$on('event-added', () => this.fetchEvents());
        },

        methods: {

            fetchEvents() {
                axios.get('/admin/services/events')
                    .then(({data}) => this.events = data)
                    .catch(err => console.log(err.response));
            },

            removeEvent({id}) {
                const removed = this.events.find(e => e.id === id);
                const index = this.events.indexOf(removed);
                this.events.splice(index, 1);
            }


        }
    }
</script>