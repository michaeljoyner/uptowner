export default class Form {

    constructor(defaults) {
        this.defaults = defaults;
        this.data = Object.assign({}, defaults);
        this.errors = this.makeErrorObject(defaults);
    }

    setValidationErrors(errors) {
        Object.keys(errors).forEach(field => {
            if(this.errors.hasOwnProperty(field)) {
                this.errors[field] = errors[field][0];
            }
        });
    }

    clearErrors() {
        Object.keys(this.errors).forEach(field => this.errors[field] = '');
    }

    clearForm(form_attributes = {}) {
        const defaults = Object.assign({}, this.defaults);
        this.data = Object.assign(defaults, form_attributes);
    }

    makeErrorObject(attributes) {
        return Object.keys(attributes).reduce((obj, attribute) => {
            obj[attribute] = '';
            return obj;
        }, {});
    }
}