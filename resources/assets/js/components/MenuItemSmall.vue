<style></style>

<template>
    <div class="menu-item-small-component" draggable="true" @dragstart="startDrag($event)">
        <div class="image-box">
            <img :src="itemAttributes.image" alt="" draggable="false">
        </div>
        <div class="text-box">
            <p>{{ itemAttributes.name }}</p>
            <p>{{ itemAttributes.zh_name }}</p>
            <p class="price">NT${{ itemAttributes.price }}</p>
            <p class="add-btn" @click="addToList">Add to Featured</p>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['itemAttributes'],

        methods: {
            startDrag(event) {
                event.dataTransfer.setData('text/plain', this.itemAttributes.id);
                event.dataTransfer.setData('it_is_a_menu_item', 'true');
            },

            addToList() {
                this.$emit('add-featured', this.itemAttributes.id);
            }
        }
    }
</script>