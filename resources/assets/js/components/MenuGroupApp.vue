<style></style>

<template>
    <div class="menu-group-app-component">
        <article class="menu-group-index-card" v-for="group in menu_groups">
            <a :href="`/admin/menu/groups/${group.id}`">
                <header>
                    <h3 class="main-header">{{ group.name['en'] }}</h3>
                    <p class="sub-header">{{ group.name['zh'] }}</p>
                </header>
            </a>
            <div class="body">
                <p>{{ group.description['en'] }}</p>
                <p>{{ group.description['zh'] }}</p>
            </div>
        </article>
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                menu_groups: []
            };
        },

        mounted() {
            this.fetchMenuGroups();
            eventHub.$on('menu-group-added', () => this.fetchMenuGroups());
        },

        methods: {

            fetchMenuGroups() {
                axios.get('/admin/services/menu/groups')
                    .then(({data}) => this.menu_groups = data)
                    .catch(err => console.log(err.response));
            }
        }
    }
</script>