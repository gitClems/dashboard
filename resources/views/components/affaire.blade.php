<div class="top-chart-chart-container">
    <canvas id="chiffre-affaire-global-chart" class="top-chart chiffre-affaire-global-chart"></canvas>
    <div class="top-chart-setting">
      {{--  <div>

            <label for="type-line">Courbe</label>
            <input type="radio" class="chiffre-affaire-global-chart-type" name="chiffre-affaire-global-chart-type"
                id="type-line" value='line' checked>
         </div>

        <div>

            <label for="type-bar">Histogramme</label>
            <input type="radio" class="chiffre-affaire-global-chart-type" name="chiffre-affaire-global-chart-type"
                id="type-bar" value='bar'>
        </div> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Définition du graphe initial
            const ctx = $("#chiffre-affaire-global-chart")
            let expeditionData
            let chiffaireAffaireData
            let labels
            let options = {
                scales: {
                    chiffreAffaire: {
                        title: {
                            display: true,
                            text: "Chiffre d'affaire",
                        },
                        position: 'right',
                        ticks: {
                            callback: function(value) {
                                return `${value} Dhs`;
                            }
                        },
                        grid: {
                            drawOnChartArea: false
                        },
                    },

                    y: {
                        title: {
                            display: true,
                            text: "Nombre d'expéditions",
                        },
                        ticks: {
                            callback: function(value) {
                                return `${value} colis`;
                            }
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    },
                    x: {
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }

            let datasets = [{
                    label: "Nombre d'expéditions",
                    type: 'bar',
                    data: expeditionData,
                    backgroundColor: "rgb(20, 20, 150,0.1)",
                    borderColor: "rgb(20, 20, 150,1)",
                    borderWidth: 2,
                    yAxisID: 'y',
                    fill: true,
                    tension: 0.2,
                    pointStyle: false,
                    borderRadius : 5
                },
                {
                    label: "Chiffre d'affaire",
                    data: chiffaireAffaireData,
                    backgroundColor: "rgba(255, 166, 0, 0.1)",
                    borderColor: "rgba(255, 166, 0, 1)",
                    borderWidth: 2,
                    yAxisID: 'chiffreAffaire',
                    pointStyle: false,
                    borderRadius : 5,
                    fill: true,
                    animations: {
                        tension: {
                            duration: 100,
                            easing: 'linear',
                            from: 1,
                            to: 0.4,
                        }
                    }
                },
            ]

            var MyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options
            })

            function updateCharts(response) {
                expeditionData = response.map((element) => element.NB_EXPEDITIONS)
                chiffaireAffaireData = response.map((element) => element.CHIFFRE_AFFAIRE)
                labels = response.map((element) => moment(element.DATE_REPORT).format('DD/MM/YY'))
                MyChart.data.labels = labels
                MyChart.data.datasets[0].data = expeditionData
                MyChart.data.datasets[1].data = chiffaireAffaireData
                if (labels.length > 45) {
                    MyChart.data.datasets[0].pointStyle = false
                    MyChart.data.datasets[1].pointStyle = false
                } else {
                    MyChart.data.datasets[0].pointStyle = true
                    MyChart.data.datasets[1].pointStyle = true
                }
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
            $("#default-date-range-select, #end-date, #start-date").change(function() {
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
            // $('.chiffre-affaire-global-chart-type').change(function() {
            //     MyChart.destroy()
            //     MyChart = new Chart(ctx, {
            //         type: $(this).val(),
            //         data: {
            //             labels: labels,
            //             datasets: datasets
            //         },
            //         options
            //     })
            // })
        })
    </script>
</div>
