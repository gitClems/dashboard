import { end, start } from "./main.js"

const ctx = document.getElementById("convertion-client-chart").getContext("2d")
const gradientSegment = ctx.createLinearGradient(0, 0, 200, 0)
gradientSegment.addColorStop(0, 'rgba(55, 222, 144, 0.50)')
gradientSegment.addColorStop(0.2, 'rgba(55, 222, 164, 0.50)')
gradientSegment.addColorStop(0.4, 'rgba(55, 222, 164, 0.90)')
gradientSegment.addColorStop(0.8, 'rgba(55, 222, 164, 1)')
gradientSegment.addColorStop(1, 'rgb(55, 88, 222)')
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
        const niveau = data.datasets[0].data[0]
        const nbNvClientRestant = data.datasets[0].data[1]

        ctx.font = "15px none"
        ctx.textBaseLine = "top"

        ctx.textAlign = "left"
        ctx.fillStyle = "#444"
        ctx.fillText("0%", left + 2, yCoor + 15)

        ctx.textAlign = "right"
        ctx.fillStyle = "#444"
        ctx.fillText("100%", right, yCoor + 15)

        var fillColor = "grey"
        ctx.font = "50px none"
        ctx.textAlign = "center"
        ctx.textBaseLine = "bottom"
        ctx.fillStyle = fillColor
        ctx.fillText(getPercentage(niveau, niveau + nbNvClientRestant) + "%", xCoor, yCoor)
    }
}
var options = {
    aspectRatio: 1.5,
    plugins: {
        legend: {
            display: false
        },
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
    MyChart.data.datasets[0].data = data
    MyChart.update()
}

function getPercentage(x, total) {
    x = 100 * (x / (total))
    if (x) {
        return x.toFixed(2)
    } else {
        return 0
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
                `Client.e(s) :`,
                `Restant.e(s) :`
            ]

            datasets = [{
                label: "Total",
                data: data,
                backgroundColor: [gradientSegment, "rgba(128, 128, 128, 0.1)"],
                borderColor: "rgba(128, 128, 128, 0.5)",
                borderWidth: 0.5,
                pointStyleWidth: 1,
                circumference: 180,
                rotation: -90,
                cutout: '90%'
            },]
            MyChart = new Chart(ctx, {
                type: 'pie',
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