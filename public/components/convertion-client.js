import { end, start } from "./main.js"

const ctx = $("#convertion-client-chart")
var datasets
var nbNvInscrit
var nbNvClient
var data
var labels
var MyChart

function updateCharts(response, MyChart) {
    var nbNvInscritList = response.map((element) => element.NB_NEW_INSCRITS)
    var nbNvClientList = response.map((element) => element.NB_NEW_CLIENTS)
    nbNvInscrit = nbNvInscritList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)
    nbNvClient = nbNvClientList.reduce((accumulator, currentValue) => {
        return accumulator + currentValue
    }, 0)

    data = [nbNvInscrit, nbNvClient]
    labels = [
        `Nouveaux inscrits : ${contractInt(nbNvClient) == 100.00 ? "    0.00" : contractInt(nbNvInscrit)}%`,
        `Nouveaux clients : ${contractInt(nbNvInscrit) == 100.00 ? "    0.00" : contractInt(nbNvClient)}%`
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


$(function () {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.format("YYYY-MM-DD"),
            'end': end.format("YYYY-MM-DD")
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

            data = [nbNvInscrit, nbNvClient]
            console.log(data);
            labels = [
                `Nouveaux inscrits : ${contractInt(nbNvClient) == 100.00 ? "    0.00" : contractInt(nbNvInscrit)}%`,
                `Nouveaux clients : ${contractInt(nbNvInscrit) == 100.00 ? "    0.00" : contractInt(nbNvClient)}%`
            ]

            datasets = [{
                label: "Taux de convertion clientèle",
                data: data,
                backgroundColor: ["rgba(255, 166, 0, 0.502)", "skyblue"],
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

async function convertionClient(start, end) {
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
export default convertionClient