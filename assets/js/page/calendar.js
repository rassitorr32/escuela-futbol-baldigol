$(function () {



    enableDrag();
    function enableDrag() {
        $('#external-events .fc-event').each(function () {
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

    $(".save-event").on('click', function () {
        var categoryName = $('#addNewEvent form').find("input[name='category-name']").val();
        var categoryColor = $('#addNewEvent form').find("select[name='category-color']").val();
        if (categoryName !== null && categoryName.length != 0) {
            $('#event-list').append('<div class="fc-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '">' + categoryName + '</div>');
            $('#addNewEvent form').find("input[name='category-name']").val("");
            $('#addNewEvent form').find("select[name='category-color']").val("");
            enableDrag();
        }
    });

    // Agregar evento para eliminar eventos del calendario
    $("-delte-btn").on('click', function () {
        var eventId = $(this).data('event-id'); // Obtener el ID del evento desde el atributo data-event-id
        var calEvent = calendar.fullCalendar('clientEvents', eventId); // Buscar el evento en el calendario
        if (calEvent.length > 0) {
            calendar.fullCalendar('removeEvents', eventId); // Eliminar el evento del calendario
            // Aquí puedes enviar el ID del evento al servidor para eliminarlo de la base de datos por AJAX
            // $.ajax({
            //     type: "POST",
            //     url: 'calendario/delete', // URL para eliminar el evento
            //     data: { eventId: eventId }, // Datos adicionales para identificar el evento
            //     success: function (response) {
            //         console.log('Evento eliminado exitosamente:', response);
            //     },
            //     error: function (xhr, status, error) {
            //         console.error('Error al eliminar el evento:', error);
            //     }
            // });
        }
    });



    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) { dd = '0' + dd }
    if (mm < 10) { mm = '0' + mm }

    var current = yyyy + '-' + mm + '-';
    var calendar = $('#calendar');



    // Add direct event to calendar

    var newEvent = function (start) {
        $('#addDirectEvent input[name="event-name"]').val("");
        $('#addDirectEvent select[name="event-bg"]').val("");
        $('#addDirectEvent input[name="event-fechaFin"]').val(start.format('YYYY-MM-DD'));
        $('#addDirectEvent').modal('show');
        $('#addDirectEvent .save-btn').unbind();
        $('#addDirectEvent .save-btn').on('click', function () {
            var title = $('#addDirectEvent input[name="event-name"]').val();
            var classes = 'bg-' + $('#addDirectEvent select[name="event-bg"]').val();

            var hora_inicio = $('#addDirectEvent input[name="event-horaInicio"]').val();
            var hora_final = $('#addDirectEvent input[name="event-horaFin"]').val();
            var fecha_fin = $('#addDirectEvent input[name="event-fechaFin"]').val();

            var allDay;
            if ($('#addDirectEvent input[name="event-checkAllDay"]').is(':checked')) {
                allDay = true
            } else {
                allDay = false
            }

            if (title) {

                // Analizar la cadena de texto utilizando Moment.js
                var fechaInicio = moment(start.format('YYYY-MM-DD') + ' ' + hora_inicio + ':00', "YYYY-MM-DD HH:mm:ss");
                var fechaFinal = moment(fecha_fin + ' ' + hora_final + ':00', "YYYY-MM-DD HH:mm:ss");

                if (allDay == true) {
                    fechaInicio.startOf('day');
                    fechaFinal.startOf('day');
                }
                var eventData = {
                    title: title,
                    start: fechaInicio,
                    end: fechaFinal,
                    allDay: allDay,
                    className: classes
                };

                // Llamar a la función guardarEvento con una devolución de llamada
                guardarEvento(eventData, function (resultado) {
                    if (resultado) {
                        eventData.id = resultado;
                        console.log(resultado)
                        // Operación AJAX exitosa
                        calendar.fullCalendar('renderEvent', eventData, true);
                        $('#addDirectEvent').modal('hide');
                        console.log('El evento se guardó exitosamente.');
                    } else {
                        // Error en la operación AJAX
                        console.log('Error al guardar el evento.');
                    }
                });
                console.log(hora_final)
            }

            else {
                alert("Title can't be blank. Please try again.")
            }
        });
    }



    var eventoPrevio;

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
        // eventResizable: true,
        //CARGAR DE LA BASE DE DATOS POR GET
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: 'calendario/getCalendario/', // Aquí debes colocar la URL de tu servidor donde se encuentran los datos de los eventos
                dataType: 'json',
                data: {
                    // Puedes enviar datos adicionales si es necesario, como fechas de inicio y fin
                    start: start.format(),
                    end: end.format()
                },
                success: function (response) {
                    var events = [];
                    // Iterar sobre los eventos devueltos por el servidor y formatearlos adecuadamente
                    for (var i = 0; i < response.length; i++) {
                        var fechaI = moment(response[i].inicio, 'YYYY-MM-DD HH:mm:ss');
                        var fechaF = moment(response[i].fin, 'YYYY-MM-DD HH:mm:ss');
                        var inicio = moment(start).year(fechaI.year()).month(fechaI.month()).date(fechaI.date()).hour(fechaI.hours()).minute(fechaI.minutes());
                        var final = moment(end).year(fechaF.year()).month(fechaF.month()).date(fechaF.date()).hour(fechaF.hours()).minute(fechaF.minutes());
                        if (response[i].allDay == 1) {
                            inicio.startOf('day');
                            final.startOf('day');
                        }
                        events.push({
                            id: response[i].id_calendario,
                            title: response[i].titulo,
                            start: fechaI, // Asegúrate de que los datos sean compatibles con el formato esperado por FullCalendar
                            end: fechaF,
                            allDay: (response[i].allDay == 1) ? true : false,
                            className: response[i].className,
                        });
                        console.log(response[i].allDay)
                    }
                    callback(events);
                }
            });
        },

        drop: function (date, jsEvent) {

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

        select: function (start, end, allDay) {
            newEvent(start);
        },
        ////EVENTO PARA EDITAR
        eventClick: function (calEvent, jsEvent, view) {
            //var title = prompt('Event Title:', calEvent.title, { buttons: { Ok: true, Cancel: false} });
            //sE RECUPERA LOS DATOS EN EL FORM
            var eventModal = $('#eventEditModal');
            eventModal.modal('show');
            eventModal.find('input[name="event-id"]').val(calEvent.id);
            eventModal.find('input[name="event-name"]').val(calEvent.title);

            // Dividir la cadena por el carácter "-"
            var clasesSeparadas = calEvent.className[0].split("-");
            // Obtener la última parte de las clases separadas
            var claseMostrar = clasesSeparadas[clasesSeparadas.length - 1]
            eventModal.find('select[name="event-bg"]').val(claseMostrar);

            var fechaFin = calEvent.start
            var horaInicio = calEvent.start.format('HH:mm');
            var horaFinal = calEvent.start.format('HH:mm');
            
            if (calEvent.end != null) {
                fechaFin = calEvent.end;
                horaFinal = calEvent.end.format('HH:mm');
            }

            var checkbox = eventModal.find('input[name="event-checkAllDay"]')
            // Obtener el contenedor del checkbox
            var checkboxContainer = checkbox.closest('.col-md-12');
            if (calEvent.allDay == true) {
                checkbox.prop('checked', true);
                // Ocultar los contenedores de fecha y hora
                checkboxContainer.nextAll('.hora-inicio-container, .hora-fin-container').hide();
            } else {
                checkbox.prop('checked', false);
                // Mostrar los contenedores de fecha y hora
                checkboxContainer.nextAll('.hora-inicio-container, .hora-fin-container').show();
            }
            
            eventModal.find('input[name="event-fechaFin"]').val(fechaFin.format('YYYY-MM-DD'));
            eventModal.find('input[name="event-horaInicio"]').val(horaInicio);
            eventModal.find('input[name="event-horaFin"]').val(horaFinal);

            //EVENTO GUARDAR DE EDITAR
            eventModal.find('.save-btn').click(function () {
                calEvent.id = eventModal.find("input[name='event-id']").val();
                calEvent.title = eventModal.find("input[name='event-name']").val();
                // Analizar la cadena de texto utilizando Moment.js
                var fechaHoraInicio = eventModal.find("input[name='event-horaInicio']").val() + ':00';
                var fechaHoraFinal = eventModal.find("input[name='event-horaFin']").val() + ':00';
                var fechaInicio = moment(calEvent.start.format('YYYY-MM-DD')+' '+fechaHoraInicio, "YYYY-MM-DD HH:mm:ss");
                var fechaFin = moment(eventModal.find("input[name='event-fechaFin']").val()+' '+fechaHoraFinal, "YYYY-MM-DD HH:mm:ss");
                console.log(calEvent.start.format('YYYY-MM-DD'))                

                if (eventModal.find("input[name='event-checkAllDay']").is(':checked')) {
                    calEvent.allDay = true
                    //Igualar las horas para q funcione allDay(estirar las fechas)
                    fechaInicio.startOf('day');
                    fechaFin.startOf('day');
                } else {
                    calEvent.allDay = false
                }
                calEvent.start = fechaInicio
                calEvent.end = fechaFin
                calEvent.className[0] = 'bg-' + eventModal.find("select[name='event-bg']").val();
                var event = calEvent;
                // Llamar a la función guardarEvento con una devolución de llamada
                guardarEvento(event, function (resultado) {
                    if (resultado) {
                        // Operación AJAX exitosa
                        calendar.fullCalendar('updateEvent', calEvent);
                        eventModal.modal('hide');
                        console.log('El evento se guardó exitosamente.');
                    } else {
                        // Error en la operación AJAX
                        console.log('Error al guardar el evento.');
                    }
                });

            });
            eventModal.find('.delete-btn').click(function () {
                // Aquí obtén el ID del evento que deseas eliminar
                var eventId = calEvent.id;

                // Elimina el evento del calendario
                calendar.fullCalendar('removeEvents', eventId);

                // Cierra el modal
                eventModal.modal('hide');

                // Envía una solicitud al servidor para eliminar el evento de la base de datos por AJAX
                $.ajax({
                    type: "POST",
                    url: 'calendario/delete/' + eventId,
                    data: { eventId: eventId }, // Envía el ID del evento para identificarlo en el servidor
                    success: function (response) {
                        console.log('Evento eliminado exitosamente:', response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al eliminar el evento:', error);
                    }
                });
            });

            // if (title){
            //     calEvent.title = title;
            //     calendar.fullCalendar('updateEvent',calEvent);
            // }
        },
        eventResizeStart: function (event, jsEvent, ui, view) {
            // Almacena el estado actual del evento antes de redimensionarlo
            eventoPrevio = event;
            console.log(event.start.format())
        },
        //Indica cuando se estira el evento con el puntero hasta que fecha se estiró
        eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {
            var end = event.end.format(); // Obtener la fecha final del evento extendido
            console.log('Fecha final del evento extendido:', end);
            guardarEvento(event);
        },
        eventDrop: function (event, delta, revertFunc) {
            ///***** */ Esta función se llama cuando un evento se arrastra y se suelta en una nueva fecha.

            console.log('Evento movido:', event.title);
            console.log('Fecha anterior:', event.start.format('YYYY-MM-DD HH:mm:ss'));
            guardarEvento(event);
        },


    });

    function guardarEvento(event, callback = null) {
        // Mostrar la información del evento que se movió
        var id = event.id;
        var title = event.title;
        var start = event.start.format('YYYY-MM-DD HH:mm:ss');
        var end = event.start.format('YYYY-MM-DD HH:mm:ss');
        var allDay = event.allDay;
        if (event.end) {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }
        var className = event.className;

        // Aquí puedes enviar una solicitud al servidor para actualizar la fecha del evento en la base de datos.
        var obj = new FormData();
        obj.append('id_calendario', ((typeof id !== 'undefined') ? id : ''));
        obj.append('titulo', title);
        obj.append('inicio', start);
        obj.append('fin', end);
        obj.append('className', className);
        obj.append('allDay', allDay);
        $.ajax({
            type: "POST",
            url: 'calendario/store',
            data: obj,
            cache: false, //vacie el cache
            contentType: false,
            processData: false,
            success: function (response) {
                // Manejar la respuesta del servidor si es necesario
                console.log('Evento modificado exitosamente:', response);
                if (callback !== null) {
                    if ((typeof id === 'undefined'))
                        callback(response); // Llamar a la devolución de llamada con el valor false si está definida
                    else {
                        callback(true);
                    }


                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error al guardar el evento:', error);
                if (callback !== null) {
                    callback(false); // Llamar a la devolución de llamada con el valor false si está definida
                }
            }
        });
    }
});