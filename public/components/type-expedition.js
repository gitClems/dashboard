import { end, start } from "./main.js"

const ctx = $("#type-expedition-chart")
var datasets
var c2c
var aio
var dom
var data
var labels
var MyChart

function updateCharts(response, MyChart) {
    var c2cList = response.map((element) => element.NB_EXPEDITIONS_C2C)
    var aioList = response.map((element) => element.NB_AIO_EXPEDITIONS)
    var totalList = response.map((element) => element.NB_EXPEDITIONS)
    c2c = c2cList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)
    aio = aioList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)
    dom = totalList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)
    dom = dom - c2c - aio
    // console.log(dom);

    data = [c2c, aio, dom]
    labels = [
        `C2C : ${getPercentage(aio, aio + c2c + dom) == 100.00 || getPercentage(dom, aio + c2c + dom) == 100.00 ? "    0.00" : getPercentage(c2c, aio + c2c + dom)}%`,
        `AIO : ${getPercentage(dom, aio + c2c + dom) == 100.00 || getPercentage(c2c, aio + c2c + dom) == 100.00 ? "    0.00" : getPercentage(aio, aio + c2c + dom)}%`,
        `DOM : ${getPercentage(aio, aio + c2c + dom) == 100.00 || getPercentage(c2c, aio + c2c + dom) == 100.00 ? "    0.00" : getPercentage(dom, aio + c2c + dom)}%`,
    ]
    // labels = ["C2C", "AIO", "DOM"]
    MyChart.data.labels = labels
    MyChart.data.datasets[0].data = data
    MyChart.update()
}

function getPercentage(param, total) {
    param = 100 * (param / (total))
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
            var c2cList = response.map((element) => element.NB_EXPEDITIONS_C2C)
            var aioList = response.map((element) => element.NB_AIO_EXPEDITIONS)
            var totalList = response.map((element) => element.NB_EXPEDITIONS)
            c2c = c2cList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            aio = aioList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            dom = totalList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            dom = dom - c2c - aio
            // console.log(dom);

            data = [c2c, aio, dom]
            labels = [
                `C2C : ${getPercentage(aio, aio + c2c + dom) == 100.00 || getPercentage(dom, aio + c2c + dom) == 100.00 ? "    0.00" : getPercentage(c2c, aio + c2c + dom)}%`,
                `AIO : ${getPercentage(dom, aio + c2c + dom) == 100.00 || getPercentage(c2c, aio + c2c + dom) == 100.00 ? "    0.00" : getPercentage(aio, aio + c2c + dom)}%`,
                `DOM : ${getPercentage(aio, aio + c2c + dom) == 100.00 || getPercentage(c2c, aio + c2c + dom) == 100.00 ? "    0.00" : getPercentage(dom, aio + c2c + dom)}%`,
            ]

            datasets = [{
                label: "Nombre d'expéditions",
                data: data,
                backgroundColor: ["rgba(1, 255, 1, 0.5)", "skyblue", "rgb(236, 127, 236)"],
                borderWidth: 2,
                pointStyleWidth: 1
            },]
            MyChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: datasets
                },
            })
        },
    });
})

async function typeExpeditionGlobalChart(start, end) {
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
export default typeExpeditionGlobalChart