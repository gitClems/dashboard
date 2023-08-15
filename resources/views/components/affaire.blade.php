<div class="chart-container">
    <canvas id="chiffre-affaire-global-chart" class="top-chart chiffre-affaire-global-chart"></canvas>
    <div>
        <label for="type-line">Courbe</label>
        <input type="radio" class="chiffre-affaire-global-chart-type" name="chiffre-affaire-global-chart-type"
            id="type-line" value='line' checked>
        <label for="type-bar">Histogramme</label>
        <input type="radio" class="chiffre-affaire-global-chart-type" name="chiffre-affaire-global-chart-type"
            id="type-bar" value='bar'>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const ctx = $("#chiffre-affaire-global-chart")
            // Définition du graphe initial
            let data = [
                @foreach ($result as $res)
                    {{ $res->CHIFFRE_AFFAIRE }},
                @endforeach
            ]
            let labels = [
                @foreach ($result as $res)
                    `{{ $res->DATE_REPORT }}`,
                @endforeach
            ]
            let datasets = [{
                label: "Chiffre d'affaire",
                data: data,
                backgroundColor: "yellowgreen",
                borderColor: "yellowgreen",
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
                data = response.map((element) => element.CHIFFRE_AFFAIRE)
                labels = response.map((element) => element.DATE_REPORT)
                MyChart.data.labels = labels
                MyChart.data.datasets[0].data = data
                MyChart.update()
            }
            
            

            // Changer la représentation du type de grapghe 
            $('.chiffre-affaire-global-chart-type').change(function() {
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
