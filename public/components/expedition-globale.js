import { end, start } from "./main1.js"

const ctx = $("#expedition-global-chart")
var expeditionData
var chiffaireAffaireData
var labels
var datasets
var MyChart
var options = {
    scales: {
        chiffreAffaire: {
            title: {
                display: true,
                text: "Chiffre d'affaire",
            },
            position: 'right',
            ticks: {
                callback: function (value) {
                    return `${value} Dhs`;
                }
            },
            grid: {
                drawOnChartArea: true
            },
        },

        y: {
            title: {
                display: true,
                text: "Nombre d'expéditions",
            },
            ticks: {
                callback: function (value) {
                    return `${value} colis`;
                }
            },
            grid: {
                drawOnChartArea: false
            }
        },
        x: {
            grid: {
                drawOnChartArea: false
            }
        }
    },
}


function sum(param) {
    var sum = 0
    param.forEach(element => {
        sum += parseInt(element)
    });
    return sum
}

function troncature(param) {
    param = parseInt(param)
    if (param >= 1000000000) {
        param = (param / 1000000000).toFixed(2)
        return param + 'G'
    }
    if (param >= 1000000) {
        param = (param / 1000000).toFixed(2)
        return param + 'M'
    }
    if (param >= 1000) {
        param = (param / 1000).toFixed(2)
        return param + 'K'
    }
    if (param < 1000) {
        return param
    }
}

function displayOnScreen(data, unite, ctxTotal, ctxAvr, ctxMin, ctxMAx) {
    if (data.length > 0) {
        var avr = 0
        avr = sum(data)
        avr = avr / data.length
        document.querySelector(ctxTotal).innerHTML = troncature(sum(data).toFixed(2)) + unite
        document.querySelector(ctxMin).innerHTML = troncature(Math.min.apply(null, data).toFixed(2)) + unite
        document.querySelector(ctxMAx).innerHTML = troncature(Math.max.apply(null, data).toFixed(2)) + unite
        document.querySelector(ctxAvr).innerHTML = troncature(avr.toFixed(2)) + unite
    } else {
        document.querySelector(ctxTotal).innerHTML = "---"
        document.querySelector(ctxMin).innerHTML = "---"
        document.querySelector(ctxMAx).innerHTML = "---"
        document.querySelector(ctxAvr).innerHTML = "---"
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
            expeditionData = response.map((element) => element.NB_EXPEDITIONS)
            chiffaireAffaireData = response.map((element) => element.CHIFFRE_AFFAIRE)
            labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))

            displayOnScreen(expeditionData, "", "#total-expeditions .value", "#moyenne-expeditions .value", "#min-expeditions .value", "#max-expeditions .value")
            displayOnScreen(chiffaireAffaireData, "Dhs", "#total-chiffre-affaire .value", "#moyenne-chiffre-affaire .value", "#min-chiffre-affaire .value", "#max-chiffre-affaire .value")
            datasets = [{
                label: "Nombre d'expéditions",
                type: 'bar',
                data: expeditionData,
                backgroundColor: "rgb(20, 20, 150,0.1)",
                borderColor: "rgb(20, 20, 150,1)",
                borderWidth: 2,
                yAxisID: 'y',
                fill: true,
                tension: 0.2,
                pointStyle: false,
                borderRadius: 5
            },
            {
                label: "Chiffre d'affaire",
                data: chiffaireAffaireData,
                backgroundColor: "rgba(255, 166, 0, 0.3)",
                borderColor: "rgba(255, 166, 0, 1)",
                borderWidth: 2,
                yAxisID: 'chiffreAffaire',
                pointStyle: false,
                borderRadius: 5,
                fill: true,
                animations: {
                    tension: {
                        duration: 100,
                        easing: 'linear',
                        from: 1,
                        to: 0.4,
                    }
                }
            },
            ]
            MyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options
            })
        },
    });
})
async function expeditionGlobalChart(start, end) {
    // console.log(start.toISOString());
    function updateCharts(response, MyChart) {
        expeditionData = response.map((element) => element.NB_EXPEDITIONS)
        chiffaireAffaireData = response.map((element) => element.CHIFFRE_AFFAIRE)
        labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))
        MyChart.data.labels = labels
        MyChart.data.datasets[0].data = expeditionData
        MyChart.data.datasets[1].data = chiffaireAffaireData
        if (labels.length > 45) {
            MyChart.data.datasets[1].pointStyle = false
        } else {
            MyChart.data.datasets[1].pointStyle = true
        }
        MyChart.update()

        displayOnScreen(expeditionData, "", "#total-expeditions .value", "#moyenne-expeditions .value", "#min-expeditions .value", "#max-expeditions .value")
        displayOnScreen(chiffaireAffaireData, "Dhs", "#total-chiffre-affaire .value", "#moyenne-chiffre-affaire .value", "#min-chiffre-affaire .value", "#max-chiffre-affaire .value")
    }
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

export default expeditionGlobalChart