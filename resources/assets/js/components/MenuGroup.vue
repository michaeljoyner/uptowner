<style></style>

<template>
    <div class="menu-group-component menu-group-index-card">
        <a :href="`/admin/menu/groups/${itemAttributes.id}`">
            <header>
                <h3 class="main-header">{{ name }}</h3>
                <p class="sub-header">{{ zh_name }}</p>
            </header>
        </a>
        <div class="body">
            <p>{{ description }}</p>
            <p>{{ zh_description }}</p>
            <menu-group-form :url="`/admin/menu/groups/${itemAttributes.id}`"
                            :formAttributes="itemAttributes"
                            form-type="update"
                            button-text="edit"
                             @menu-group-updated="updateGroup"
            ></menu-group-form>
        </div>
    </div>
</template>

<script type="text/babel">
    import setsData from "./mixins/SetsDataFromObject";

    export default {
        mixins: [setsData],

        props: ['itemAttributes'],

        data() {
            return {
                name: '',
                zh_name: '',
                description: '',
                zh_description: ''
            };
        },

        mounted() {
            this.setDataFrom(this.itemAttributes);
        },

        methods: {
            updateGroup(updated_data) {
                this.name = updated_data.name;
                this.zh_name = updated_data.zh_name;
                this.description = updated_data.description;
                this.zh_description = updated_data.zh_description;
            }
        }
    }
</script>