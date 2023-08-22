async function achatPacksGlobalChart() {

    const ctx = $("#achat-packs-chart")
    let datasets

    var MyChart

    function contractInt(param) {
        param = 100 * (param / (pack + oneShot))
        if (param) {
            return param.toFixed(2)
        } else {
            return "---"
        }
    }

    // Définition du graphe initial
    var pack // Nombre d'expéditions pack
    var oneShot // Nombre d'expéditions oneShot
    let data // Les données inscrites dans le tableaux data [pack,oneShot]
    let labels


    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': $('#start-date').val(),
            'end': $('#end-date').val()
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


    // On crée une fonction pour les mise à jours des données.
    // Un fonction réutilisable
    function updateCharts(response) {
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

export default achatPacksGlobalChart