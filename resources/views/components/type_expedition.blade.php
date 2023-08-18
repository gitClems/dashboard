<div class="chart-container">
    <canvas id="type-expedition-chart" class="middle-chart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const ctx = $("#type-expedition-chart")

            // On crée une fonction pour arrondire des valeurs numériques.
            // Un fonction réutilisable
            function contractInt(param) {
                param = 100 * (param / (c2c + aio))
                if (param) {
                    return param.toFixed(2)
                } else {
                    return "---"
                }
            }
            // Définition du graphe initial
            var c2c // Nombre d'expéditions C2C
            var aio // Nombre d'expéditions AIO
            let data // Les données inscrites dans le tableaux data [c2c,aio]
            let labels // Les labels (C2C et AIO)
            let options = {
                responsive: true
            }


            let datasets = [{
                label: "Expéditions",
                data: data,
                backgroundColor: ["yellowgreen", "skyblue"],
                pointStyle: false,
                borderWidth: 0.1
            }, ]
            // Définir le graphique MyChart avec les configurations initiales qui vont avec
            var MyChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: options
            })

            // On crée une fonction pour les mise à jours des données.
            // Un fonction réutilisable
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
                    `C2C : ${contractInt(aio) == 100.00 ? "    0.00" : contractInt(c2c) }%`,
                    `AIO : ${contractInt(c2c) == 100.00 ? "    0.00" : contractInt(aio) }%`
                ]
                MyChart.data.labels = labels
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
            $("#date-range-select, #end-date, #start-date").change(async function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('dashboard') }}",
                    data: {
                        'start': $('#start-date').val(),
                        'end': $('#end-date').val(),
                    },
                    success: function(response) {
                        updateCharts(response)
                    },
                    error: function(error) {
                        alert("Oups ! Something went wrong")
                    }
                });
            })
        })
    </script>
</div>
