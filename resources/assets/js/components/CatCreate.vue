<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form @submit.prevent="store">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Basisdaten
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" v-model="name" class="form-control" name="name" placeholder="Name" :disabled="inProgress" required>
                        </div>

                        <div class="form-group">
                            <input type="text" v-model="breed" class="form-control" placeholder="Rasse" :disabled="inProgress" required>
                        </div>

                        <div class="form-group">
                            <input type="text" v-model="color" class="form-control" placeholder="Farbe" :disabled="inProgress" required>
                        </div>

                        <div class="form-group">
                            <input type="date" v-model="date_of_birth" class="form-control" placeholder="Geburtstdatum" :disabled="inProgress" required>
                        </div>

                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="is_male" value="1" checked>
                                männlich
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_male" value="0" checked>
                                weiblich
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" :disabled="inProgress">speichern</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                error: '',
                inProgress: false,

                name: '',
                breed: '',
                color: '',
                date_of_birth: '',
                is_male: 1,
            }
        },

        methods: {
            store() {
                console.log('STORE CALLED')
            }
        }
    }
</script>
