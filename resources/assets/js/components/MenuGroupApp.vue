<style></style>

<template>
    <div class="menu-group-app-component">
        <div class="right-strip">
            <div>
                <span>Filter groups by name: </span>
                <input type="search" v-model="filter_query" class="form-text-input">
            </div>
        </div>
        <menu-group v-for="group in filtered_groups"
                    :key="group.id"
                    :itemAttributes="group"
                    @menu-group-deleted="removeGroup(group)"
        ></menu-group>
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                menu_groups: [],
                filter_query: ''
            };
        },

        computed: {
            filtered_groups() {
                if (this.filter_query === '') {
                    return this.menu_groups;
                }

                return this.menu_groups.filter(group => this.queryMatchesGroupName(group));
            }
        },

        mounted() {
            this.fetchMenuGroups();
            eventHub.$on('menu-group-added', () => this.fetchMenuGroups());
        },

        methods: {

            queryMatchesGroupName(group) {
                const query = this.filter_query.toLowerCase();
                return (group.name.toLowerCase().indexOf(this.filter_query) !== -1) ||
                    (group.zh_name.toLowerCase().indexOf(this.filter_query) !== -1);
            },

            fetchMenuGroups() {
                axios.get('/admin/services/menu/groups')
                    .then(({data}) => this.menu_groups = data)
                    .catch(err => console.log(err.response));
            },

            removeGroup(group) {
                this.menu_groups.splice(this.menu_groups.indexOf(group), 1);
            }
        }
    }
</script>