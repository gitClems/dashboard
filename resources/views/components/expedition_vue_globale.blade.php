<div class="chart-container">
    <canvas id="expedition-global-chart" class="top-chart expedition-global-chart"></canvas>
    <div style="display: flex; justify-content : space-between">
        <div>
            <label for="type-line">Courbe</label>
            <input type="radio" class="expedition-global-chart-type" name="expedition-global-chart-type" id="type-line"
                value='line' checked>
            <label for="type-bar">Histogramme</label>
            <input type="radio" class="expedition-global-chart-type" name="expedition-global-chart-type"
                id="type-bar" value='bar'>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Définition du graphe initial
            const ctx = $("#expedition-global-chart")
            let data
            let labels
            let options = {
                // responsive: true
            }

            let datasets = [{
                label: "Nombre d'expéditions",
                data: data,
                backgroundColor: "rgb(206, 206, 50,1)",
                borderColor: "rgb(206, 206, 50,1)",
                borderWidth: 2,
                pointStyleWidth: 1
            }, ]

            var MyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: options
            })

            function updateCharts(response) {
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

            // Pour une meilleur expérience Ajax reste l'une des méthodes d'extraction et d'interaction entre les requetts et le servers
            // On affiche les premières valeurs
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard') }}",
                data: {
                    'start': $('#start-date').val(),
                    'end': $('#end-date').val()
                },
                success: function(response) {
                    updateCharts(response)
                },
            });

            // Ici se trouve un évènement qui capture la selection des intervalles
            // *** La semaine courante
            // *** La dernière semaine
            // *** Le mois courant
            // *** Le mois passé
            // *** Un intervall personnalisé
            // *** Etc.
            $("#date-range-select, #end-date, #start-date").change( function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('dashboard') }}",
                    data: {
                        'start': $('#start-date').val(),
                        'end': $('#end-date').val()
                    },
                    success: function(response) {
                        updateCharts(response)
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
                    options: options
                })
            })
        })
    </script>
</div>
