<style></style>

<template>
    <div class="menu-pages-app-component">
        <menu-page v-for="page in pages" :key="page.id" :itemAttributes="page"></menu-page>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                pages: []
            };
        },

        mounted() {
            this.fetchPages();
            eventHub.$on('menu-page-added', () => this.fetchPages());
        },

        methods: {
            fetchPages() {
                axios.get('/admin/services/menu/pages')
                    .then(({data}) => this.pages = data)
                    .catch(err => console.log(err));
            }
        }
    }
</script>