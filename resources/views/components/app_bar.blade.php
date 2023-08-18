<nav class="navbar navbar-dark bg-dark fixed-top" style="height: 70px">
    <div class="container-fluid" style=" height : 100%">
        <div class="navbar-brand">Express relai</div>
        <div style=" height : 100%">
            <select name="" id="date-range-select">
                <option value="this-week">Semaine courante</option>
                <option value="last-week">Semaine passée</option>
                <option value="this-month">Mois courant</option>
                <option value="last-month">Mois passé</option>
                <option value="custom-range">Personnalisé</option>
            </select>
            <input type="date" name="end" id="start-date" min="{{ $min }}" @disabled(true)>
            <input type="date" name="start" id="end-date" max="{{ $max }}" @disabled(true)>
            <div>
                <span id="error-append" style='font-size : 10px'></span>
            </div>
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
                        <a class="nav-link active" aria-current="page" href="#client">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#chiffre">Chiffre d'affaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>
    #start-date,
    #end-date {
        width: 110px;
        border-radius: 5px
    }

    #error-append {
        font-size: 8px;
        color: orange;
        font-weight: bold;
    }
</style>
<script>
    // On donne par defaut un interval de date dans lequel on va afficher les données dans les grapqhes
    // Pour notre cas on décide de prendre pour intervall la semaine courante
    var start = moment().startOf('week').format('YYYY-MM-DD')
    var end = moment().endOf('week').format('YYYY-MM-DD')
    $("#start-date").val(start)
    $("#end-date").val(end)

    // Function pour afficher l'état des données apres la requete.
    // S'il y a aucune donnée, il n'y a aucun contenu dans les affichages
    // Ainsi donc on affiche des messages d'erreur sur l'écran pour interpelller l'utilisateur
    function displayError(response) {
        error = document.getElementById("error-append")
        if (response.length > 0) {
            error.innerHTML = ``
        } else {
            error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 
                0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 
                0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                Aucune donnée disponible ou intervalle erroné !`
        }
    }

    // Première vérification d'erreur : vérifier dès le lancement de le la fenètre
    $.ajax({
        type: "GET",
        url: "{{ route('dashboard') }}",
        data: {
            'start': start,
            'end': end
        },
        success: function(response) {
            displayError(response)
        },
    });

    // Deuxième vérification d'erreur : vérifier durant les changement dans l'intervalle des dates
    $("#date-range-select, #end-date, #start-date").change(async function() {
        let rangeType = $("#date-range-select").val()

        // Les conditions ici sont
        // - Si on choisi autre type d'intervalle qu'un intervalle personnalisé alors tous les autres paramètres sur les dates sont vérouillés
        // et on affaiche les graphes comme l'intervalle le laisse voir
        // - Dans le cas contraire si on choisi un intervalle personnalisé,
        // on déverouille les paramètres sur les dates et on laisse le libre choix à l'utilisateur d'introduire les dates comme il le veut

        if (rangeType == 'custom-range') {
            document.getElementById("start-date").disabled = false
            document.getElementById("end-date").disabled = false
            start = $('#start-date').val()
            end = $('#end-date').val()
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
            start = start.format("YYYY-MM-DD")
            end = end.format("YYYY-MM-DD")
        }
        $('#start-date').val(start)
        $('#end-date').val(end)
        $.ajax({
            type: "GET",
            url: "{{ route('dashboard') }}",
            data: {
                'start': start,
                'end': end,
            },
            success: function(response) {
                displayError(response)
            },
            error: function(error) {
                alert("Oups ! Something went wrong")
            }
        });
    })
</script>
