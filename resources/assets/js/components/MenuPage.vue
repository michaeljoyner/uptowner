<style></style>

<template>
    <div class="menu-page-component">
        <header>
            <h3>{{ name }}</h3>
            <p>{{ zh_name }}</p>
            <menu-page-form :url="`/admin/menu/pages/${itemAttributes.id}`"
                           form-type="update"
                           button-text="edit"
                           :formAttributes="itemAttributes"
                           @menu-page-updated="updateItem"
            ></menu-page-form>
        </header>
        <div>

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
            }
        }
    }
</script>