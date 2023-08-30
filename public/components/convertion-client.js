import { end, start } from "./main1.js"

const ctx = $("#convertion-client-chart")
var datasets
var nbNvInscrit
var nbNvClient
var data
var labels
var MyChart
var jaugeContainer = {
    id: "jaugeContainer",
    afterDatasetsDraw(chart, arg, pluginsOptions) {
        const { ctx, data, chartArea: { top, bottom, left, right, width, height
        }, scales: { r } } = chart;
        ctx.save()
        const xCoor = chart.getDatasetMeta(0).data[0].x
        const yCoor = chart.getDatasetMeta(0).data[0].y
        // console.log(xCoor," - ",yCoor);
        ctx.fillRect(xCoor, yCoor, 400, 5)
        ctx.fillText('0', left + 2, yCoor + 10)
    }
}
var options = {
    aspectRatio: 1.5,
    plugins: {
        legend: {
            display: false
        }
    },
}

function updateCharts(response, MyChart) {
    var nbNvInscritList = response.map((element) => element.NB_NEW_INSCRITS)
    var nbNvClientList = response.map((element) => element.NB_NEW_CLIENTS)
    nbNvInscrit = nbNvInscritList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)
    nbNvClient = nbNvClientList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)

    data = [nbNvClient, nbNvInscrit - nbNvClient]
    labels = [
        `Nouveaux clients : ${contractInt(nbNvInscrit) == 100.00 ? "    0.00" : contractInt(nbNvClient)}%`,
        `Nouveaux inscrits : ${contractInt(nbNvClient) == 100.00 ? "    0.00" : contractInt(nbNvInscrit)}%`,
    ]
    MyChart.data.labels = labels
    MyChart.data.datasets[0].data = data
    MyChart.update()
}

function contractInt(param) {
    param = 100 * (param / (nbNvInscrit + nbNvClient))
    if (param) {
        return param.toFixed(2)
    } else {
        return "---"
    }
}


$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.toISOString(),
            'end': end.toISOString()
        },
        success: function (response) {
            var nbNvInscritList = response.map((element) => element.NB_NEW_INSCRITS)
            var nbNvClientList = response.map((element) => element.NB_NEW_CLIENTS)
            nbNvInscrit = nbNvInscritList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            nbNvClient = nbNvClientList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)

            data = [nbNvClient, nbNvInscrit - nbNvClient]
            labels = [
                `Nouveaux clients : ${contractInt(nbNvInscrit) == 100.00 ? "    0.00" : contractInt(nbNvClient)}%`,
                `Nouveaux inscrits : ${contractInt(nbNvClient) == 100.00 ? "    0.00" : contractInt(nbNvInscrit)}%`,
            ]

            datasets = [{
                label: "Taux de convertion clientèle",
                data: data,
                backgroundColor: ["rgba(255, 166, 0, 0.502)", "skyblue"],
                borderWidth: 2,
                pointStyleWidth: 1,
                circumference: 180,
                rotation: -90,
                borderWidth: 0,
                cutout: '90%'
            },]
            MyChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options,
                plugins: [jaugeContainer]
            })
        },
    });
})

async function convertionClient(start, end) {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.toISOString(),
            'end': end.toISOString()
        },
        success: function (response) {
            updateCharts(response, MyChart)
        },
    });
}
export default convertionClient