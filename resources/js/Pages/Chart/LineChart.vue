<template>
    <div class="m-2">
        <PrimaryButton @click="fetchChartData">Reload</PrimaryButton>
    </div>
    <div>
        <LineChartGenerator
            v-if="dataReceived"
            :key="chartKey"
            :options="chartOptions"
            :data="chartData"
            :height="'400px'"
        />
    </div>
</template>

<script>
import { Line as LineChartGenerator } from 'vue-chartjs'

import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    TimeScale,
    CategoryScale,
    PointElement
} from 'chart.js'

import 'chartjs-adapter-moment';
import PrimaryButton from "@/Components/PrimaryButton.vue";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    TimeScale,
    CategoryScale,
    PointElement,
)

export default {
    name: 'LineChart',
    components: {
        PrimaryButton,
        LineChartGenerator
    },
    data() {
        return {
            chartKey: 0,
            dataReceived: false,
            chartData: {
                labels: [],
                datasets: [
                    {
                        label: 'BTCUSD',
                        borderColor: '#f87979',
                        data: [],
                        tension: 0.1,
                        pointStyle: false
                    }
                ]
            },
            chartOptions: {
                parsing: {
                    xAxisKey: 'timestamp',
                    yAxisKey: 'value'
                },
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'hour'
                        }
                    },
                    y: {
                        type: 'linear'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        }
    },
    methods: {
        fetchChartData() {
            axios.get(route('fetchData'))
                .then(response => {
                    this.chartData.datasets[0].data = response.data.chartData;
                    this.dataReceived = true;
                    this.chartKey++;
                })
                .catch(error => console.warn(error));

        },
    },
    mounted() {
        this.fetchChartData()
    }
}
</script>
