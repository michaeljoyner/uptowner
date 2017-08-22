<style></style>

<template>
    <div class="special-component">
        <div class="special-header">
            <h3>{{ title }}</h3>
            <p>{{ zh_title }}</p>
        </div>
        <div class="special-body">
            <div class="special-image-box single-image-uploader-box">
                <single-upload :default="specialAttributes.image"
                               :url="`/admin/specials/${specialAttributes.id}/image`"
                               size="preview"
                               :preview-width="400"
                               :preview-height="200"
                               :unique="specialAttributes.id"
                ></single-upload>
            </div>
            <div class="special-text-details">
                <div class="special-dates">
                    <p><strong>From: </strong>{{ formatted_start_date }}</p>
                    <p><strong>To: </strong>{{ formatted_end_date }}</p>
                </div>
                <p>{{ description }}</p>
                <p>{{ zh_description }}</p>
            </div>
        </div>
        <div class="special-actions">
            <icon-switch switch-field="publish"
                         :initial="specialAttributes.published"
                         :url="`/admin/specials/${specialAttributes.id}/publish`"
                         :unique="`pub-${specialAttributes.id}`"
                         component-class="slide-switch"
            >
                <span slot="label">Publish</span>
                <div slot="icon">
                    <div class="switch-rail"></div>
                    <div class="switch-knob"></div>
                </div>
            </icon-switch>
            <special-form :url="`/admin/specials/${specialAttributes.id}`"
                          form-type="update"
                          :form-attributes="specialAttributes"
                          @special-updated="updateSpecial"
            ></special-form>
            <delete-button :delete-url="`/admin/specials/${specialAttributes.id}`"
                           @item-deleted="removeSpecial"
            ></delete-button>
        </div>
    </div>
</template>

<script type="text/babel">
    import setsData from './mixins/SetsDataFromObject';
    import moment from 'moment';

    export default {

        props: [
            'special-attributes'
        ],

        mixins: [setsData],

        data() {
            return {
                title: '',
                zh_title: '',
                description: '',
                zh_description: '',
                price: '',
                image: '',
                start_date: null,
                end_date: null
            };
        },

        computed: {
            formatted_start_date() {
                if(! this.start_date) {
                    return 'Date not set';
                }
                return moment(this.start_date).format('MMMM, Do, YYYY');
            },

            formatted_end_date() {
                if(! this.end_date) {
                    return 'Date not set';
                }
                return moment(this.end_date).format('MMMM, Do, YYYY');
            }
        },

        mounted() {
            this.setDataFrom(this.specialAttributes);
        },

        methods: {

            updateSpecial(updated_data) {
                this.setDataFrom(updated_data);
            },

            removeSpecial() {
                this.$emit('special-deleted', {id: this.specialAttributes.id});
            }
        }
    }
</script>