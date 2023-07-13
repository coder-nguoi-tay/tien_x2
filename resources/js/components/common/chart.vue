<template>
    <CChart type="line" :data="data" :options="options" style="height: 300px;" />
</template>
  
<script>
import { CChart } from '@coreui/vue-chartjs'
// import { getStyle, hexToRgba } from '@coreui/utils/src'

export default {
    created() {
        this.setup()
    },
    data: function () {
        return {
            data: '',
            options: ''
        }
    },
    props: ['NameDate'],
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
                            // this.NameDate.countCvMoth1,
                            // this.NameDate.countCvMoth2,
                            // this.NameDate.countCvMoth3,
                            // this.NameDate.countCvMoth4,
                            // this.NameDate.countCvMoth5,
                            // this.NameDate.countCvMoth6,
                            // this.NameDate.countCvMoth7,
                            // this.NameDate.countCvMoth8,
                            // this.NameDate.countCvMoth9,
                            // this.NameDate.countCvMoth10,
                            // this.NameDate.countCvMoth11,
                            // this.NameDate.countCvMoth12
                            5, 2, 3, 5, 7, 1, 12, 15, 6, 7, 10, 5
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
  