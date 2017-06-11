<style></style>

<template>
    <div class="user-app-component">
        <div class="user-card" v-for="user in users">
            <span class="user-card-name">
                <span class="initial">{{ user.name[0] }}</span>
                {{ user.name }}
            </span>
            <span class="user-card-status">{{ user.superadmin ? 'Superadmin' : 'Regular' }}</span>
            <span>
                <delete-button :delete-url="`/admin/users/${user.id}`"
                               v-on:item-deleted="removeUser(user)"></delete-button>
            </span>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                users: []
            };
        },

        mounted() {
            this.fetchUsers();
            eventHub.$on('user-added', () => this.fetchUsers());
        },

        methods: {

            fetchUsers() {
                axios.get('/admin/services/users')
                        .then(({data}) => this.users = data)
                        .catch(err => console.log(err.response));
            },

            removeUser(user) {
                this.users.splice(this.users.indexOf(user), 1);
            }
        }
    }
</script>