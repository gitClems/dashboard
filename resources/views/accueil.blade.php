<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard </title>
    <script src="components/main.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.3/dist/chart.umd.min.js"></script>
    <x-packages></x-packages>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        .top-level {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            width: 100%;
        }

        .top-chart-chart-container {
            background-color: white;
            box-shadow: 1px 1px 20px rgba(128, 128, 128, 0.2);
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            font-family: 'Roboto', sans-serif;
            flex: 1;
            max-width: 100%;
            min-width: 49%;
            margin: 5px;
        }

        .middle-chart-container {
            background-color: white;
            box-shadow: 1px 1px 20px rgba(128, 128, 128, 0.5);
            margin: 5px;
            border-radius: 5px;
            /* height: 300px; */
            flex: 1 ;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }


        .middle-level {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            margin-top: 10px;
            border-top: 2px solid grey;
            padding-top: 10px;
        }

        #expedition-global-chart {
            max-height: 400px;
        }

        @media only screen and (max-width: 600px) {
            #expedition-global-chart {
                max-height: 350px;
            }
        }

        .dashboard-main-container {
            width: 100%;
            margin-top: 50px;
        }
    </style>
</head>

<body id="body-pd">
    <x-app_bar></x-app_bar>
    <main class="dashboard-main-container">
        <div class="page-icon">
            <x-page_titre></x-page_titre>
        </div>
        <div class="screen-chiffre">
            <x-affichage_chiffre></x-affichage_chiffre>
        </div>
        <div class="top-level">
            <x-expedition_vue_globale></x-expedition_vue_globale>
            {{-- <x-affaire></x-affaire> --}}
        </div>

        <div class="middle-level">
            <x-type_expedition></x-type_expedition>
            <x-achat_packs></x-achat_packs>
            <x-conversion_clientele></x-conversion_clientele>
        </div>

        <div>
            <x-up_scroll></x-up_scroll>
        </div>
    </main>
</body>

</html>
