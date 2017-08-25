<style></style>

<template>
    <div class="featured-item-component menu-item-small-component">
        <div class="image-box">
            <img :src="itemAttributes.image" alt="" draggable="false">
        </div>
        <div class="text-box">
            <p>{{ itemAttributes.name }}</p>
            <p>{{ itemAttributes.zh_name }}</p>
            <p class="price">{{ itemAttributes.price }}</p>
            <a href="#" @click.prevent.stop="removeItem" class="remove-link">Remove</a>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['itemAttributes'],

        methods: {
            removeItem() {
                this.$emit('remove-featured-item', this.itemAttributes.id);
            }
        }
    }
</script>