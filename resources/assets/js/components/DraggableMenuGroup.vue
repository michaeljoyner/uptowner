<style></style>

<template>
    <div class="draggable-menu-group-component" :class="{'available': ! assigned}" :draggable="! assigned" @dragstart="startDrag($event)">
        <header>
            <p class="lead">{{ name }}</p>
        </header>
        <div class="body">
            <p v-if="assigned">Currently assigned to <a :href="`/admin/menu/pages/${pageId}`">{{ pageName }}</a></p>
            <p v-if="!assigned">Does not currently belong to any page</p>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['name', 'id', 'assigned', 'page-name', 'page-id'],

        methods: {

            startDrag(event) {
                event.dataTransfer.setData('text/plain', this.id);
                event.dataTransfer.setData('it_is_a_menu_group', 'true');
            }
        }
    }
</script>