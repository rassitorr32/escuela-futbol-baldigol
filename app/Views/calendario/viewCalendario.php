<style>
@media (max-width: 576px) {/* A partir del punto de quiebre 'xs' de Bootstrap */
        #calendar_container {
            width: 500px; /* Ancho fijo para el calendario */
        }
    }
</style>
<div id="calendar_container">
    <div id="calendar"></div>
</div>


<!-- Add New Event popup -->
<div class="modal fade" id="addNewEvent" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add</strong> an event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Event Name</label>
                            <input class="form-control" placeholder="Enter name" type="text" name="category-name">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Choose Event Color</label>
                            <select class="form-control" data-placeholder="Choose a color..." name="category-color">
                                <option value="primary">Opcional</option>
                                <option value="info">Bajo</option>
                                <option value="success">Moderado</option>
                                <option value="warning">Importante</option>
                                <option value="danger">Crucial</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="form-control" name="category-checkAllDay"> Todo el día
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 fehca-fin-container" style="display: none;">
                            <label class="control-label">Fecha Fin Evento</label>
                            <input class="form-control" placeholder="Enter fecha" type="date" name="category-fechaFin" required>
                        </div>
                        <div class="col-md-4 hora-inicio-container" style="display: none;">
                            <label class="control-label">Hora Inicio</label>
                            <input class="form-control" placeholder="Hora inicio" type="time" name="category-horaInicio">
                        </div>
                        <div class="col-md-4 hora-fin-container" style="display: none;">
                            <label class="control-label">Hora Fin</label>
                            <input class="form-control" placeholder="Hora Fin" type="time" name="category-horaFin">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success save-event" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Direct Event popup -->
<div class="modal fade" id="addDirectEvent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <h4 class="modal-title">Add Direct Event</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event Name</label>
                            <input class="form-control" name="event-name" type="text" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event Type</label>
                            <select name="event-bg" class="form-control">
                                <option value="primary">Opcional</option>
                                <option value="info">Bajo</option>
                                <option value="success">Moderado</option>
                                <option value="warning">Importante</option>
                                <option value="danger">Crucial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="form-control" name="event-checkAllDay"> Todo el día
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 fecha-fin-container" style="display: none;">
                        <div class="form-group">
                            <label>Fecha Fin Evento</label>
                            <input class="form-control" name="event-fechaFin" type="date" required />
                        </div>
                    </div>
                    <div class="col-md-4 hora-inicio-container" style="display: none;">
                        <div class="form-group">
                            <label>Hora Inicio</label>
                            <input class="form-control" name="event-horaInicio" type="time" />
                        </div>
                    </div>
                    <div class="col-md-4 hora-fin-container" style="display: none;">
                        <div class="form-group">
                            <label>Hora Fin</label>
                            <input class="form-control" name="event-horaFin" type="time" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn save-btn btn-success">Save</button>
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Event Edit Modal popup -->
<div class="modal fade" id="eventEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <h4 class="modal-title">Edit Event</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event Name</label>
                            <input class="form-control" name="event-name" type="text" />
                            <input class="form-control" name="event-id" type="hidden" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Event Type</label>
                            <select name="event-bg" class="form-control">
                                <option value="primary">Opcional</option>
                                <option value="info">Bajo</option>
                                <option value="success">Moderado</option>
                                <option value="warning">Importante</option>
                                <option value="danger">Crucial</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="form-control" name='event-checkAllDay'> Todo el día
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 fecha-fin-container" style="display: none;">
                        <div class="form-group">
                            <label>Fecha Fin Evento</label>
                            <input class="form-control" name="event-fechaFin" type="date" required />
                        </div>
                    </div>
                    <div class="col-md-4 hora-inicio-container" style="display: none;">
                        <div class="form-group">
                            <label>Hora Inicio</label>
                            <input class="form-control" name="event-horaInicio" type="time" />
                        </div>
                    </div>
                    <div class="col-md-4 hora-fin-container" style="display: none;">
                        <div class="form-group">
                            <label>Hora Fin</label>
                            <input class="form-control" name="event-horaFin" type="time" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn mr-auto delete-btn btn-danger">Delete</button>
                <button class="btn save-btn btn-success">Save</button>
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Seleccionar los checkbox por su clase
        var checkbox = $('.form-control[type="checkbox"]');
        $('.fecha-fin-container, .hora-inicio-container, .hora-fin-container').show();
        // Crear un evento para hacer aparecer los inputs cuando el checkbox cambie de estado
        checkbox.change(function() {
            // Obtener el contenedor del checkbox
            var checkboxContainer = $(this).closest('.col-md-12');

            // Verificar si el checkbox está marcado
            if (!$(this).is(':checked')) {
                // Mostrar los contenedores de fecha y hora
                checkboxContainer.nextAll('.fecha-fin-container, .hora-inicio-container, .hora-fin-container').show();
            } else {
                // Ocultar los contenedores de fecha y hora
                checkboxContainer.nextAll('.hora-inicio-container, .hora-fin-container').hide();
            }
        });

    });
</script>