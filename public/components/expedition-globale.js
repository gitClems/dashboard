
import { end, start } from "./main.js"

const ctx = $("#expedition-global-chart")
var data
var labels
var datasets
var MyChart
$(function () {
    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': start.format("YYYY-MM-DD"),
            'end': end.format("YYYY-MM-DD")
        },
        success: function (response) {
            data = response.map((element) => element.NB_EXPEDITIONS)
            labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))
            datasets = [{
                label: "Nombre d'expéditions",
                data: data,
                backgroundColor: "rgb(206, 206, 50,0.5)",
                borderColor: "rgb(206, 206, 50,1)",
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

async function expeditionGlobalChart(start, end) {

    function updateCharts(response, MyChart) {
        data = response.map((element) => element.NB_EXPEDITIONS)
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

    $('.expedition-global-chart-type').change(function () {
        MyChart.destroy()
        MyChart = new Chart(ctx, {
            type: $(this).val(),
            data: {
                labels: labels,
                datasets: datasets
            },
        })
    })
}

export default expeditionGlobalChart