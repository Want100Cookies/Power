<style scoped>

</style>

<template>
    <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-sun-o"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Current / Day yield</span>
            <span class="info-box-number">{{ currentYield }} Watt / {{ dayYield }} kWh</span>
            <small>Last update: <i>{{ lastUpdate }}</i></small>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentYield: 0,
                dayYield: 0,
                lastUpdate: 'never',
            }
        },

        ready() {
            this.prepareComponent();
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                axios.get('/api/v1/pv/current')
                    .then(response => {
                        this.currentYield = response.data.pac1;
                        this.dayYield = response.data.total_day;
                        this.lastUpdate = response.data.created_at;
                    });
            }
        }
    }
</script>