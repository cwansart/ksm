<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 toolbox">
                <router-link to="/cats/create" class="btn btn-success pull-right">Katze aufnehmen</router-link>
                <pagination :data="response" v-if="response != null"></pagination>
            </div>
        </div>

        <div class="row" v-if="error.length">
            <div class="alert alert-danger col-md-8 col-md-offset-2" role="alert" v-text="error"></div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2" v-if="!inProgress">
                <template v-if="cats.length > 0">
                    <transition-group name="component-fade" mode="out-in">
                        <cat-item v-for="cat in cats" :cat="cat" :key="cat.id"></cat-item>
                    </transition-group>
                    <pagination :data="response" v-if="response != null"></pagination>
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
    export default {
        data() {
            return {
                error: '',
                inProgress: true,
                cats: [],
                response: null,
            }
        },

        mounted() {
            const page = this.$route.query.page || 1
            this.loadData(page)
        },

        components: {
            'cat-item': require('./CatItem'),
            'pagination': require('./Pagination')
        },

        watch: {
            '$route.query': 'queryChanged'
        },

        methods: {
            loadData(page) {
                axios.get('/cats?filter=mediated&page=' + page)
                .then(response => {
                    this.cats = response.data.data
                    this.inProgress = false
                    this.response = response.data
                })
                .catch(error => {
                    console.error('An error occured while fecthing data. ', error)
                    this.error = error.message
                })
            },

            queryChanged(query) {
                if (query.page !== undefined) {
                    this.pageChanged(query.page)
                }
            },

            pageChanged(page) {
                this.loadData(page)
                $("html, body").animate({ scrollTop: 0 }, 500);
            }
        }
    }
</script>

<style>
    .toolbox {
        margin-bottom: 1em;
    }
</style>

