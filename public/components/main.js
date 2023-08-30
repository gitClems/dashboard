import achatPacksGlobalChart from "./achat-pack-expedition.js";
import chiffreAffaireGlobalChart from "./chiffre-affaire-globale.js";
import convertionClient from "./convertion-client.js";
import expeditionGlobalChart from "./expedition-globale.js";
import typeExpeditionGlobalChart from "./type-expedition.js";
export var start = moment().startOf('week')
export var end = moment().endOf('week');


$(document).ready(function () {
    //initialiser pour envoyer au controleur son probleme           
    let start;
    let end;
    //pour definir l'intervalle initial
    const selectActiveRangeButton = function (selectedDates, pluginData) {
        let isPredefinedRange = false;
        pluginData.rangesNav.find('.active').removeClass('active');
        if (selectedDates.length > 0) {
            let start = moment(selectedDates[0]);
            let end = selectedDates.length > 1 ? moment(selectedDates[1]) : start;
            for (const [label, range] of Object.entries(predefinedRanges)) {
                if (start.isSame(range[0], 'day') && end.isSame(range[1], 'day')) {
                    pluginData.rangesButtons[label].addClass('active');
                    isPredefinedRange = true;
                    break;
                }
            }
        } else if (pluginData.rangesOnly) {
            $(fp.calendarContainer).addClass('flatpickr-predefined-ranges-only');
        }
    };
    var predefinedRanges
    const today = new Date();
    const startOfWeek = new Date(today);
    startOfWeek.setDate(today.getDate() - today.getDay()); // Début de la semaine (dimanche)
    const endOfWeek = new Date(today);
    endOfWeek.setDate(today.getDate() + (6 - today.getDay())); // Fin de la semaine (samedi)
    //---------------->
    //fonction du filtre flatpickr
    flatpickr("#dateRangeInput", {
        mode: 'range',
        altInput: true,
        // altFormat: "F j, Y",
        altFormat: "d M , Y",
        dateFormat: "Y-m-d",
        defaultDate: [startOfWeek, endOfWeek],
        //methode ou on vas gerer les predifined ranges
        onReady: function (selectedDates, dateStr, instance) {
            predefinedRanges = {
                "Aujourd'hui": [new Date(), new Date()],
                "Semaine courante": [moment().startOf('week').toDate(), moment().endOf('week').toDate()],
                "Semaine passée": [moment().subtract(1, 'week').startOf('week').toDate(), moment().subtract(1, 'week').endOf('week').toDate()],
                "Les 30 derniers jours": [moment().subtract(29, 'days').toDate(), new Date()],
                "Mois courant": [moment().startOf('month').toDate(), moment().endOf('month').toDate()],
                "Mois passé": [moment().subtract(1, 'month').startOf('month').toDate(), moment().subtract(1, 'month').endOf('month').toDate()],
                "Année courante": [moment().startOf('year').toDate(), moment().endOf('year').toDate()],
                "Année Passée": [moment().subtract(1, 'year').startOf('year').toDate(), moment().subtract(1, 'year').endOf('year').toDate()],
            };
            const pluginData = {
                rangesNav: $('<ul>').addClass('nav flex-column flatpickr-predefined-ranges'),
                rangesButtons: {}
            };
            for (const [label, range] of Object.entries(predefinedRanges)) {
                pluginData.rangesButtons[label] = $('<button>')
                    .addClass('nav-link btn btn-link')
                    .attr('type', 'button')
                    .text(label)
                    .on('click', function () {
                        $(this).blur();
                        instance.setDate(range, true);
                        instance.close();
                    });
                pluginData.rangesNav.append(
                    $('<li>').addClass('nav-item d-grid').append(pluginData.rangesButtons[
                        label])
                );
            }
            if (pluginData.rangesNav.children().length > 0) {
                $(instance.calendarContainer).prepend(pluginData.rangesNav);
                $(instance.calendarContainer).addClass('flatpickr-has-predefined-ranges');
                // make sure the right range button is active for the default value
                selectActiveRangeButton(selectedDates, pluginData);
            }
        },
        //methode ou on vas gerer le filtrage et le changement 
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                start = selectedDates[0];
                end = selectedDates.length > 1 ? selectedDates[1] : moment(start).subtract(1, 'day');
                end.setHours(23, 59, 59);
                try {
                    expeditionGlobalChart(start, end)
                    chiffreAffaireGlobalChart(start, end)
                    typeExpeditionGlobalChart(start, end)
                    achatPacksGlobalChart(start, end)
                    convertionClient(start, end)
                } catch (error) {
                    console.log(error.message);
                }
            }
        },
    });
})