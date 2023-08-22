<div class="chart-container">
    <canvas id="chart-achat-packs-expedition" class="middle-chart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            // Définition du graphe initial
            var pack // Nombre d'expéditions pack
            var oneShot // Nombre d'expéditions oneShot
            let data // Les données inscrites dans le tableaux data [pack,oneShot]
            let labels // Les labels (pack et oneShot)
            let options = {
                // responsive: true
            }

            const ctx = $("#chart-achat-packs-expedition")
            let datasets = [{
                data: data,
                backgroundColor: ["yellowgreen", "purple"],
                borderWidth: 0.1,
            }, ]

            // Définir le graphique MyChart avec les configurations initiales qui vont avec
            var MyChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options : options
            })

            // On crée une fonction pour arrondire des valeurs numériques.
            // Un fonction réutilisable
            function contractInt(param) {
                param = 100 * (param / (pack + oneShot))
                if (param) {
                    return param.toFixed(2)
                } else {
                    return "---"
                }
            }
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
                    `Pack     : ${contractInt(oneShot) == 100.00 ? "    0.00" : contractInt(pack) }%`,
                    `One Shot : ${contractInt(pack) == 100.00 ? "    0.00" : contractInt(oneShot) }%`
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

            // Ici se trouve les évènement de mis à jour avec la selection des intervalles
            // *** La semaine courante
            // *** La dernière semaine
            // *** Le mois courant
            // *** Le mois passé
            // *** Un intervall personnalisé
            // *** Etc.
            $("#default-date-range-select, #end-date, #start-date").change( function() {
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
        })
    </script>
</div>
