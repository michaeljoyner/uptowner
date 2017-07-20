<style></style>

<template>
    <div class="assigned-menu-group-component">
        <p>{{ name }}</p>
        <div class="close-btn" @click="removeItem">&times;</div>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['name', 'id'],

        methods: {

            removeItem() {
                this.$emit('remove-assigned-group', {id: this.id});
            }
        }
    }
</script>