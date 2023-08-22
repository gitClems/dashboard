async function chiffreAffaireGlobalChart() {

    const ctx = $("#chiffre-affaire-global-chart")
    let data
    let labels

    let datasets

    var MyChart



    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': $('#start-date').val(),
            'end': $('#end-date').val()
        },
        success: function (response) {

            data = response.map((element) => element.CHIFFRE_AFFAIRE)
            labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))

            console.log(data);
            console.log(labels);
            datasets = [{
                label: "Nombre d'expéditions",
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


    $('.chiffre-affaire-global-chart-type').change(function () {
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

export default chiffreAffaireGlobalChart