<style></style>

<template>
    <div class="specials-app-component">
        <special-item v-for="special in specials" :key="special.id"
                      @special-deleted="removeSpecial"
                      :special-attributes="special">
        </special-item>
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                specials: []
            };
        },

        mounted() {
            this.fetchSpecials();
            eventHub.$on('special-added', () => this.fetchSpecials());
        },

        methods: {
            fetchSpecials() {
                axios.get('/admin/services/specials')
                    .then(({data}) => this.specials = data)
                    .catch(err => console.log(err));
            },

            removeSpecial({id}) {
                this.specials.splice(this.specials.indexOf(this.specials.find(s => s.id === id)), 1);
            }
        }
    }
</script>