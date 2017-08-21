import Form from '../Form';

export default {

    props: {
        'form-attributes': {
            type: Object,
            required: false,
            default() {
                return {};
            }
        },
        url: {
            required: true,
            type: String
        },
        'form-type': {
            type: String,
            default: 'create'
        },
        'button-text': {
            type: String,
            required: true
        }
    },

    data() {
        return {
            modalOpen: false,
            waiting: false,
            mainError: ''
        };
    },

    methods: {

        submit() {
            this.clearErrors();

            if (!this.canSubmit()) {
                return;
            }

            this.waiting = true;
            axios.post(this.url, this.form.data)
                .then(({data}) => this.onSuccess(data))
                .catch(({response}) => this.onFailure(response));
        },

        onSuccess(data) {
            const updated_data = this.getUpdatedDataFromResponseData(data);
            this.waiting = false;
            this.form.clearForm(this.formType === 'create' ? {} : updated_data);
            this.modalOpen = false;
            this.emitEvent(updated_data);
            this.$emit('successfully-submitted');
        },

        onFailure(res) {
            this.waiting = false;
            if (res.status === 422) {
                return this.form.setValidationErrors(res.data);
            }

            this.mainError = 'Unable to complete action. Please refresh and try again later.';
        },

        emitEvent(updated_data) {
            if (this.formType === 'create') {
                return eventHub.$emit(this.getStoreActionEventName(), updated_data);
            }

            this.$emit(this.getUpdateActionEventName(), updated_data);
        },

        clearErrors() {
            this.form.clearErrors();
            this.mainError = '';
        }
    }
}