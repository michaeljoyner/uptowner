<style></style>

<template>
    <a :href="hashLink" @click.prevent="scrollTo" class="scrolling-link hover-blue">{{ linkText }}</a>
</template>

<script type="text/babel">
    import jump from "jump.js";

    export default {

        props: ['hash-link', 'link-text'],

        methods: {
            scrollTo() {
                jump(this.hashLink, {offset: -133});
            }
        }
    }
</script>