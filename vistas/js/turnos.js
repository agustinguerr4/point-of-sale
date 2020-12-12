// Configuro los 3 select para que tengan buscadores

$(document).ready(function() {
    $('#new-event').select2({
        placeholder: "Seleccionar cliente"
    });
});

$(document).ready(function() {
    $('#barbero').select2({
        placeholder: "Seleccionar barbero (opcional)"
    });
});

$(document).ready(function() {
    $('#servicio').select2({
        placeholder: "Seleccionar servicio (opcional)"
    });
});

$(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
        ele.each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end

            var eventObject = {
                title: $.trim($(this).text()), // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            })

        })
    }
    
    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    
    var d = date.getDate();
    var m = date.getMonth() + 1;
    var y = date.getFullYear();

    // Si el mes es menor a 10 pero el dia no
    if (m < 10 && d >= 10) {
        var hoy = y + "-0" + m + "-" + d;
        
    // Si el dia es menor a 10 pero el año no    
    } else if (d < 10 && m >= 10) {
        var hoy = y + "-" + m + "-0" + d;

    // Si ambos son menores a 10    
    } else if (m < 10 && d < 10) {
        var hoy = y + "-0" + m + "-0" + d;

    // Si ambos son mayores a 10    
    } else {
        var hoy = y + "-" + m + "-" + d;
    }

    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    var containerEl = document.getElementById('external-events');
    var calendarEl = document.getElementById('calendar');
    var calendarEl2 = document.getElementById('calendar2');

    // initialize the external events
    // -----------------------------------------------------------------
    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
        //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function(e) {
        e.preventDefault()
            //Save color
        currColor = $(this).css('color')
            //Add color effect to button
        $('#add-new-event').css({
            'background-color': currColor,
            'border-color': currColor
        })
    })

    $('#add-new-event').click(function(e) {
        e.preventDefault()
            //Get value and make sure it is not null
        var val = $('#new-event').val();
        if (val.length == 0) {
            return
        }

        //Create events
        var event = $('<div />')

        event.css({
            'font-weight': 300,
            'background-color': currColor,
            'border-color': currColor,
            'color': '#fff'
        }).addClass('external-event')
        event.html(val)

        $('#external-events').prepend(event)

        //Add draggable funtionality
        ini_events(event)

        //Remove event from text input
        $('#new-event').val('')

    })
    
    new FullCalendarInteraction.Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
            if (!$("#barbero").children(".opcion-barbero:selected").html()) {
                var barbero = ""
            } else {
                var barbero = $("#barbero").children(".opcion-barbero:selected").html()
            }

            var servicio = $("#servicio").val();
            
            console.log(eventEl)
            return {
                title: eventEl.innerText,
                extendedProps: { "barbero": barbero, "servicio": servicio },
                backgroundColor: eventEl.style.backgroundColor,
                borderColor: eventEl.style.backgroundColor,
            };

        }
    });
    view = 'timeGridDay';
    header = {
        left: 'prev,next timeGridDay,timeGridWeek,dayGridMonth',
        center: '',
        right: ''
    };
 /*==============================================
    calendario 1
    ==============================================*/
    if(screen.width>768){
        defaultView = 'timeGridWeek';
    }else{
        defaultView = 'timeGridDay';
    }
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        plugins: ['interaction', 'dayGrid', 'timeGrid'],
        defaultView: defaultView,
        defaultDate: hoy,
        header: header,
        forceEventDuration: true,
        defaultTimedEventDuration: '00:30:00',
        slotMinutes: 15,
        businessHours: [ // specify an array instead
            {
                daysOfWeek: [1, 2, 3, 4, 5, 6],
                startTime: '09:00', // 8am
                endTime: '21:00' // 6pm
            }
        ],
        minTime: "09:00",
        maxTime: "21:00",

        eventSources: [

            // your event source
            {
                url: 'ajax/cargarTurnos.ajax.php'
            }

            // any other sources...

        ],
        eventClick: function(calEvent, jsEvent, view) {

            e = JSON.stringify(calEvent.event.end)
            s = JSON.stringify(calEvent.event.start)

            //  Configurando StartDate
            var startObj = (calEvent.event.start);
            var local = startObj, // Local timestamp
                m = new moment(local), // Moment representing local time
                a = moment.utc(local), // Specify that 'local' is UTC
                b = m.utc(+3); // Generate UTC time from local
            start = m.format();

            //  Configurando EndDate
            var startObj = (calEvent.event.end);
            var local = startObj, // Local timestamp
                m = new moment(local), // Moment representing local time
                a = moment.utc(local), // Specify that 'local' is UTC
                b = m.utc(+3); // Generate UTC time from local
            end = m.format();

            dia = (end).substr(8, 2);
            mes = (end).substr(5, 2);
            ano = (end).substr(0, 4);
            fecha = dia + '-' + mes + '-' + ano;

            $("#title").val('Cliente: ' + calEvent.event.title);
            $("#modal-barbero").val('Barbero: ' + calEvent.event._def.extendedProps.barbero);
            $("#modal-servicio").val('Servicio: ' + calEvent.event._def.extendedProps.servicio);
            $("#date").val('El dia ' + fecha);
            $("#start").val('Desde las ' + (start).substr(11, 5));
            $("#end").val('Hasta las ' + (end).substr(11, 5));

            $("#exampleModal").modal();

            console.log("id turno:", calEvent.event._def.publicId)
            $(".eliminarTurno").on("click", function(){
                swal.fire({

                    title: '¿Está seguro de borrar el turno?',
                    text: "¡Si no lo está puede cancelar la accíón!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, borrar turno!'
                }).then(function(result) {
                    if (result.value) {
                        
                        var idTurno = parseInt(calEvent.event._def.publicId);
                        var turno = { 'idTurno' : idTurno} 

                        $.ajax({
                            type: 'POST',
                            url: 'ajax/eliminarturnos.ajax.php',
                            data: turno,
                            success: function(respuesta) {
                                console.log("bien",respuesta)
                            }
                        });
                        swal.fire({
                            type: "success",
                            title: "El turno ha sido eliminado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                
                        }).then(function(result) {
                            if (result.value) {
                                var url = window.location
                                var parts = url.toString().split("/");
                                var lastSegment = parts.pop() || parts.pop();
                                var parts2 = lastSegment.toString().split("ruta=", );
                                var lastSegment2 = parts2.pop() || parts2.pop();
                                var parts3 = lastSegment2.toString().split("&", );
                                var goto = parts3[0];
                                window.location = goto;
                
                            }
                
                        });
            
                    }
            
                })
            })

        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(info) {

            info.draggedEl.parentNode.removeChild(info.draggedEl);

        }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /*==============================================
    Aplicar cambios a los turnos
    ==============================================*/

    $(document).on("click", "span.guardarCalendario", function() {

        var arrayEventos = new Array();
        var eventos = calendar.getEvents();

        // Contador para ID
        var num = 1;
        eventos.forEach(e => {

            // Nombre del turno

            title = (e._def["title"]);
            barbero2 = (e._def.extendedProps["barbero"]);
            servicio = (e._def.extendedProps["servicio"]);
            color = (e._def.ui["backgroundColor"]);
            e._def.ui["textColor"] = 'white'
            textColor = e._def.ui["textColor"]

            id = num;
            num = num + 1;

            //  Configurando StartDate
            var startObj = (e._instance["range"]["start"]);
            var local = startObj, // Local timestamp
                m = new moment(local), // Moment representing local time
                a = moment.utc(local), // Specify that 'local' is UTC
                b = m.utc(); // Generate UTC time from local
            c = m.format();

            start = (c.substr(0, c.length - 1));

            //  Configurando EndDate
            var endObj = (e._instance["range"]["end"]);
            var local_ = endObj, // Local timestamp
                m_ = new moment(local_), // Moment representing local time
                a_ = moment.utc(local_), // Specify that 'local' is UTC
                b = m_.utc(); // Generate UTC time from local
            c_ = m_.format();

            end = (c_.substr(0, c_.length - 1));

            // Solo guardo los turnos de hoy y del futuro, de ayer se eliminan;

            date_hoy = Date.now();

            m2 = new moment(date_hoy), // Moment representing local time
                a2 = moment.utc(date_hoy), // Specify that 'local' is UTC
                b2 = m2.utc(); // Generate UTC time from local
            c2 = m2.format();

            var dia_hoy = c2.substring(0, 10)

            //  2020-02-28 > '2019-02-29' => true

            if (end.substr(0, 10) >= dia_hoy) {

                var evento = new Object();
                evento["id"] = id;
                evento["title"] = title;
                evento["barbero"] = barbero2;
                evento["servicio"] = servicio;
                evento["backgroundColor"] = color;
                evento["start"] = start;
                evento["end"] = end;
                evento["textColor"] = textColor

                arrayEventos.push(evento);

            }

        });

        var data = { 'data': JSON.stringify(arrayEventos) }

        $.ajax({
            type: 'POST',
            url: 'ajax/actualizarTurnos.ajax.php',
            dataType: 'json',
            data: data,
            success: function(data, status, xhr) {
                alert("response was " + data);
            },
            error: function(xhr, status, errorMessage) {
                $("#debug").append("RESPONSE: " + xhr.responseText + ", error: " + errorMessage);
            }
        });

        swal.fire({
            type: "success",
            title: "Los turnos han sido guardados correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then(function(result) {
            if (result.value) {
                window.location = "turnos";

            }

        });

    })
})