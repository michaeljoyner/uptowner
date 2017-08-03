<style></style>

<template>
    <div class="item-orderer-component">
        <p class="lead" v-if="! items.length">There is nothing in this list yet.</p>
        <ul class="sortable-list list-group" ref="sortablelist">
            <li v-for="item in sorted_items" class="list-group-item" :data-id="item.id">{{ item.name }}</li>
        </ul>
    </div>
</template>

<script type="text/babel">
    import Sortable from 'sortablejs';

    export default {

        props: ['items', 'sync-url'],

        data() {
            return {
                sort_list: null,
                syncing: false
            };
        },

        computed: {
            sorted_items() {
                return this.items.sort((a, b) => a.position - b.position);
            }
        },

        mounted() {
            this.sort_list = Sortable.create(this.$refs.sortablelist, {
                onSort: () => this.syncChanges()
            });
        },

        methods: {
            syncChanges() {
                this.syncing = true;
                axios.post(this.syncUrl, {order: this.sort_list.toArray()})
                    .then(() => this.onSuccess())
                    .catch(err => this.onFailure(err));
            },

            onSuccess() {
                   this.syncing = false;
                   this.$emit('list-sorted', this.sort_list.toArray());
            },

            onFailure() {
                this.syncing = false;
                console.log('Failed to sort');
            }
        }
    }
</script>