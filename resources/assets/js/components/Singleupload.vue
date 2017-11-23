<style>

</style>

<template>
    <div>
        <label :for="`profile-upload-${unique}`" class="single-upload-label">
            <img :src="imageSrc" alt="" class="profile-image"
                 v-bind:style="{width: prevWidth, height: prevHeight}"
                 v-bind:class="{'processing' : uploading, 'large': size === 'large', 'round': shape === 'round', 'full': size === 'full' }"/>
            <input v-on:change="processFile" type="file" :id="`profile-upload-${unique}`"/>
        </label>
        <div class="upload-progress-container" v-show="uploading">
        <span class="upload-progress-bar"
              v-bind:style="{width: uploadPercentage + '%'}"></span>
        </div>
        <div v-show="removeUrl" @click="clearImage" class="text-center">Clear Image</div>
        <p class="upload-message"
           v-bind:class="{'error': uploadStatus === 'error', 'success': uploadStatus === 'success'}"
           v-show="uploadMsg !== ''">{{ uploadMsg }}
        </p>
    </div>

</template>

<script type="text/babel">
    import { generatePreview } from './PreviewGenerator.js';
    export default {
        props: {
            default: null,
            url: String,
            shape: { type: String, default: 'square'},
            size: { type: String, default: 'large'},
            previewWidth: {type: Number, default: 300},
            previewHeight: {type: Number, default: 300},
            unique: {type: Number, default: 1},
            'delete-url': {type: String, default: null}
        },
        data() {
            return {
                imageSource: '',
                uploadMsg: '',
                uploading: false,
                uploadStatus: '',
                uploadPercentage: 0,
                removeImageUrl: null,
                hasRemoved: false
            }
        },
        computed: {
            imageSrc() {
                return this.imageSource ? this.imageSource : this.default;
            },
            removeUrl() {
                if(! this.hasRemoved) {
                    return this.removeImageUrl ? this.removeImageUrl : this.deleteUrl;
                }
            },
            prevWidth() {
                if(this.size === 'preview') {
                    return this.previewWidth + 'px';
                }
                if(this.size === 'large') {
                    return '300px';
                }
                return '200px';
            },
            prevHeight() {
                if(this.size === 'preview') {
                    return 'auto';
                }
                if(this.size === 'large') {
                    return '300px';
                }
                return '200px';
            }
        },
        methods: {
            processFile(ev) {
                var file = ev.target.files[0];
                this.clearMessage();
                if (file.type.indexOf('image') === -1) {
                    this.showInvalidFile(file.name);
                    return;
                }
                this.handleFile(file);
            },
            showInvalidFile(name) {
                this.uploadMsg = name + ' is not a valid image file';
                this.uploadStatus = 'error';
            },
            handleFile(file) {
                generatePreview(file, {pWidth: this.previewWidth, pHeight: this.previewHeight})
                        .then((src) => this.imageSource = src)
                        .catch((err) =>console.log(err));
                this.uploadFile(file);
            },
            uploadFile(file) {
                this.uploading = true;
                axios.post(this.url, this.prepareFormData(file), this.getUploadOptions())
                        .then(res => this.onUploadSuccess(res))
                        .catch(err => this.onUploadFailed(err));
            },
            prepareFormData: function (file) {
                let fd = new FormData();
                fd.append('image', file);
                return fd;
            },
            onUploadSuccess(res) {
                this.uploadMsg = "Uploaded successfully";
                this.uploadStatus = 'success'
                this.uploading = false;
                this.hasRemoved = false;
                eventHub.$emit('singleuploadcomplete', res.data);
                this.removeImageUrl = res.data.delete_url || null;
                window.setTimeout(() => this.clearMessage(), 2000);
            },
            onUploadFailed(err) {
                this.uploadMsg = 'The upload failed';
                this.uploadStatus = 'error';
                console.log(err);
            },
            getUploadOptions() {
                return {
                    onUploadProgress: (ev) => this.showProgress(parseInt(ev.loaded / ev.total * 100))
                }
            },
            showProgress(progress) {
                this.uploadPercentage = progress;
            },
            clearMessage() {
                this.uploadMsg = ''
            },
            clearImage() {
                axios.delete(this.removeUrl)
                    .then(() => this.onRemoveSuccess())
                    .catch(err => console.log(err));
            },
            onRemoveSuccess() {
                this.imageSource = '/images/defaults/default4x3.jpg';
                this.removeImageUrl = null;
                this.hasRemoved = true;
            }
        }
    }
</script>