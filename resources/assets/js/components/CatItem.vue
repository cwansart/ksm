<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="media-list">
                <li class="media">
                    <button type="button" @click="toggle" class="close" aria-label="Show" data-toggle="tooltip" data-placement="bottom" title="alle Daten anzeigen">
                        <span :class="{ 'rotate': open }" class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                    </button>

                    <div class="media-left">
                        <a href="#">
                            <img class="media-object cat-pic" :src="cat.photo_path">
                        </a>
                    </div>

                    <div class="media-body">
                        <h4 class="media-heading">{{ cat.key }} {{ cat.name }}</h4>
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
            'cat'
        ],

        data: function () {
            return {
                open: false
            }
        },

        methods: {
            toggle() {
                this.open = !this.open
            }
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

    .rotate {
        transition: all 500ms;
        transform: rotate(0deg);
        animation: up-side-down 500ms forwards ease-in-out;
    }

    @keyframes up-side-down {
        100% { transform: rotate(180deg); }
    }
</style>

