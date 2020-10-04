<template>
    <div class="container">
        <button v-on:click="count++">Счётчик кликов — {{ count }}</button>
    </div>
</template>

<script>
    export default {
        name: "button-counter",
        data: function () {
            return {
                count: 0
            }
        },
    }
</script>

<style scoped>

</style>
