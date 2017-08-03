<style></style>

<template>
    <div class="menu-page-component">
        <header>
            <a :href="`/admin/menu/pages/${itemAttributes.id}`">
                <h3>{{ name }}</h3>
                <p>{{ zh_name }}</p>
            </a>
            <menu-page-form :url="`/admin/menu/pages/${itemAttributes.id}`"
                           form-type="update"
                           button-text="edit"
                           :formAttributes="itemAttributes"
                           @menu-page-updated="updateItem"
            ></menu-page-form>
        </header>
        <div>
            <icon-switch switch-field="publish"
                         :initial="itemAttributes.published"
                         :url="`/admin/menu/pages/${itemAttributes.id}/publish`"
                         :unique="`pub-${itemAttributes.id}`"
                         component-class="slide-switch"
            >
                <span slot="label">Publish</span>
                <div slot="icon">
                    <div class="switch-rail"></div>
                    <div class="switch-knob"></div>
                </div>
            </icon-switch>
            <delete-button :delete-url="`/admin/menu/pages/${itemAttributes.id}`"
                           @item-deleted="removeItem"
            ></delete-button>
        </div>
    </div>
</template>

<script type="text/babel">
    import setsData from "./mixins/SetsDataFromObject";

    export default {

        props: ['item-attributes'],

        mixins: [setsData],

        data() {
            return {
                name: '',
                zh_name: ''
            };
        },

        mounted() {
          this.setDataFrom(this.itemAttributes);
        },

        methods: {

            updateItem(updated_data) {
                this.name = updated_data.name;
                this.zh_name = updated_data.zh_name;
            },

            removeItem() {
                this.$emit('menu-page-deleted')
            }
        }
    }
</script>