<template>
    <canvas id="myChart"></canvas>
</template>
<script>
import Chart from 'chart.js/auto'
import axios from "axios";

export default {
    props: {
        arrayValue: {
            type:Object,
            required:true,
        },
    },

    name: 'MyChart',
    methods: {
        updateChart(myChart){
            Chart.getChart('myChart').update()

        }
    },

    mounted() {
        const ctx = document.getElementById('myChart')
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    data: this.arrayValue,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
}
</script>

<style scoped>

</style>
