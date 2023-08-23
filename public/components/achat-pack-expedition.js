import { end, start } from "./main.js"

const ctx = $("#achat-packs-chart")
var datasets
var pack
var oneShot
var data
var labels
var MyChart

function updateCharts(response, MyChart) {
    var packList = response.map((element) => element.NB_ACHATS_PACK)
    var oneShotList = response.map((element) => element.NB_ACHATS_ONESHOT)
    pack = packList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)
    oneShot = oneShotList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)

    data = [pack, oneShot]
    labels = [
        `Pack     : ${contractInt(oneShot) == 100.00 ? "    0.00" : contractInt(pack)}%`,
        `One Shot : ${contractInt(pack) == 100.00 ? "    0.00" : contractInt(oneShot)}%`
    ]
    MyChart.data.labels = labels
    MyChart.data.datasets[0].data = data
    MyChart.update()
}

function contractInt(param) {
    param = 100 * (param / (pack + oneShot))
    if (param) {
        return param.toFixed(2)
    } else {
        return "---"
    }
}


$(function () {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.format("YYYY-MM-DD"),
            'end': end.format("YYYY-MM-DD")
        },
        success: function (response) {
            var packList = response.map((element) => element.NB_ACHATS_PACK)
            var oneShotList = response.map((element) => element.NB_ACHATS_ONESHOT)
            pack = packList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            oneShot = oneShotList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            data = [pack, oneShot]
            console.log(data);
            labels = [
                `Pack     : ${contractInt(oneShot) == 100.00 ? "    0.00" : contractInt(pack)}%`,
                `One Shot : ${contractInt(pack) == 100.00 ? "    0.00" : contractInt(oneShot)}%`
            ]

            datasets = [{
                label: "Nombre d'expéditions",
                data: data,
                backgroundColor: ["yellowgreen", "rgba(0, 128, 0, 0.5)"],
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


async function achatPacksGlobalChart(start, end) {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.format("YYYY-MM-DD"),
            'end': end.format("YYYY-MM-DD")
        },
        success: function (response) {
            updateCharts(response, MyChart)
        },
    });
}
export default achatPacksGlobalChart