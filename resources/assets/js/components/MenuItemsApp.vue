<style></style>

<template>
    <div class="menu-items-app-component">
        <menu-item v-for="item in menu_items" :key="item.id" @remove-menu-item="removeMenuItem"
                   :item-name="item.name['en']"
                   :item-zh-name="item.name['zh']"
                   :item-description="item.description['en']"
                   :item-zh-description="item.description['zh']"
                   :item-price="item.price"
                   :item-id="item.id"
                   :item-thumb_src="item.thumb_src"
                   :unique="item.id"
                   :item-published="item.published"
                   :item-spicy="item.is_spicy"
                   :item-vegetarian="item.is_vegetarian"
                   :item-recommended="item.is_recommended"
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