<nav class="navbar navbar-dark bg-dark fixed-top" style="height: fit-content; ">
    <div class="container-fluid" style=" height : 100%">
        <div class="navbar-brand">Express relai</div>
        <div style=" height : 50px;  ">
            <select name="" id="default-date-range-select">
                <option value="this-week">Semaine courante</option>
                <option value="last-week">Semaine passée</option>
                <option value="this-month">Mois courant</option>
                <option value="last-month">Mois passé</option>
                <option value="custom-range">Personnalisé</option>
            </select>
            <input type="date" name="end" id="start-date" min="{{ $min }}" @disabled(true)>
            <input type="date" name="start" id="end-date" max="{{ $max }}" @disabled(true)>
            <div
                style="display: flex; justify-content : center; border : 2px solid rgba(255, 166, 0, 0.502); background-color : rgba(255, 255, 255, 0); border-radius : 3px; height : max-content">
                <span id="error-append" style='font-size : 12px ; '></span>
            </div>
        </div>
        <div>
            <button id="light-toggler">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-moon-fill" viewBox="0 0 16 16">
                    <path
                        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                </svg>

            </button>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Express relai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Expédition</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('accueil') }}">Accueil</a>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#chiffre">Chiffre d'affaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>
    #light-toggler {
        border-radius: 15px;
        height: 30px;
        width: 30px;
    }

    #start-date,
    #end-date {
        width: 110px;
        /* border-radius: 5px */

    }

    #error-append {
        font-size: 8px;
        color: red;
        font-weight: bold;
    }
</style>
<script>
    var primaryGround = "white"
    $('#light-toggler').click(function() {
        if (primaryGround == "white") {
            primaryGround = "rgb(0,0,0,0.8)"
            $(".top-chart-chart-container, .chart-container").css("background-color", "rgb(10,10,20,0.8)");
            document.getElementById('light-toggler').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-brightness-high" viewBox="0 0 16 16">
                    <path
                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                </svg>`
        } else {
            primaryGround = "white"
            $(".top-chart-chart-container , .chart-container").css("background-color", "white");
            document.getElementById('light-toggler').innerHTML = `
                
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
  <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
</svg>
            `
        }

        $("body").css("background-color", primaryGround);
    })



    // On donne par defaut un interval de date dans lequel on va afficher les données dans les grapqhes
    // Pour notre cas on décide de prendre pour intervall la semaine courante
    var start = moment().startOf('week')
    var end = moment().endOf('week')
    $("#start-date").val(start.format('YYYY-MM-DD'))
    $("#end-date").val(end.format('YYYY-MM-DD'))

    // Function pour afficher l'état des données apres la requete.
    // S'il y a aucune donnée, il n'y a aucun contenu dans les affichages
    // Ainsi donc on affiche des messages d'erreur sur l'écran pour interpelller l'utilisateur
    function displayError(response) {
        error = document.getElementById("error-append")
        if (response.length > 0) {
            error.innerHTML = ``
            // $('.dashboard-main-container').css('margin-top', 60);
        } else {
            // $('.dashboard-main-container').css('margin-top', 70);
            error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" fill="currentColor"
                class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 
                0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 
                0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg> Aucune donnée disponible à ces dates ou intervalle erroné !
                `
        }
    }

    // Première vérification d'erreur : vérifier dès le lancement de le la fenètre
    $.ajax({
        type: "GET",
        url: "{{ route('dashboard') }}",
        data: {
            'start': start.format('YYYY-MM-DD'),
            'end': end.format('YYYY-MM-DD')
        },
        success: function(response) {
            displayError(response)
        },
    });

    // Deuxième vérification d'erreur : vérifier durant les changement dans l'intervalle des dates
    $("#default-date-range-select, #end-date, #start-date").change(async function() {
        let rangeType = $("#default-date-range-select").val()

        // Les conditions ici sont
        // - Si on choisi autre type d'intervalle qu'un intervalle personnalisé alors tous les autres paramètres sur les dates sont vérouillés
        // et on affiche les graphes comme l'intervalle le laisse voir
        // - Dans le cas contraire ( si on choisi un intervalle personnalisé ),
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
                case "this-month":
                    start = moment().startOf('month')
                    end = moment().endOf('month')
                    break
                case "last-month":
                    start = moment().subtract(1, 'month').startOf('month')
                    end = moment().subtract(1, 'month').endOf('month')
                    break
                default:
                    break
            }
            $('#start-date').val(start.format("YYYY-MM-DD"))
            $('#end-date').val(end.format("YYYY-MM-DD"))
        }
        $.ajax({
            type: "GET",
            url: "{{ route('dashboard') }}",
            data: {
                'start': $('#start-date').val(),
                'end': $('#end-date').val()
            },
            success: function(response) {
                displayError(response)
            },
        });
    })
</script>
