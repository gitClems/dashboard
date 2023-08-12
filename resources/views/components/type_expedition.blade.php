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
                return param.toFixed(2)
            }

            // Définition du graphe initial
            var c2c = {{ $typeExpedition[0]->C2C }}
            var aio = {{ $typeExpedition[0]->AIO }}
            let data = [c2c, aio]
            let labels = [
                `C2C : ${contractInt(c2c)}%`,
                `AIO : ${contractInt(aio)}%`
            ]

            let datasets = [{
                label: "Expéditions",
                data: data,
                backgroundColor: ["yellowgreen", "blue"],
                // borderColor: "red",
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
                    success: async function(response) {
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
                            aio
                        ]
                        labels = [
                            `C2C : ${c2c ? contractInt(c2c) :"---"}%`,
                            `AIO : ${aio ? contractInt(aio) :"---"}%`
                        ]
                        MyChart.data.labels = labels
                        MyChart.data.datasets[0].data = data
                        MyChart.update()
                    },
                    error: function(error) {
                        alert("Oups ! Something went wrong")
                    }
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
                            aio
                        ]
                        labels = [
                            `C2C : ${c2c ? contractInt(c2c) :"---"}%`,
                            `AIO : ${aio ? contractInt(aio) :"---"}%`
                        ]
                        MyChart.data.labels = labels
                        MyChart.data.datasets[0].data = data
                        MyChart.update()
                        $('#start-date').val(`{{ $min }}`)
                        $('#end-date').val(`{{ $max }}`)
                    },
                    error: function(error) {
                        alert("Oups ! Something went wrong")
                    }
                });
            })
        })
    </script>
</div>
