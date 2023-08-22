async function typeExpeditionGlobalChart() {

    const ctx = $("#type-expedition-chart")
    let datasets

    var MyChart

    function contractInt(param) {
        param = 100 * (param / (c2c + aio))
        if (param) {
            return param.toFixed(2)
        } else {
            return "---"
        }
    }
    var c2c // Nombre d'expéditions C2C
    var aio // Nombre d'expéditions AIO
    let data // Les données inscrites dans le tableaux data [c2c,aio]
    let labels // L


    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': $('#start-date').val(),
            'end': $('#end-date').val()
        },
        success: function (response) {

            var c2cList = response.map((element) => element.NB_EXPEDITIONS_C2C)
            var aioList = response.map((element) => element.NB_AIO_EXPEDITIONS)
            c2c = c2cList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)
            aio = aioList.reduce((accumulator, currentValue) => {
                return accumulator + currentValue
            }, 0)

            data = [c2c, aio]
            console.log(data);
            labels = [
                `C2C : ${contractInt(aio) == 100.00 ? "    0.00" : contractInt(c2c)}%`,
                `AIO : ${contractInt(c2c) == 100.00 ? "    0.00" : contractInt(aio)}%`
            ]

            datasets = [{
                label: "Nombre d'expéditions",
                data: data,
                backgroundColor: ["rgba(1, 255, 1, 0.5)", "skyblue"],
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

    function updateCharts(response) {
        var c2cList = response.map((element) => element.NB_EXPEDITIONS_C2C)
        var aioList = response.map((element) => element.NB_AIO_EXPEDITIONS)
        c2c = c2cList.reduce((accumulator, currentValue) => {
            return accumulator + currentValue
        }, 0)
        aio = aioList.reduce((accumulator, currentValue) => {
            return accumulator + currentValue
        }, 0)

        data = [c2c, aio]
        labels = [
            `C2C : ${contractInt(aio) == 100.00 ? "    0.00" : contractInt(c2c)}%`,
            `AIO : ${contractInt(c2c) == 100.00 ? "    0.00" : contractInt(aio)}%`
        ]
        MyChart.data.labels = labels
        MyChart.data.datasets[0].data = data
        MyChart.update()
    }
    $("#default-date-range-select, #end-date, #start-date").change(function () {
        console.log("Ajax");
        $.ajax({
            type: "GET",
            url: "accueil",
            data: {
                'start': $('#start-date').val(),
                'end': $('#end-date').val()
            },
            success: function (response) {
                updateCharts(response, MyChart)
                console.log(data);
                console.log(labels);
            },
            error: function (error) {
                alert("Oups ! Something went wrong")
            }
        });
    })

}

export default typeExpeditionGlobalChart