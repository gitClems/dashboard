import expeditionGlobalChart from "./expedition-globale.js";
import chiffreAffaireGlobalChart from "./chiffre-affaire-globale.js";
import typeExpeditionGlobalChart from "./type-expedition.js";
import achatPacksGlobalChart from "./achat-pack-expedition.js";
import getError from "./error.js";
import convertionClient from "./convertion-client.js";
export var start = moment().startOf('week')
export var end = moment().endOf('week');

$(function () {
    // console.log(start.format("YYYY-MM-DD"));
    // console.log(end.format("YYYY-MM-DD"));
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // getError(start, end)
        // expeditionGlobalChart(start, end)
        // chiffreAffaireGlobalChart(start, end)
        // typeExpeditionGlobalChart(start, end)
        // achatPacksGlobalChart(start, end)
        // convertionClient(start,end)
    }
    $('#reportrange').daterangepicker({
        language: "fr",
        startDate: start,
        endDate: end,
        ranges: {
            'Semaine en cours': [moment().startOf('week'), moment().endOf('week')],
            'Semaine passée': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'Mois en cours': [moment().startOf('month'), moment().endOf('month')],
            'Mois passé': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        }
    }, cb);
    cb(start, end);
});

