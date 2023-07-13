<template>
    <CChart type="line" :data="data" :options="options" style="height: 300px;" />
</template>
  
<script>
import { CChart } from '@coreui/vue-chartjs'
// import { getStyle, hexToRgba } from '@coreui/utils/src'

export default {
    created() {
        this.setup()
        console.log(this.chart);
    },
    data: function () {
        return {
            data: '',
            options: ''
        }
    },
    props: ['chart'],
    name: 'chart',
    components: {
        CChart
    },
    setup() { },
    methods: {
        setup() {
            this.data = {
                labels: [
                    'T1',
                    'T2',
                    'T3',
                    'T4',
                    'T5',
                    'T6',
                    'T7',
                    'T8',
                    'T9',
                    'T10',
                    'T11 ',
                    'T12'
                ],
                datasets: [
                    {
                        label: 'Số người ứng tuyển: ',
                        backgroundColor: '#EBF3FE',
                        borderColor: 'rgb(73, 190, 255)',
                        pointHoverBackgroundColor: 'red',
                        borderWidth: 2,
                        data: [
                            this.chart.countCvMoth1,
                            this.chart.countCvMoth2,
                            this.chart.countCvMoth3,
                            this.chart.countCvMoth4,
                            this.chart.countCvMoth5,
                            this.chart.countCvMoth6,
                            this.chart.countCvMoth7,
                            this.chart.countCvMoth8,
                            this.chart.countCvMoth9,
                            this.chart.countCvMoth10,
                            this.chart.countCvMoth11,
                            this.chart.countCvMoth12
                        ],
                        fill: true
                    }
                ]
            }

            this.options = {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            stepSize: Math.ceil(250 / 5),
                            max: 250
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0.4
                    },
                    point: {
                        radius: 0,
                        hitRadius: 10,
                        hoverRadius: 4,
                        hoverBorderWidth: 3
                    }
                }
            }

            // return {
            //   data,
            //   options
            // }
        }
    }
}
</script>
  