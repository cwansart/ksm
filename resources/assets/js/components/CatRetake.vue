<template>
    <div class="row">
        <transition name="component-fade" mode="out-in">
            <div class="col-md-8 col-md-offset-2" v-if="loadingError">
                <div class="panel panel-default">
                    <div class="panel-body bg-danger">
                        {{ loadingError }}
                    </div>
                </div>
            </div>
        </transition>

        <transition name="component-fade" mode="out-in">
            <div class="col-md-8 col-md-offset-2" v-if="!loading">
                <div class="panel-group" v-if="isDeadOrMediated">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            <template v-if="status === 'deceased'">Verstorbenes Tier wieder aufnehmen</template>
                            <template v-if="status === 'mediated'">Vermitteltes Tier wieder aufnehmen</template>
                        </div>

                        <div class="panel-body">
                            <p v-if="status === 'deceased'">Wurde ein Tier versehentlich auf <em>verstorben</em> gestellt? Dann kann dieser
                                Fehler hier rückgängig gemacht werden.<br>
                                Diese Möglichkeit jedoch mit Vorsicht genießen und nur im Falle eines Fehlers durchführen.</p>
                            <p v-if="status === 'mediated'">Soll das ausgewählte Tier wieder in die Pflege des Katzenschutzbundes genommen werden?</p>

                            <form @submit.prevent="retake">
                                <button type="submit" class="btn btn-primary pull-right" :disabled="inProgress">Katze wieder aufnehmen</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="panel-group" v-if="!isDeadOrMediated">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab">
                            Tier kann nicht wieder aufgenommen werden
                        </div>

                        <div class="panel-body">
                            Die gewünschte Katze kann nicht wieder in das System aufgenommen werden, da es weder <em>tod</em> noch <em>vermittelt</em> ist.
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inProgress: false,
                loading: true,
                loadingError: null,
                status: null
            }
        },

        created() {
            let id = parseInt(this.$route.params.id);
            axios.get('/cats/' + id)
                .then(response => {
                    this.status = response.data.status;
                    this.loading = false;
                })
                .catch(error => {
                    this.loadingError = 'Beim Laden der Daten ist ein Fehler aufgetreten. Die gewünschte Katze ist nicht in der Datenbank vorhanden.';
                    console.error('Error while loading data:', error);
                })
        },

        methods: {
            retake() {
                this.inProgress = true;
                const vm = this;
                const data = {
                    cat_id: parseInt(this.$route.params.id)
                };

                axios.post('/cats/reset_status', data)
                    .then(response => {
                        console.log('onMessage: ', response.data);
                        vm.$router.app.$emit('onMessage', response.data.message);
                        this.$router.push({ path: '/cats', query: { highlight: response.data.cat_id }});
                    })
                    .catch(error => {
                        this.error = error.response.data;
                        vm.inProgress = false;
                    });
            },

            isDeadOrMediated() {
                return this.status === 'deceased' || this.status === 'mediated';
            }
        }
    }
</script>