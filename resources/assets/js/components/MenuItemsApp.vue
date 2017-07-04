<style></style>

<template>
    <div class="menu-items-app-component">
        <menu-item v-for="item in menu_items" :key="item.id" @remove-menu-item="removeMenuItem"
                   :item-attributes="item"
        ></menu-item>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['group-id'],

        data() {
            return {
                menu_items: []
            };
        },

        mounted() {
            this.fetchMenuItems();
            eventHub.$on('menu-item-added', () => this.fetchMenuItems());
        },

        methods: {

            fetchMenuItems() {
                axios.get(`/admin/services/menu/groups/${this.groupId}/items`)
                    .then(({data}) => this.menu_items = data)
                    .catch(err => console.log(err.response));
            },

            removeMenuItem(data) {
                this.menu_items.splice(this.menu_items.indexOf(this.menu_items.find(i => i.id === data.item_id)), 1);
            }
        }
    }
</script>