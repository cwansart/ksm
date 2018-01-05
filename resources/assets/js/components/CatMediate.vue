<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form @submit.prevent="mediate">
                <div class="panel-group" id="accordion" role="tablist">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            Vermittelung
                        </div>

                        <div class="panel-body">
                            <div class="form-group" :class="{ 'has-error': ('tattoo_right' in error.errors) }">
                                <label for="firstName">Vorname</label>
                                <input type="text" v-model="firstname" id="firstName" placeholder="Vorname des neuen Besitzers" class="form-control" :disabled="inProgress">
                                <p class="text-danger" role="alert" v-if="('firstname' in error.errors)" v-text="error.errors.firstname[0]"></p>
                            </div>

                            <div class="form-group" :class="{ 'has-error': ('tattoo_right' in error.errors) }">
                                <label for="lastName">Nachname</label>
                                <input type="text" v-model="lastname" id="lastName" placeholder="Nachname des neuen Besitzers" class="form-control" :disabled="inProgress">
                                <p class="text-danger" role="alert" v-if="('lastname' in error.errors)" v-text="error.errors.lastname[0]"></p>
                            </div>

                            <div class="form-group">
                                <label for="location">Adresse</label>
                                <textarea class="form-control" rows="3" id="location" v-model="location" :disabled="inProgress"></textarea>
                            </div>


                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right" :disabled="inProgress">Vermittelung abschließen</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inProgress: false,
                firstname: '',
                lastname: '',
                location: '',
                error: { errors: {}, message: undefined },
            }
        },

        methods: {
            mediate() {
                this.inProgress = true;
                const vm = this;
                const data = {
                    cat_id: parseInt(this.$route.params.id),
                    firstname: this.firstname,
                    lastname: this.lastname,
                    location: this.location
                };

                axios.post('/mediations', data)
                    .then(response => {
                        console.log('onMessage: ', response.data);
                        vm.$router.app.$emit('onMessage', response.data.message);
                        this.$router.push({ path: '/cats/mediated', query: { highlight: response.data.cat_id }});
                    })
                    .catch(error => {
                        this.error = error.response.data;

                        let firstError = Object.keys(this.error.errors)[0];
                        $("html, body").animate({ scrollTop: $('[name=' + firstError).offset().top }, 500);

                        vm.inProgress = false;
                    });
            }
        }
    }
</script>