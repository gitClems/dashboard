<div class="chart-type-expedition-container">
    <canvas id="type-expedition-chart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const ctx = $("#type-expedition-chart")

            function contractInt(param) {
                param = 100 * (param / (c2c + aio))
                if (param) {
                    return param.toFixed(2)
                } else {
                    return "---"
                }
            }

            // Définition du graphe initial
            var c2c = {{ $typeExpedition[0]->C2C }}
            var aio = {{ $typeExpedition[0]->AIO }}
            // var  = {{ $typeExpedition[0]->TOTAL_SUM - $typeExpedition[0]->AIO - $typeExpedition[0]->C2C }}
            let data = [c2c, aio, ]
            let labels = [
                `C2C : ${contractInt(c2c)}%`,
                `AIO : ${contractInt(aio)}%`,
            ]

            let datasets = [{
                label: "Expéditions",
                data: data,
                backgroundColor: ["yellowgreen", "blue", "purple"],
                pointStyle: false,
                borderWidth: 0.5
            }, ]

            var MyChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: datasets
                },
            })

            function updateCharts(response) {
                var c2cList = response.map((element) => element.NB_EXPEDITIONS_C2C)
                var aioList = response.map((element) => element.NB_AIO_EXPEDITIONS)
                c2c = c2cList.reduce((accumulator, currentValue) => {
                    return accumulator + currentValue
                }, 0)
                aio = aioList.reduce((accumulator, currentValue) => {
                    return accumulator + currentValue
                }, 0)

                data = [
                    c2c,
                    aio,
                ]
                labels = [
                    `C2C : ${contractInt(aio) == 100.00 ? "    0.00" : contractInt(c2c) }%`,
                    `AIO : ${contractInt(c2c) == 100.00 ? "    0.00" : contractInt(aio) }%`,
                ]
                MyChart.data.labels = labels
                MyChart.data.datasets[0].data = data
                MyChart.update()
            }

            $("#date-range-select").change(async function() {
                let rangeType = $(this).val()
                var start = moment().startOf('week')
                var end = moment().endOf('week')
                if (rangeType == 'custom-range') {
                    document.getElementById("start-date").disabled = false
                    document.getElementById("end-date").disabled = false
                    document.getElementById("reset-date-range").disabled = false
                } else {
                    document.getElementById("start-date").disabled = true
                    document.getElementById("end-date").disabled = true
                    document.getElementById("reset-date-range").disabled = true
                    switch (rangeType) {
                        case "this-week":
                            start = moment().startOf('week')
                            end = moment().endOf('week')
                            break
                        case "last-week":
                            start = moment().subtract(1, 'week').startOf('week')
                            end = moment().subtract(1, 'week').endOf('week')
                            break
                        case "last-month":
                            start = moment().subtract(1, 'month').startOf('month')
                            end = moment().subtract(1, 'month').endOf('month')
                            break
                        case "this-month":
                            start = moment().startOf('month')
                            end = moment().endOf('month')
                            break

                        default:
                            break
                    }
                    $.ajax({
                        type: "GET",
                        url: "{{ route('dashboard') }}",
                        data: {
                            'start': start.format('YYYY-MM-DD'),
                            'end': end.format('YYYY-MM-DD'),
                        },
                        success: function(response) {
                            updateCharts(response)
                            $('#start-date').val(start.format("YYYY-MM-DD"))
                            $('#end-date').val(end.format("YYYY-MM-DD"))
                        },
                        error: function(error) {
                            alert("Oups ! Something went wrong")
                        }
                    });
                }
            })


            // Capturer le changement des dates de départ et de fin dans l'interval
            $('#end-date, #start-date').change(function() {
                const end = $('#end-date').val()
                const start = $('#start-date').val()
                $.ajax({
                    type: "GET",
                    url: "{{ route('dashboard') }}",
                    data: {
                        'start': start,
                        'end': end
                    },
                    success: function(response) {
                        updateCharts(response)
                    },
                });
            })

            // Réinitialiser l'intervalle  de visualisation des graphes
            $('#reset-date-range').on('click', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('dashboard') }}",
                    data: {
                        'start': `{{ $min }}`,
                        'end': `{{ $max }}`
                    },
                    success: function(response) {
                        updateCharts(response)
                    },
                });
            })
        })
    </script>
</div>
