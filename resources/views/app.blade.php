<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Katzenschutzbundmanager</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="container-fluid" id="app">
            <transition name="component-fade" mode="out-in">
                <navigation @login="toggle" v-if="isAuthenticated"></navigation>
            </transition>

            <transition name="component-fade" mode="out-in">
                <div class="alert alert-success" role="alert" v-if="message.length > 0">
                    @{{ message }}
                    
                    <button type="button" class="close" aria-label="Close" @click="disposeMessage">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </transition>

            <template v-if="isAuthenticated">
                <transition name="component-fade" mode="out-in">
                    <router-view ></router-view>
                </transition>
            </template>
            <template v-else>
                <transition name="component-fade" mode="out-in">
                    <login @login="toggle"></login>
                </transition>
            </template>
        </div>

        <style>
            .component-fade-enter-active, .component-fade-leave-active {
                transition: opacity .3s ease;
            }
            .component-fade-enter, .component-fade-leave-to {
                opacity: 0;
            }
        </style>

        <script>
            window.InitialAuthenticated = {{ Auth::check() ? 'true' : 'false' }}
        </script>
        <script src="/js/app.js"></script>
    </body>
</html>
