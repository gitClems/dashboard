
import { end, start } from "./main.js"

const ctx = $("#chiffre-affaire-global-chart")
var data
var labels
var datasets
var MyChart

function updateCharts(response, MyChart) {
    data = response.map((element) => element.CHIFFRE_AFFAIRE)
    labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))
    MyChart.data.labels = labels
    if (labels.length > 45) {
        MyChart.data.datasets[0].pointStyle = false
    } else {
        MyChart.data.datasets[0].pointStyle = true
    }
    MyChart.data.datasets[0].data = data
    MyChart.update()
}

$(function () {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.toISOString(),
            'end': end.toISOString()
        },
        success: function (response) {
            data = response.map((element) => element.CHIFFRE_AFFAIRE)
            labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))
            datasets = [{
                label: "Chiffre d'affaire",
                data: data,
                backgroundColor: "rgba(255, 166, 0, 0.502)",
                borderColor: "rgba(255, 166, 0, 1)",
                borderWidth: 2,
                pointStyleWidth: 1
            },]
            MyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
            })
        },
    });
})

async function chiffreAffaireGlobalChart(start, end) {
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

export default chiffreAffaireGlobalChart