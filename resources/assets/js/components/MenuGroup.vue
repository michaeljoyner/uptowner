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
            <icon-switch switch-field="publish"
                         :initial="itemAttributes.published"
                         :url="`/admin/menu/groups/${itemAttributes.id}/publish`"
                         :unique="`pub-${itemAttributes.id}`"
                         component-class="slide-switch"
            >
                <span slot="label">Publish</span>
                <div slot="icon">
                    <div class="switch-rail"></div>
                    <div class="switch-knob"></div>
                </div>
            </icon-switch>
            <delete-button :delete-url="`/admin/menu/groups/${itemAttributes.id}`"
                           @item-deleted="removeGroup"
                           v-if="itemAttributes.can_delete"
            ></delete-button>
            <p v-if="!itemAttributes.can_delete">Can't delete a non empty category</p>
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
            },

            removeGroup() {
                this.$emit('menu-group-deleted');
            }
        }
    }
</script>