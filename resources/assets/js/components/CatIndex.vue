<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 toolbox">
                <router-link to="/cats/create" class="btn btn-success pull-right">Katze aufnehmen</router-link>
            </div>
        </div>

        <div class="row" v-if="error.length">
            <div class="alert alert-danger col-md-8 col-md-offset-2" role="alert" v-text="error"></div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2" v-if="!inProgress">
                <template v-if="cats.length > 0">
                    <cat-item v-for="cat in cats" :cat="cat" :key="cat.id"></cat-item>
                </template>
                <template v-else>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Bisher wurden noch keine Katzen ins System aufgenommen.
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import CatItem from './CatItem'

    export default {
        data() {
            return {
                error: '',
                inProgress: true,
                cats: []
            }
        },

        mounted() {
            axios.get('/cats')
            .then(response => {
                this.cats = response.data.data
                this.inProgress = false
                console.log('RESPONSE', response.data)
            })
            .catch(error => {
                console.error('An error occured while fecthing data. ', error)
                this.error = error.message
            })
        },

        components: {
            'cat-item': CatItem
        }
    }
</script>

<style>
    .toolbox {
        margin-bottom: 1em;
    }
</style>

