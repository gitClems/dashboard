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

function displayOnScreen(data, unite, ctxTotal, ctxAvg, ctxMin, ctxMAx) {
    var total = document.querySelector(ctxTotal + " .value")
    var min = document.querySelector(ctxMin + " .value")
    var max = document.querySelector(ctxMAx + " .value")
    var moyenne = document.querySelector(ctxAvg + " .value")
    
    if (data.length > 0) {
        var Avg = 0
        Avg = sum(data)
        Avg = Avg / data.length
        total.innerHTML = troncature(sum(data).toFixed(2)) + unite
        min.innerHTML = troncature(Math.min.apply(null, data).toFixed(2)) + unite
        max.innerHTML = troncature(Math.max.apply(null, data).toFixed(2)) + unite
        moyenne.innerHTML = troncature(Avg.toFixed(2)) + unite

        $(ctxTotal).mouseover(function () {
            $(ctxTotal + " .tooltip-text").html(sum(data).toFixed(2))
        })

        $(ctxAvg).mouseover(function () {
            $(ctxAvg + " .tooltip-text").html(Avg.toFixed(2))
        })

        $(ctxMAx).mouseover(function () {
            $(ctxMAx + " .tooltip-text").html(Math.max.apply(null, data).toFixed(2))
        })

        $(ctxMin).mouseover(function () {
            $(ctxMin + " .tooltip-text").html(Math.min.apply(null, data).toFixed(2))
        })
    } else {
        total.innerHTML = "---"
        min.innerHTML = "---"
        max.innerHTML = "---"
        moyenne.innerHTML = "---"

        $(ctxTotal).mouseover(function () {
            $(ctxTotal + " .tooltip-text").html("---")
        })

        $(ctxAvg).mouseover(function () {
            $(ctxAvg + " .tooltip-text").html("---")
        })

        $(ctxMAx).mouseover(function () {
            $(ctxMAx + " .tooltip-text").html("---")
        })

        $(ctxMin).mouseover(function () {
            $(ctxMin + " .tooltip-text").html("---")
        })
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

            displayOnScreen(expeditionData, "", "#total-expeditions", "#moyenne-expeditions", "#min-expeditions", "#max-expeditions")
            displayOnScreen(chiffaireAffaireData, "Dhs", "#total-chiffre-affaire", "#moyenne-chiffre-affaire", "#min-chiffre-affaire", "#max-chiffre-affaire")
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

        displayOnScreen(expeditionData, "", "#total-expeditions", "#moyenne-expeditions", "#min-expeditions", "#max-expeditions")
        displayOnScreen(chiffaireAffaireData, "Dhs", "#total-chiffre-affaire", "#moyenne-chiffre-affaire", "#min-chiffre-affaire", "#max-chiffre-affaire")
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