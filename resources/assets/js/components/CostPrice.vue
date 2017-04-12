<style scoped>

</style>

<template>

</template>

<script>
    export default {
        data() {
            return {
                prices: [],

                form: {
                    type: '',
                    price: ''
                }
            };
        },

        ready() {

        },

        mounted() {

        },

        methods: {
            prepareComponent() {
                this.getPrices();
            },

            getPrices() {
                axios.get('/api/v1/cost-price')
                    .then(response => {
                        this.prices = response.data;
                    })
            }
        }
    }
</script>