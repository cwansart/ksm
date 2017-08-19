export default class Error {
    constructor() {
        this.errors = {}
    }

    set(field, error) {
        console.log('setting error, ', field, error)
        this.errors[field] = error
    }

    reset() {
        this.errors = {}
    }

    any() {
        return Object.keys(this.errors).length > 0
    }

    has(field) {
        console.log('has field, ', field)
        return this.errors.hasOwnProperty(field)
    }

    get(field) {
        return this.errors[field]
    }
}
