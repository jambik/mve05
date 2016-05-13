<template>
    <p>This is my first component: {{ msg }}</p>
    <h1>Header</h1>
</template>

<style>
    h1 { color: #00A000; }
</style>

<script>
    export default {
        data() {
            return {
                msg: 'hello vue'
            }
        }
    }
</script>