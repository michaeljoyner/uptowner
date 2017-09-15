<style></style>

<template>
    <div class="instagram-feed-component w-con grid col-5">
        <div v-for="post in posts" class="no-space flex flex-center">
            <img class="max-w-100 min-h100" :src="post.src_low" alt="Instagram post">
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                posts: []
            };
        },

        mounted() {
            this.fetchPosts();
        },

        methods: {
            fetchPosts() {
                axios.get('/service/instagram/feed')
                    .then(({data}) => this.posts = data)
                    .catch(err => console.log(err));
            }
        }
    }
</script>