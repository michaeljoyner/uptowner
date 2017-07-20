<style></style>

<template>
    <div class="featured-menu-item-app-component">
        <div class="menu-item-selection">
            <div class="search-box form-group">
                <label for="">Search for menu items by name</label>
                <input type="" v-model="query" class="form-control">
            </div>
            <p>To feature a menu item, drag it into the "Featured Items" box.</p>
            <menu-item-small v-for="item in selection"
                             :key="item.id"
                             :itemAttributes="item"
            ></menu-item-small>
        </div>
        <div class="current-featured-items">
            <p class="lead text-center">Featured Items</p>
            <div class="featured-items-box"
                 @dragover="dragOverBox($event)"
                 @dragenter="dragEnterBox($event)"
                 @drop="itemDropped($event)"
            >
                <featured-item v-for="featured in featured_items"
                               :key="featured.id"
                               :item-attributes="featured"
                               @remove-featured-item="removeFromFeatured(featured)"
                ></featured-item>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                query: '',
                all_items: [],
                featured_items: [],
            };
        },

        computed: {
            selection() {
                if(this.query.length < 3) {
                    return [];
                }

                return this.all_items
                    .filter(item => this.itemMatchesQuery(item, this.query.toLowerCase()))
                    .filter(item => this.itemIsNotCurrentlyFeatured(item));
            }
        },

        mounted() {
            this.fetchMenuItems();
            this.fetchFeaturedItems();
        },

        methods: {

            itemMatchesQuery(item, query) {
                return (item.name.toLowerCase().indexOf(query) !== -1) || (item.zh_name.toLowerCase().indexOf(query) !== -1);
            },

            itemIsNotCurrentlyFeatured(item) {
                return ! this.featured_items.find(i => i.id === item.id);
            },

            fetchMenuItems() {
                axios.get('/admin/services/menu/items')
                    .then(({data}) => this.all_items = data)
                    .catch(err => console.log(err.response));
            },

            fetchFeaturedItems() {
                axios.get('/admin/services/menu/featured')
                    .then(({data}) => this.featured_items = data)
                    .catch(err => console.log(err.response));
            },

            dragEnterBox(event) {
                if([...event.dataTransfer.types].includes('it_is_a_menu_item')) {
                    event.stopPropagation();
                    event.preventDefault();
                }
            },

            dragOverBox(event) {
                if([...event.dataTransfer.types].includes('it_is_a_menu_item')) {
                    event.stopPropagation();
                    event.preventDefault();
                }
            },

            itemDropped(event) {
                const item_id = parseInt(event.dataTransfer.getData('text/plain'));
                this.addItemToFeaturedCollection(item_id);
            },

            addItemToFeaturedCollection(item_id) {
                const item = this.all_items.find(item => item.id === item_id);
                this.featured_items.unshift(item);
                axios.post('/admin/menu/featured', {id: item_id})
                    .then(() => this.fetchFeaturedItems())
                    .catch(err => console.log(err.response));
            },

            removeFromFeatured(item) {
                console.log(item);
                this.featured_items.splice(this.featured_items.indexOf(item), 1);
                axios.delete(`/admin/menu/featured/${item.id}`)
                    .then(() => this.fetchFeaturedItems())
                    .catch(err => console.log(err));
            }
        }
    }
</script>