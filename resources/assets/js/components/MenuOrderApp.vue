<style></style>

<template>
    <div class="menu-order-app-component">
        <div class="menu-breadcrumbs">
            <p class="menu-top"
               :class="{'active': isCurrentPage(null, null)}"
               @click="setCurrentList(null, null)"
            >Menu</p>
            <ul>
                <li v-for="page in pages">
                    <p class="menu-top"
                       :class="{'active': isCurrentPage(page.parent.page, null)}"
                       @click="setCurrentList(page.parent.page, null)"
                    >{{ page.name }}</p>
                    <ul>
                        <li v-for="group in positioned(page.list)">
                            <p class="menu-inner"
                               :class="{'active': isCurrentPage(page.parent.page, group.id)}"
                               @click="setCurrentList(page.parent.page, group.id)"
                            >{{ group.name }}</p>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu-order-list-box">
            <p class="lead">Drag the list items into the order you would like them to appear on your menu.</p>
            <item-orderer :items="sorting_list" :sync-url="sync_url"></item-orderer>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                lists: null,
                current_list: {page: null, group: null}
            };
        },

        computed: {
            sorting_list() {
                if (this.lists === null) {
                    return [];
                }
                return this.lists.find(list => (list.parent.group === this.current_list.group) && (list.parent.page === this.current_list.page)).list;
            },

            sync_url() {
                const page = this.current_list.page;
                const group = this.current_list.group;

                if (page === null && group === null) {
                    return '/admin/services/menu/pages/order';
                }
                if (group === null && page !== null) {
                    return `/admin/services/menu/pages/${page}/groups/order`;
                }

                return `/admin/services/menu/groups/${group}/items/order`;
            },

            pages() {
                if (this.lists === null) {
                    return [];
                }
                return this.lists
                    .filter(list => this.isPageList(list))
                    .map(list => {
                        const page = this.getGroupPage(list);
                        return Object.assign({}, list, {name: page.name, position: page.position});
                    }).sort((a, b) => a.position - b.position);
            }
        },

        mounted() {
            this.fetchLists();

        },

        methods: {
            fetchLists() {
                axios.get('/admin/services/menu/order/lists')
                    .then(({data}) => this.lists = data)
                    .catch(err => console.log(err));
            },

            setCurrentList(page_id, group_id) {
                this.current_list.page = page_id;
                this.current_list.group = group_id;
            },

            getRootList() {
                return this.lists.find(l => l.parent.page === null && l.parent.group === null);
            },

            positioned(list) {
                return list.map(e => e).sort((a,b) => a.position - b.position);
            },

            isPageList(list) {
                return (list.parent.page) !== null && (list.parent.group === null);
            },

            getGroupPage(group) {
                return this.getRootList().list.find(p => p.id === group.parent.page);
            },

            isCurrentPage(page, group) {
                return (this.current_list.page === page) && (this.current_list.group === group);
            }
        }
    }
</script>