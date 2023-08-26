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
        .top-level {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-evenly; */
            width: 100%;
        }

        .top-chart-chart-container {
            /* box-shadow: 1px 1px 1px rgba(128, 128, 128, 0.347); */
            background-color: white;
            border-radius: 5px;
            width: 49%;
            min-width: 400px;
            max-width: 90%;
            margin: 5px;
        }

        .middle-chart-container {
            /* box-shadow: 1px 1px 5px rgba(128, 128, 128, 0.347); */
            background-color: white;
            margin: 5px;
            border-radius: 5px;
            height: 200px;
            width: 200px;
            border-radius: 15px;
            /* min-width: 100px; */
        }

        .dashboard-main-container {
            width: 100%;
            /* background-color: rgba(128, 128, 128, 0.2); */
            /* padding: 5px */
        }

        .middle-level {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-evenly; */
            margin-top: 10px;
            border-top: 2px solid grey;
            padding-top: 10px;
        }
    </style>
</head>

<body id="body-pd">
    <x-app_bar1></x-app_bar1>
    <main class="dashboard-main-container">
        <div class="top-level">
            <div class="top-chart-chart-container">
                <div style="width: 100%; display : flex; justify-content : center">
                    Les expéditions et le chiffres d'affaire
                </div>
                <canvas id="expedition-global-chart" class="top-chart expedition-global-chart"></canvas>
            </div>
            <div class="top-chart-chart-container">
                <canvas id="chiffre-affaire-global-chart" class="top-chart chiffre-affaire-global-chart"></canvas>
            </div>
        </div>

        <div class="middle-level">
            <div class="middle-chart-container">
                <canvas id="type-expedition-chart" class="middle-chart"></canvas>
            </div>
            <div class="middle-chart-container">
                <canvas id="achat-packs-chart" class="middle-chart"></canvas>
            </div>
            <div class="middle-chart-container">
                <canvas id="convertion-client-chart" class="middle-chart"></canvas>
            </div>
        </div>
    </main>
</body>

</html>
