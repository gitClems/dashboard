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
            width: 98vh;
            box-shadow: 1px 1px 5px rgba(128, 128, 128, 0.347);
            margin: 15px
        }

        .chart-type-expedition-container {
            width: 30vh;
            box-shadow: 1px 1px 5px rgba(128, 128, 128, 0.347);
            margin: 15px
        }

        main {
            display: flex;
            flex-wrap: wrap
        }
    </style>
</head>

<body>
    <x-app_bar min="{{ $min }}" max="{{ $max }}"></x-app_bar>
    <main style="width: 100%; display : flex; justify-content:space-around; margin-top:60px">
        @component('components.expedition_vue_globale', ['min' => $min, 'max' => $max, 'result' => $result])
        @endcomponent

        @component('components.affaire', ['min' => $min, 'max' => $max, 'result' => $result])
        @endcomponent

        @component('components.type_expedition', [
            'min' => $min,
            'max' => $max,
            'typeExpedition' => $typeExpedition,
            'result' => $result,
        ])
        @endcomponent
    </main>
</body>

</html>