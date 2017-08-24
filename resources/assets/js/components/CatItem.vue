<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="media-list">
                <li class="media">
                    <button type="button" class="close" aria-label="Show" data-toggle="tooltip" data-placement="bottom" title="alle Daten anzeigen">
                        <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                    </button>

                    <div class="media-left">
                        <a href="#">
                            <img class="media-object cat-pic" :src="cat.photo_path">
                        </a>
                    </div>

                    <div class="media-body">
                        <h4 class="media-heading">{{ cat.name }}</h4>
                        <small><i>Eingetragen am: {{ cat.created_at }}</i></small><br>
                        {{ cat.color }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'cat',
        ],

        data() {
            return {}
        },

        mounted() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    }
</script>

<style>
    .cat-pic {
        max-width: 64px;
        max-height: 64px;
    }
</style>

