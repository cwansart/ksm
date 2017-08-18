<template>
    <form @submit.prevent="login">
        <div class="form-group">
            <input type="text" v-model="email" class="form-control" id="email" name="email" placeholder="E-Mail-Adresse" :disabled="inProgress" required>
        </div>

        <div class="form-group">
            <input type="password" v-model="password" class="form-control" id="password" placeholder="Passwort" :disabled="inProgress" required>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="!isFormReady || inProgress">Anmelden</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                inProgress: false,
                email: '',
                password: '',
                errors: new Error
            }
        },

        methods: {
            login() {
                this.inProgress = true
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    console.log('LOGGED IN', response)
                    this.$emit('authenticated')
                })
                .catch(error => {
                    console.error('Something went wrong during the login process.', error)
                })
            }
        },

        computed: {
            isFormReady() {
                return this.email.length > 0 && this.password.length > 0
            }
        }
    }
</script>
