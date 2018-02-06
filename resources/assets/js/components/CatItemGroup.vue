<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="heading">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" :href="href" aria-expanded="true" :aria-controls="id">
                    {{ title }}
                </a>
            </h4>
        </div>
        <div :id="id" class="panel-collapse collapse" :class="isOpened" role="tabpanel" :aria-labelledby="heading">
            <div class="panel-body">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'title',
            'id',
            'opened'
        ],

        created() {
            this.href = '#' + this.id;
            this.heading = 'heading-' + this.id;
        },

        computed: {
            isOpened() {
                return this.opened === 'true' ? 'in' : '';
            }
        }
    }
</script>