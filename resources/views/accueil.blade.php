<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-packages></x-packages>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.3/dist/chart.umd.min.js"></script>
</head>
<style>
    .top-level {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        margin-top: 10px;
        margin-top: 75px;
        width: 100%
    }

    .top-chart-setting {
        display: flex;
        justify-content: space-evenly
    }

    .top-chart-chart-container {
        box-shadow: 1px 1px 5px rgba(128, 128, 128, 0.347);
        width: 49vw;
        border-radius: 15px;
        min-width: 400px;
        max-width: 700px;
    }
</style>

<body>
    <x-app_bar min="{{ $min }}" max="{{ $max }}"></x-app_bar>
    <main class="main-container">
        <div class="top-level">
            <div class="top-chart-chart-container">
                <canvas id="expedition-global-chart" class="top-chart expedition-global-chart"></canvas>
                <div class="top-chart-setting">
                    <div>
                        <label for="type-line">Courbe</label>
                        <input type="radio" class="expedition-global-chart-type" name="expedition-global-chart-type"
                            id="type-line" value='line' checked>
                    </div>
                    <div>
                        <label for="type-bar">Histogramme</label>
                        <input type="radio" class="expedition-global-chart-type" name="expedition-global-chart-type"
                            id="type-bar" value='bar'>
                    </div>
                </div>
            </div>

            <div class="top-chart-chart-container">
                <canvas id="chiffre-affaire-global-chart" class="top-chart chiffre-affaire-global-chart"></canvas>
                <div class="top-chart-setting">
                    <div>
                        <label for="type-line">Courbe</label>
                        <input type="radio" class="chiffre-affaire-global-chart-type"
                            name="chiffre-affaire-global-chart-type" id="type-line" value='line' checked>
                    </div>

                    <div>

                        <label for="type-bar">Histogramme</label>
                        <input type="radio" class="chiffre-affaire-global-chart-type"
                            name="chiffre-affaire-global-chart-type" id="type-bar" value='bar'>
                    </div>
                </div>
            </div>

        </div>

        <div style="display: flex; justify-content : space-evenly ; margin-top : 10px">
            
            <div class="chart-container">
                <canvas id="type-expedition-chart" class="middle-chart"></canvas>
            </div>

            <div class="chart-container">
                <canvas id="achat-packs-chart" class="middle-chart"></canvas>
            </div>
        </div>
        <script src="js/main.js" type="module"></script>
    </main>
</body>

</html>
