<template>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <router-link class="navbar-brand" to="/cats">KSM</router-link>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <router-link active-class="active" tag="li" to="/cats" exact><a>Katzen</a></router-link>
                    <router-link active-class="active" tag="li" to="/cats/present" exact><a>Anwesend</a></router-link>
                    <router-link active-class="active" tag="li" to="/cats/deceased" exact><a>Verstorben</a></router-link>
                    <router-link active-class="active" tag="li" to="/cats/mediated" exact><a>Vermittelt</a></router-link>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout" @click.prevent="logout">Abmelden</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>

<script>
    export default {
        methods: {
            logout() {
                let vm = this
                axios.get('/logout')
                .then(response => {
                    vm.$emit('login')
                })
                .catch(error => {
                    console.error('An error occured during logout.', error)
                })
            }
        }
    }
</script>

<style>
    .pagination {
        margin: 0;
    }
</style>