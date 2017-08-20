<template>
    <div class="container-fluid">
        <div class="row">
            <div class="alert alert-danger" role="alert" v-if="error.length > 0" v-text="error"></div>
            
            <form @submit.prevent="login">
                <div class="form-group">
                    <input type="text" v-model="name" class="form-control" id="name" name="name" placeholder="Benutzername" :disabled="inProgress" required>
                </div>

                <div class="form-group">
                    <input type="password" v-model="password" class="form-control" id="password" placeholder="Passwort" :disabled="inProgress" required>
                </div>

                <button type="submit" class="btn btn-primary" :disabled="!isFormReady || inProgress">Anmelden</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inProgress: false,
                name: '',
                password: '',
                error: ''
            }
        },

        methods: {
            login() {
                this.inProgress = true

                let vm = this
                axios.post('/login', {
                    name: this.name,
                    password: this.password
                })
                .then(response => {
                    if (response.data.is_authenticated) {
                        vm.$emit('login')
                    } else {
                        vm.error = 'Anmeldung fehlgeschlagen aufgrund von Serverproblemen.'
                        console.error('Error: ', response)
                    }
                    setTimeout(() => {
                        vm.inProgress = false
                    }, 1000)
                })
                .catch(error => {
                    vm.error = error.response.data.name || ''
                    setTimeout(() => {
                        vm.inProgress = false
                    }, 1000)
                })
            }
        },

        computed: {
            isFormReady() {
                return this.name.length > 0 && this.password.length > 0
            }
        }
    }
</script>
