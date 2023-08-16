<div class="chart-container">
    <canvas id="chart-achat-packs-expedition" class="middle-chart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const ctx = $("#chart-achat-packs-expedition")

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
            // Définition du graphe initial
            var pack // Nombre d'expéditions pack
            var oneShot // Nombre d'expéditions oneShot
            let data // Les données inscrites dans le tableaux data [pack,oneShot]
            let labels // Les labels (pack et oneShot)


            let datasets = [{
                label: "Expéditions",
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
            })

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
                    `pack : ${contractInt(oneShot) == 100.00 ? "    0.00" : contractInt(pack) }%`,
                    `oneShot : ${contractInt(pack) == 100.00 ? "    0.00" : contractInt(oneShot) }%`
                ]
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
                start = $('#start-date').val()
                end = $('#end-date').val()
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
        })
    </script>
</div>
