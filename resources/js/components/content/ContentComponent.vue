<template>
    <div class="container">
        <div v-if="alertSuccess" class="alert alert-success"> SUCCESS</div>
        <div v-if="alertError" class="alert alert-danger"> ERROR</div>
        <div class="first__block">
            <form-component
                @alert="viewAlerts"
                @updateChart="callChildUpdateFunc"
            />
            <table-component
                @updateChart="callChildUpdateFunc"
                ref="table"
            />
        </div>
        <div class="chart">
            <my-chart  v-if="loaded" :array-value="arrayValue"/>
        </div>

    </div>
</template>

<script>
import FormComponent from "./form/FormComponent";
import TableComponent from "./table/TableComponent";
import MyChart from "./chart/MyChart";
import Chart from "chart.js";


export default {
    name: "ContentComponent",
    components: {MyChart, TableComponent, FormComponent},
    data() {
        return {
            alertSuccess: false,
            alertError: false,
            arrayOfEntries: {},
            arrayDate: [],
            arrayValue: [],
            loaded: false,
            myChart:MyChart,
            successAddToDB: {
                type: Boolean,
                default: false,
            }
        }
    },
    methods: {
        viewAlerts(alert) {
            this[alert] = true
            setTimeout(() => {
                this[alert] = false
            }, 10000)
        },
        callChildUpdateFunc() {
            this.$refs.table.getEntries()
            this.getEntriesJson()
            this.myChart.methods.updateChart()
        },
        async getEntriesJson() {
                this.loaded = false
                await fetch('api/entries-for-chart', {
                    headers: {'Content-type': 'application/json'},
                    method: 'get'
                }).then(res => res.json()).then((response) => {
                    this.arrayOfEntries = response
                }).catch((error) => {
                    console.log('Looks like there was a problem: \n', error);
                });
                /*                this.arrayOfEntries = Object.entries(response.data)
                                this.arrayOfEntries.forEach((el) => {
                                    this.arrayDate.push(el[1])
                                    this.arrayValue.push(Number(el[0]))
                                })
                                this.arrayDate.sort()*/
                this.loaded = true
                this.dateValueToArray()
        },
        dateValueToArray() {
            this.arrayValue = []
            for(let key in this.arrayOfEntries){
                let numb = 0
                    this.arrayValue.push(
                        {
                            y: key,
                            x: this.arrayOfEntries[key],
                        })
                numb++
            }
            this.arrayValue.sort((a,b) => a.x > b.x ? 1 : -1)
        },
    },
    mounted() {
        this.getEntriesJson()
    }

}
</script>

<style scoped>
.container {
    margin-top: 40px;
}

.first__block {
    display: flex;
}

.chart {
    margin-top: 50px;
    max-width: 70%;

}
</style>
