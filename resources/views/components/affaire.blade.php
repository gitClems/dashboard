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
            
            let data
            let labels

            let datasets = [{
                label: "Chiffre d'affaire",
                data: data,
                backgroundColor: "skyblue",
                borderColor: "skyblue",
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
                labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))
                MyChart.data.labels = labels
                MyChart.data.datasets[0].data = data
                MyChart.update()
            }

            
            // On donne par defaut un interval de date dans lequel on va afficher les données dans les grapqhes
            // Pour notre on décide de prendre pour intervall la semaine courante
            var start = moment().startOf('week')
            var end = moment().endOf('week')

            
            // Pour une meilleur expérience Ajax reste l'une des méthodes d'extraction et d'interaction entre les requetts et le servers
            // On affiche les premières valeurs
            $.ajax({
                type: "GET",
                url: "{{ route('dashboard') }}",
                data: {
                    'start': start.format('YYYY-MM-DD'),
                    'end': end.format('YYYY-MM-DD')
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
            $("#date-range-select").change(async function() {
                let rangeType = $(this).val()

                // Les conditions ici sont
                // - Si on choisi autre type d'intervalle qu'un intervalle personnalisé alors tous les autres paramètres sur les dates sont vérouillés
                // et on affaiche les graphes comme l'intervalle le laisse voir
                // - Dans le cas contraire si on choisi un intervalle personnalisé,
                // on déverouille les paramètres sur les dates et on laisse le libre choix à l'utilisateur d'introduire les dates comme il le veut

                if (rangeType == 'custom-range') {
                    document.getElementById("start-date").disabled = false
                    document.getElementById("end-date").disabled = false
                } else {
                    document.getElementById("start-date").disabled = true
                    document.getElementById("end-date").disabled = true
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

            
            // Dans le cas ou le type d'intervalle choisi par l'utilisateur est un de type personnalisé
            // Capturer les changements des dates de départ et de fin dans l'interval et on exécute la requete ajax
            $('#end-date, #start-date').change(function() {
                end = $('#end-date').val()
                start = $('#start-date').val()
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
