<style></style>

<template>
    <div class="events-app-component">
        <event-item v-for="event in events" :key="event.id" @remove-event="removeEvent"
                    :event-attributes="event"
        ></event-item>
    </div>
</template>

<script type="text/babel">
    import moment from 'moment';

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