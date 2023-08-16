<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Dashboard </title>
    <x-packages></x-packages>
    <style>
        html {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-weight: 100;
        }

        .chart-container {
            box-shadow: 1px 1px 5px rgba(128, 128, 128, 0.347);
            padding: 15px;
            border-radius: 15px;
        }

        .top-chart {
            width: 500px;
        }

        .top-level {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        main {
            display: flex;
            flex-direction: column;
        }

        .middle-chart {
            width: 30vh;
        }
    </style>
</head>

<body>
    <x-app_bar min="{{ $min }}" max="{{ $max }}"></x-app_bar>
    <main style="width: 100%; display : flex; justify-content:space-around; margin-top:60px">
        <div class="top-level">
            @component('components.expedition_vue_globale', ['min' => $min, 'max' => $max])
            @endcomponent

            @component('components.affaire', ['min' => $min, 'max' => $max, 'result' => $result])
            @endcomponent
        </div>
        <div style="display: flex; justify-content : space-evenly ; margin-top : 50px">
            @component('components.type_expedition', [
                'min' => $min,
                'max' => $max,
                'typeExpedition' => $typeExpedition,
                'result' => $result,
            ])
            @endcomponent
            @component('components.achat_packs', [
                'min' => $min,
                'max' => $max,
                'typeExpedition' => $typeExpedition,
                'result' => $result,
            ])
            @endcomponent
        </div>
    </main>
</body>

</html>
