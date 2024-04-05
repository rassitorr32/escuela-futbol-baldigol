$(function() {

    enableDrag();
    function enableDrag(){
        $('#external-events .fc-event').each(function() {
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }

    $(".save-event").on('click', function() {
        var categoryName = $('#addNewEvent form').find("input[name='category-name']").val();
        var categoryColor = $('#addNewEvent form').find("select[name='category-color']").val();
        if (categoryName !== null && categoryName.length != 0) {
            $('#event-list').append('<div class="fc-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '">' + categoryName + '</div>');
            $('#addNewEvent form').find("input[name='category-name']").val("");
            $('#addNewEvent form').find("select[name='category-color']").val("");
            enableDrag();
        }
    });



    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) { dd = '0'+dd }
    if(mm<10) { mm = '0'+mm } 

    var current = yyyy + '-' + mm + '-';
    var calendar = $('#calendar');



    // Add direct event to calendar

    var newEvent = function(start) {
        $('#addDirectEvent input[name="event-name"]').val("");
        $('#addDirectEvent select[name="event-bg"]').val("");
        $('#addDirectEvent').modal('show');
        $('#addDirectEvent .save-btn').unbind();
        $('#addDirectEvent .save-btn').on('click', function() {
            var title = $('#addDirectEvent input[name="event-name"]').val();
            var classes = 'bg-'+ $('#addDirectEvent select[name="event-bg"]').val();

            if (title) {

                var eventData = {
                    title: title,
                    start: start,
                    className: classes
                };

                calendar.fullCalendar('renderEvent', eventData, true);
                $('#addDirectEvent').modal('hide');
                }

            else {
                alert("Title can't be blank. Please try again.")
            }
        });
    }
  

    // initialize the calendar
    calendar.fullCalendar({

        header: {
            left: 'title',
            center: '',
            right: 'month, agendaWeek, agendaDay, prev, next'
        },
        defaultView: 'month', // Establecemos la vista predeterminada como 'month'
        views: {
            month: {
                // Configuramos para mostrar tres meses a la vez
                duration: { months: 3 },
                // Especificamos el número de columnas (meses) en la vista
                // Esto hace que se muestren tres meses a la vez
                columnFormat: 'ddd'
            }
        },

        editable: true,
        droppable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: 'calendario/getCalendario/', // Aquí debes colocar la URL de tu servidor donde se encuentran los datos de los eventos
                dataType: 'json',
                data: {
                    // Puedes enviar datos adicionales si es necesario, como fechas de inicio y fin
                    start: start.format(),
                    end: end.format()
                },
                success: function(response) {
                    var events = [];
                    // Iterar sobre los eventos devueltos por el servidor y formatearlos adecuadamente
                    for (var i = 0; i < response.length; i++) {
                        events.push({
                            title: response[i].title,
                            start: response[i].start, // Asegúrate de que los datos sean compatibles con el formato esperado por FullCalendar
                            end: response[i].end,
                            className: response[i].className
                        });
                    }
                    callback(events);
                }
            });
        },
        

        drop: function(date,jsEvent) {

        // var originalEventObject = $(this).data('eventObject');
        // var $categoryClass = $(this).attr('data-class');
        // var copiedEventObject = $.extend({}, originalEventObject);
        // //console.log(originalEventObject + '--' + $categoryClass + '---' + copiedEventObject);
        // copiedEventObject.start = date;
        // if ($categoryClass)
        //   copiedEventObject['className'] = [$categoryClass];
        // calendar.fullCalendar('renderEvent', copiedEventObject, true);
        // is the "remove after drop" checkbox checked?

        if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },

        select: function(start, end, allDay) { 
            newEvent(start);
        },

        eventClick: function(calEvent, jsEvent, view) {
            //var title = prompt('Event Title:', calEvent.title, { buttons: { Ok: true, Cancel: false} });

            var eventModal = $('#eventEditModal');
            eventModal.modal('show');
            eventModal.find('input[name="event-name"]').val(calEvent.title);

            eventModal.find('.save-btn').click(function(){
                calEvent.title = eventModal.find("input[name='event-name']").val();
                calendar.fullCalendar('updateEvent', calEvent);
                eventModal.modal('hide');
            });

            // if (title){
            //     calEvent.title = title;
            //     calendar.fullCalendar('updateEvent',calEvent);
            // }
        }
    });
});