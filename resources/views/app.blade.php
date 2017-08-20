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
            <template v-if="isAuthenticated">
                <navigation @login="toggle"></navigation>
                <transition name="component-fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </template>
            <template v-else>
                <login @login="toggle"></login>
            </template>
        </div>

        <style>
.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
        </style>

        <script>
            window.InitialAuthenticated = {{ Auth::check() ? 'true' : 'false' }}
        </script>
        <script src="/js/app.js"></script>
    </body>
</html>
