<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <link rel="stylesheet" href="css/date_range.css">
    <x-packages></x-packages>
    <title>TEST</title>
</head>

<body>
    <div style="display: flex; justify-content : center; align-items : center;">
        <!-- input du filtre  -->
        <div class="filter-container">
            <input type="text" id="dateRangeInput">
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate
                        the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script src="components/main.js" type="module"></script>
    </div>
</body>
<style>
    .accordion-button,
    .accordion-body {
        width: 200px !important;
    }

    .accordion-body {
        overflow-y: scroll;
        max-height: 200px
    }
</style>

</html>
