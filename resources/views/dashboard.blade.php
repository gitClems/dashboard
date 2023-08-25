<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Dashboard </title>
    <x-packages></x-packages>
    <link rel="stylesheet" href="css/dashboard.css">

    <style>
        .top-level {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            /* margin-top: 80px; */
            width: 100%
        }

        .top-chart-setting {
            display: flex;
            justify-content: space-evenly
        }

        .top-chart-chart-container {
            /* box-shadow: 1px 1px 1px rgba(128, 128, 128, 0.347); */
            background-color: white;
            width: 49.50%;
            border-radius: 5px;
            min-width: 400px;
            max-width: 700px;
        }

        .middle-chart-container {
            box-shadow: 1px 1px 1px rgba(128, 128, 128, 0.347);
            /* width: 32%; */
            /* height: 100%; */
            height: 200px;
            border-radius: 5px;
            min-width: 100px;
            /* max-width: 700px; */
        }

        .dashboard-main-container {
            width: 100%;
            background-color: rgba(128, 128, 128, 0.2);
            padding: 5px
        }

        #header {
            background-color: white;
            box-shadow: 1px 1px 1px rgba(128, 128, 128, 0.347);
        }
    </style>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        {{-- <div> --}}
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
        </div>

        <a href="{{ route('dashboard') }}" class="nav_logo">
            <div class="dashboard-logo"></div>
        </a>
        {{-- </div> --}}
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                {{-- <a href="{{ route('dashboard') }}" class="nav_logo">
                    <div>
                        <div class="dashboard-logo"></div>
                        {{-- <span class="nav_logo-name">Express Relais</span> 
                    </div>
                </a> --}}
                <div class="nav_list">
                    <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span
                            class="nav_name">Dashboard</span> </a>
                    <a href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                            class="nav_name">Users</span> </a> <a href="#" class="nav_link"> <i
                            class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span>
                    </a> <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span
                            class="nav_name">Bookmark</span> </a> <a href="#" class="nav_link"> <i
                            class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> <a
                        href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>
                </div>
            </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
        </nav>

    </div>

    <main class="dashboard-main-container">
        <div class="top-level">
            @component('components.expedition_vue_globale')
            @endcomponent
            @component('components.affaire')
            @endcomponent
        </div>
        <div style="display: flex; justify-content : space-evenly ; margin-top : 10px">
            @component('components.type_expedition')
            @endcomponent
            @component('components.achat_packs')
            @endcomponent
        </div>
    </main>

    <!--Container Main end-->
    <script src="js/dashboard.js"></script>
    <script>
        var start = moment().startOf('week')
        var end = moment().endOf('week')
        $("#start-date").val(start.format('YYYY-MM-DD'))
        $("#end-date").val(end.format('YYYY-MM-DD'))

        $("#default-date-range-select, #end-date, #start-date").change(async function() {
            let rangeType = $("#default-date-range-select").val()

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
        })
    </script>
</body>


</html>
