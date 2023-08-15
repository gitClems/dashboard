<div class="chart-container">
    <canvas id="expedition-global-chart" class="top-chart expedition-global-chart"></canvas>
    <div>
        <label for="type-line">Courbe</label>
        <input type="radio" class="expedition-global-chart-type" name="expedition-global-chart-type" id="type-line"
            value='line' checked>
        <label for="type-bar">Histogramme</label>
        <input type="radio" class="expedition-global-chart-type" name="expedition-global-chart-type" id="type-bar"
            value='bar'>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const ctx = $("#expedition-global-chart")

            // Définition du graphe initial
            let data = [
                @foreach ($result as $res)
                    {{ $res->NB_EXPEDITIONS }},
                @endforeach
            ]

            let labels = [
                @foreach ($result as $res)
                    `{{ $res->DATE_REPORT }}`,
                @endforeach
            ]

            let datasets = [{
                label: "Nombre d'expéditions",
                data: data,
                backgroundColor: "rgb(206, 206, 50,1)",
                borderColor: "rgb(206, 206, 50,1)",
                pointStyle: false,
                borderWidth: 2
            }, ]

            var MyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    fill: false,
                }
            })

            function updateCharts(response) {
                data = response.map((element) => element.NB_EXPEDITIONS)
                labels = response.map((element) => element.DATE_REPORT)
                MyChart.data.labels = labels
                MyChart.data.datasets[0].data = data
                MyChart.update()
            }
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
                        updateCharts(response)
                        $('#start-date').val(`{{ $min }}`)
                        $('#end-date').val(`{{ $max }}`)
                    },
                    error: function(error) {
                        alert("Oups ! Something went wrong")
                    }
                });
            })

            // Changer la représentation du type de grapghe 
            $('.expedition-global-chart-type').change(function() {
                MyChart.destroy()
                MyChart = new Chart(ctx, {
                    type: $(this).val(),
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        fill: false
                    }
                })
            })
        })
    </script>
</div>
