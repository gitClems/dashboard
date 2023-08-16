<nav class="navbar navbar-dark bg-dark fixed-top" style="height: 70px">
    <div class="container-fluid" style=" height : 100%">
        <div class="navbar-brand">Express relai</div>
        <div style=" height : 100%">
            <select name="" id="date-range-select">
                {{-- <option value="all">All</option> --}}
                <option value="this-week">Semaine courante</option>
                <option value="last-week">Semaine passée</option>
                <option value="this-month">Mois courant</option>
                <option value="last-month">Mois passé</option>
                <option value="custom-range">Personnalisé</option>
            </select>
            <input type="date" name="end" id="start-date" min="{{ $min }}" @disabled(true)>
            <input type="date" name="start" id="end-date" max="{{ $max }}" @disabled(true)>
            {{-- <button id="reset-date-range" @disabled(true)>Reset date</button> --}}
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
    #error-append{
        font-size : 8px;
        color: orange;
        font-weight: bold;
    }
    /* #date-range-select{
    } */
</style>
<script>
    var start = moment().startOf('week')
    var end = moment().endOf('week')
    $("#start-date").val(start.format('YYYY-MM-DD'))
    $("#end-date").val(end.format('YYYY-MM-DD'))

    function displayError(response) {
        if (response.length > 0) {
            error = document.getElementById("error-append")
            error.innerHTML = ``
        } else {
            error = document.getElementById("error-append")
            error.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 
                0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>Aucune donnée disponible ou intervalle erroné !`
        }
    }

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


    $("#date-range-select").change(async function() {
        let rangeType = $(this).val()
        if (rangeType != 'custom-range') {
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
                    displayError(response)
                },
                error: function(error) {
                    alert("Oups ! Something went wrong")
                }
            });
        }
    })

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
                displayError(response)
            },
        });
    })
</script>
