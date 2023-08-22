async function expeditionGlobalChart() {

    const ctx = $("#expedition-global-chart")
    let data
    let labels

    let datasets

    // console.log($('#start-date').val());
    // console.log($('#end-date').val());

    var MyChart

    $.ajax({
        type: "GET",
        url: "accueil",
        data: {
            'start': $('#start-date').val(),
            'end': $('#end-date').val()
        },
        success: function (response) {

            data = response.map((element) => element.NB_EXPEDITIONS)
            labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))

            console.log(data);
            console.log(labels);
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


export default  expeditionGlobalChart