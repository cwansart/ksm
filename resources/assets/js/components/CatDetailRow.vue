<template>
    <div class="row">
        <div class="col-sm-3"><strong>{{ label }}</strong></div>
        <div class="col-sm-9">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'label'
        ]
    }
</script>