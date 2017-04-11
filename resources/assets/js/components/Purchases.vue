<template>
    <div>
        <h1>Purchases</h1>
        <div>
            <template v-if="!purchases.length">
                asdasd
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                purchases: []
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            fetch() {

            }
        }
    }
</script>
