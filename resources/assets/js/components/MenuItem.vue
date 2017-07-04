<style></style>

<template>
    <div class="menu-item-component">
        <div class="component-image-box single-image-uploader-box">
            <single-upload :default="itemAttributes.image"
                           :url="`/admin/menu/items/${itemAttributes.id}/image`"
                           size="preview"
                           :preview-width="200"
                           :preview-height="150"
                           :unique="itemAttributes.id"
            ></single-upload>
        </div>
        <div class="component-detail">
            <header>
                <div class="titles">
                    <h3 class="main-header">{{ name }}</h3>
                    <p class="sub-header">{{ zh_name }}</p>
                </div>
                <div class="rightside">
                    <p class="item-price">NT${{ price }}</p>
                    <menu-item-form :form-attributes="itemAttributes"
                                    :url="`/admin/menu/items/${itemAttributes.id}`"
                                    button-text="edit"
                                    form-type="update"
                                    @item-updated="updateItem"
                    ></menu-item-form>
                </div>


            </header>
            <div class="body">
                <p>{{ description }}</p>
                <p>{{ zh_description }}</p>
            </div>
            <div class="menu-items-actions">
                <div class="icon-switches">
                    <icon-switch :url="`/admin/menu/items/${itemAttributes.id}/recommended`"
                                 switch-field="is_recommended"
                                 :initial="itemAttributes.is_recommended"
                                 :unique="`recommended-${itemAttributes.id}`"
                                 component-class="svg-icon-switch compact"
                    >
                        <svg slot="icon" class="orange"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 7.04 7.04" width="25" height="25"
                        >
                            <rect class="colour-stroke" fill="#ffffff" stroke="#b4b8c2" stroke-linecap="round"
                                  stroke-linejoin="round"
                                  x="0.5" y="0.5" width="6.04" height="6.04" rx="0.85" ry="0.85"/>
                            <path class="colour-stroke colour-fill" stroke="#b4b8c2" fill="#b4b8c2" stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3.58,2.28l.28.85a.06.06,0,0,0,.06,0h.9a.06.06,0,0,1,0,.11l-.73.53a.06.06,0,0,0,0,.07l.28.85a.06.06,0,0,1-.09.07l-.73-.53a.06.06,0,0,0-.07,0l-.73.53a.06.06,0,0,1-.09-.07l.28-.85a.06.06,0,0,0,0-.07L2.2,3.28a.06.06,0,0,1,0-.11h.9a.06.06,0,0,0,.06,0l.28-.85A.06.06,0,0,1,3.58,2.28Z"/>
                        </svg>
                    </icon-switch>
                    <icon-switch :url="`/admin/menu/items/${itemAttributes.id}/vegetarian`"
                                 switch-field="is_vegetarian"
                                 :initial="itemAttributes.is_vegetarian"
                                 :unique="`vegetarian-${itemAttributes.id}`"
                                 component-class="svg-icon-switch compact"
                    >
                        <svg slot="icon" class="green"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 7.04 7.04" width="25" height="25"
                        >
                            <rect fill="none" stroke="#b4b8c2" stroke-linecap="round" stroke-linejoin="round"
                                  class="colour-stroke" x="0.5" y="0.5" width="6.04" height="6.04" rx="0.85" ry="0.85"/>
                            <path class="colour-stroke colour-fill" stroke="#b4b8c2" stroke-linecap="round"
                                  stroke-linejoin="round" fill="#b4b8c2" stroke-width="0.5px"
                                  d="M4.06,2.27H5.14v.45H4.91L3.86,4.77H3.18l-1-2.05H1.94V2.27H3v.45H2.75l.78,1.62.82-1.62H4.06Z"/>
                        </svg>
                    </icon-switch>
                    <icon-switch :url="`/admin/menu/items/${itemAttributes.id}/spicy`"
                                 switch-field="is_spicy"
                                 :initial="itemAttributes.is_spicy"
                                 :unique="`spicy-${itemAttributes.id}`"
                                 component-class="svg-icon-switch compact"
                    >
                        <svg slot="icon" class="red"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 7.04 7.04" width="25" height="25"
                        >
                            <rect stroke="#b4b8c2" stroke-linejoin="round" stroke-linecap="round" class="colour-stroke"
                                  fill="none" x="0.5" y="0.5" width="6.04" height="6.04" rx="0.85" ry="0.85"/>
                            <path class="colour-stroke colour-fill" stroke="#b4b8c2" stroke-linejoin="round"
                                  stroke-linecap="round" fill="#b4b8c2"
                                  d="M3.27,2.71a2.86,2.86,0,0,1,0,.5,2.08,2.08,0,0,1-1,1.87A2.69,2.69,0,0,0,4.68,2.71Z"/>
                            <path stroke="#b4b8c2" stroke-linejoin="round" stroke-linecap="round" class="colour-stroke"
                                  fill="none" d="M3.29,2.71"/>
                            <line stroke="#b4b8c2" stroke-linejoin="round" stroke-linecap="round" class="colour-stroke"
                                  fill="none" x1="3.98" y1="2.71" x2="3.98" y2="1.93"/>
                        </svg>
                    </icon-switch>
                </div>
                <icon-switch switch-field="published"
                             :initial="itemAttributes.published"
                             :url="`/admin/menu/items/${itemAttributes.id}/publish`"
                             :unique="`pub-${itemAttributes.id}`"
                             component-class="slide-switch"
                >
                    <span slot="label">Publish</span>
                    <div slot="icon">
                        <div class="switch-rail"></div>
                        <div class="switch-knob"></div>
                    </div>
                </icon-switch>
                <delete-button :delete-url="`/admin/menu/items/${itemAttributes.id}`"
                               @item-deleted="removeItem"
                ></delete-button>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import setsData from "./mixins/SetsDataFromObject";

    export default {

        props: ['item-attributes'],

        mixins: [setsData],

        data() {
            return {
                name: '',
                zh_name: '',
                description: '',
                zh_description: '',
                price: null,
            };
        },

        mounted() {
            this.setDataFrom(this.itemAttributes);
        },

        methods: {

            removeItem() {
                this.$emit('remove-menu-item', {item_id: this.itemAttributes.id});
            },

            updateItem(updated_data) {
                this.setDataFrom(updated_data);
            }
        }
    }
</script>