<style></style>

<template>
    <div class="menu-page-groups-app-component">
        <div class="group-selection-box">
            <p>Drag an available menu group below into the box to assign it to this category.</p>
            <draggable-menu-group v-for="group in availableGroups"
                                  :key="group.id"
                                  :assigned="group.is_assigned"
                                  :name="group.name"
                                  :id="group.id"
                                  :page-name="group.page_name"
                                  :page-id="group.page_id"
            ></draggable-menu-group>
        </div>
        <div class="group-dropzone-box">
            <p class="lead">This category's groups are:</p>
            <div class="group-dropzone"
                 @dragover="dragOverBox($event)"
                 @dragenter="dragEnterBox($event)"
                 @drop="itemDropped($event)"
            >
                <assigned-menu-group v-for="assigned in page_groups"
                                     :key="assigned.id"
                                     :id="assigned.id"
                                     :name="assigned.name"
                                     @remove-assigned-group="unassignGroup"
                ></assigned-menu-group>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['page-id'],

        data() {
            return {
                all_groups: [],
                page_groups: []
            };
        },

        computed: {
          availableGroups() {
              return this.all_groups.filter(group => group.page_id !== parseInt(this.pageId));
          }
        },

        mounted() {
            this.fetchAllGroups();
            this.fetchPageGroups();
        },

        methods: {

            fetchAllGroups() {
                axios.get('/admin/services/menu/groups')
                    .then(({data}) => this.all_groups = data)
                    .catch(err => console.log(err));
            },

            fetchPageGroups() {
                axios.get(`/admin/services/menu/pages/${this.pageId}/groups`)
                    .then(({data}) => this.page_groups = data)
                    .catch(err => console.log(err));
            },

            dragEnterBox(event) {
                if([...event.dataTransfer.types].includes('it_is_a_menu_group')) {
                    event.stopPropagation();
                    event.preventDefault();
                }
            },

            dragOverBox(event) {
                if([...event.dataTransfer.types].includes('it_is_a_menu_group')) {
                    event.stopPropagation();
                    event.preventDefault();
                }
            },

            itemDropped(event) {
                const item_id = parseInt(event.dataTransfer.getData('text/plain'));
                this.assignGroupToPage(item_id);
            },

            assignGroupToPage(group_id) {
                const draggedGroup = this.all_groups.find(group => group.id === group_id);
                this.page_groups.push(draggedGroup);
                this.removeGroupFromPool(draggedGroup);
                this.syncGroupToPage(draggedGroup);
            },

            removeGroupFromPool(group) {
                this.all_groups.splice(this.all_groups.indexOf(group), 1);
            },

            syncGroupToPage(group) {
                axios.post(`/admin/menu/pages/${this.pageId}/groups`, {group_id: group.id})
                    .then(() => this.fetchPageGroups())
                    .catch(err => console.log(err));
            },

            unassignGroup({id}) {
                axios.delete(`/admin/menu/pages/${this.pageId}/groups/${id}`)
                    .then(() => this.removeAssignedGroup(id))
                    .catch(err => console.log(err));
            },

            removeAssignedGroup(id) {
                let group = this.page_groups.find(group => group.id === id);
                group.page_id = null;
                group.page_name = null;
                group.assigned = false;

                this.page_groups.splice(this.page_groups.indexOf(group), 1);
                this.all_groups.push(group);
                this.fetchAllGroups();
                this.fetchPageGroups();
            }
        }
    }
</script>