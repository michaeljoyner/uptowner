export default {

    methods: {
        setDataFrom(obj) {
            Object.keys(obj).forEach(field => {
                if(this.$data.hasOwnProperty(field)) {
                    this[field] = obj[field];
                }
            });
        }
    }
}