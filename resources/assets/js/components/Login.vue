<template>
    <div id="login-form-wrapper">
        <div class="jumbotron">
            <h1>Herzlich Willkommen</h1>
            <p>Die Verwaltungssoftware kann nur von angemeldeten Benutzern verwendet werden.</p>
            <p>Bitte melden Sie sich an.</p>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Anmeldung</h3>
            </div>
            <div class="panel-body">

                <login-form v-on="$listeners"></login-form>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginForm from './LoginForm'

    export default {
        components: {
            LoginForm
        }
    }
</script>

<style>
    #login-form-wrapper {
        margin-top: 1em;
    }
</style>

