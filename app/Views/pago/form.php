<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditPago input[type="text"]::selection {
        border-color: #E8E9E9;
        font-size: 14px;
        height: auto;
    }

    #FRegPago .form-control {
        background-color: #fff;
        /* Establece el color de fondo a blanco */
        color: #000;
        /* Establece el color del texto a negro */
        border-color: #ccc;
    }


    /* 
    #FregPago input,
    #FregPago select,
    #FregPago textarea {
        background-color: #f2f2f2;
        color: #000;
        border-color: #E8E9E9;
    } */
    #FRegPago .form-control:disabled {
        background-color: #c4c6c9;
        /*#e9ecef;*/
        opacity: 1;
    }

    #FEditPago .form-control:disabled {
        background-color: #c4c6c9;
        /*#e9ecef;*/
        opacity: 1;
    }

    #FEditPago input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }

    #FRegPago input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>" enctype="multipart/form-data">
    <?php if (isset($obj['id_pago'])) : ?>
        <div class="modal-header btn-primary">
            <h4 class="modal-title" style="color: white;"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <?php endif; ?>
        <?= csrf_field() ?>
        <input type="hidden" name="id_estudiante" value="<?= (isset($obj['id_tutor'])) ? $obj['id_tutor'] : '' ?>">
        <input type="hidden" name="id_pago_padre" value="<?= isset($idPadre) ? $idPadre : '' ?>">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Estudiante</label>
                    <?php $id_select = isset($obj['id_estudiante']) ? $obj['id_estudiante'] : ''; ?>
                    <select class="form-control show-tick selectEstudiante" name="estudiante" <?= (isset($obj['id_pago'])) ? 'disabled' : '' ?>>
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($estudiante_list)) : ?>
                            <?php foreach ($estudiante_list as $key => $value) : ?>
                                <option value="<?= $value['id_tutor'] ?>" <?= $id_select == $value['id_tutor'] ? 'selected' : '' ?>><?= $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . $value['ap_materno'] . ' CI:' . $value['dni'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <h5>Datos de quien realiza el pago</h5>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Buscar Persona <input type="checkbox" id="buscarPersona" name="checkPersona"></label>
                    <div class="selectContainer" style="display: none;">
                        <select class="form-control show-tick selectPersona" name="persona">
                            <option value="" selected>-- Ninguno --</option>
                            <?php if (isset($persona_list)) : ?>
                                <?php foreach ($persona_list as $key => $value) : ?>
                                    <option value="<?= $value['id_persona'] ?>"><?= $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . $value['ap_materno'] . ' CI:' . $value['dni'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label>C.I.</label>
                    <input type="text" class="form-control" name="ci" value="">
                    <input type="hidden" name="id_persona" value="<?= isset($obj) ? $obj['id_persona'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($obj) ? $obj['nombres'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ap. Paterno</label>
                    <input type="text" class="form-control" name="ap_paterno" value="<?= isset($obj) ? $obj['ap_paterno'] : '' ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Ap. Materno</label>
                    <input type="text" class="form-control" name="ap_materno" placeholder="--Opcional--" value="<?= isset($obj) ? $obj['ap_materno'] : '' ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>F. Nacimiento</label>
                    <input type="date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Date of Birth" name="fechaNac" value="<?= isset($obj) ? $obj['fecha_nac'] : '' ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label>Extensión CI</label>
                    <?php $id_select = isset($objPersona) ? $objPersona['extension'] : '' ?>
                    <select class="form-control show-tick" name="extension">
                        <option value="" selected disabled>-- Seleccionar --</option>
                        <option value="tj" <?= $id_select == 'tj' ? 'selected' : '' ?>>tj</option>
                        <option value="po" <?= $id_select == 'po' ? 'selected' : '' ?>>po</option>
                        <option value="bn" <?= $id_select == 'bn' ? 'selected' : '' ?>>bn</option>
                        <option value="sc" <?= $id_select == 'sc' ? 'selected' : '' ?>>sc</option>
                        <option value="lp" <?= $id_select == 'lp' ? 'selected' : '' ?>>lp</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Género</label>
                    <select class="form-control show-tick" name="genero">
                        <option value="" selected disabled>-- Seleccionar --</option>
                        <option value="1">Másculino</option>
                        <option value="0">Femenino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" name="direccion" placeholder="--Opcional--" value="">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <h5>Datos del pago</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Servicio</label>
                    <?php $id_select = isset($obj['id_servicio']) ? $obj['id_servicio'] : '' ?>
                    <select class="form-control show-tick selectServicio" name="servicio" <?= isset($obj['id_servicio']) ? 'disabled' : '' ?>>
                        <option value="" selected disabled>-- Seleccionar servicio --</option>
                        <?php if (isset($servicio_list)) : ?>
                            <?php foreach ($servicio_list as $key => $value) : ?>
                                <option value="<?= $value['id_servicio'] ?>" <?= $id_select == $value['id_servicio'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Costo de</label>
                    <?php $id_select = isset($obj['id_costo']) ? $obj['id_costo'] : '' ?>
                    <select class="form-control show-tick selectCosto" name="costo" <?= (isset($obj['idPadre'])) ? '' : 'disabled' ?>>
                        <option value="" disable selected>-- Seleccionar Servicio --</option>
                        <?php if (isset($servicio_list) && isset($obj['id_costo'])) : ?>
                            <?php foreach ($servicio_list as $key => $value) : ?>
                                <option value="<?= $value['id_costo'] ?>" <?= $id_select == $value['id_costo'] ? 'selected' : '' ?>><?= $value['tipo_costo'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Monto</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="monto" <?= (isset($obj)) ? '' : 'disabled' ?>>
                            <input type="hidden" name="nro_cuotas_max" value="<?= isset($obj['nro_cuotas_max']) ? $obj['nro_cuotas_max'] : '' ?>">
                            <input type="hidden" name="total_cuotas" value="<?= isset($obj['total_cuota']) ? $obj['total_cuota'] : '' ?>">
                            <input type="hidden" name="monto_pagado" value="<?= isset($obj['monto_pagado']) ? $obj['monto_pagado'] : '' ?>">
                            <input id="valor_total" type="hidden" name="valor_total" value="<?= isset($obj['valor_total']) ? $obj['valor_total'] : '' ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">Bs.</span>
                                <span class="input-group-text">0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="imagePago">Subir Comprobante <span class="breadcrumb-item active">(PNG o JPEG, Max. 10MB)</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageUser<?= (isset($obj)) ? 'Edit' : 'Reg' ?>" name="imagePago" onchange="previsualizar('<?= (isset($obj)) ? 'Edit' : 'Reg' ?>')">
                            <input type="hidden" value="<?= isset($obj['foto']) ? $obj['foto'] : '' ?>" name="imagenActual">
                            <label class="custom-file-label" for="imagePago">Elija una foto</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="form-group">
                    <img src="<?= base_url() ?>assets/dist/img/pagos/<?= (isset($obj['foto']) && file_exists(FCPATH . 'assets/dist/img/pagos/' . $obj['foto'])) ? $obj['foto'] : 'img_default.png' ?>" alt="" width="200" class="img-thumbnail previsualizar">
                </div>
            </div>
            <?php if (!isset($obj['id_pago'])) : ?>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($obj['id_pago'])) : ?>
        </div>
        <div class="modal-footer justify-content-between">
            <button id="btnCancelar" type="button" class="btn btn-default">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    <?php endif; ?>
</form>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {

        cargarDatosCosto($('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').val(), $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').val());
        //Mostrar el buscador de persona
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="checkPersona"]').change(function() {
            if ($(this).is(":checked")) {
                $(this).closest('label').closest('.form-group').find('.selectContainer').show();
            } else {
                $(this).closest('label').closest('.form-group').find('.selectContainer').hide();
                var form = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>');
                form.find('select[name="persona"]').val("");
                form.find('select[name="genero"]').val("");
                form.find('input[name="id_persona"]').val("");
                form.find('input[name="nombre"]').val("").prop('disabled', false);
                form.find('input[name="ci"]').val("").prop('disabled', false);
                form.find('input[name="ap_paterno"]').val("").prop('disabled', false);
                form.find('input[name="ap_materno"]').val("").prop('disabled', false);
                form.find('input[name="fechaNac"]').val("").prop('disabled', false);
                form.find('select[name="extension"]').val("").prop('disabled', false);
                form.find('select[name="genero"]').val("").prop('disabled', false);
                form.find('input[name="direccion"]').val("").prop('disabled', false);
                form.find('input[name="nacionalidad"]').val("").prop('disabled', false);
            }
        });

        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').select2({
            //theme: 'bootstrap4',
            placeholder: '-- Seleccione Estudiante --', // Texto del placeholder
            width: '100%', // Ancho del select
            // // minimumResultsForSearch: Infinity, // Ocultar la barra de búsqueda

        });
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="persona"]').select2({
            //theme: 'bootstrap4',
            placeholder: '-- Seleccione Persona --', // Texto del placeholder
            width: '100%', // Ancho del select
            // // minimumResultsForSearch: Infinity, // Ocultar la barra de búsqueda

        });
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="servicio"]').select2({
            //theme: 'bootstrap4',
            placeholder: '-- Seleccione Servicio --', // Texto del placeholder
            width: '100%', // Ancho del select
            // // minimumResultsForSearch: Infinity, // Ocultar la barra de búsqueda

        });
        // Deshabilitar el Select2
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').prop('disabled', <?= isset($obj['id_pago']) ? 'true' : 'false' ?>);
        // Cuando se cambia la selección del primer select
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').change(function() {
            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').val('');

            if ($('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').val() != '') {
                var form = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>');

                // Forzar la validación del input con el nombre 'nombre_input'
                form.validate().element('[name="costo"]');
            }
            // Restablecer el estado del input y su mensaje de error
            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').hide();
            // $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="nro_cuotas_max"]').val('')
            cargarDatosCosto($('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').val(), $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').val());
        });
        // Cuando se cambia la selección del primer select
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> .selectServicio').change(function() {
            // Obtener el valor seleccionado del primer select
            var selectedOption = $(this).val();

            // Desbloquear el segundo select
            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').prop('disabled', false);

            // Realizar una solicitud AJAX para obtener opciones basadas en el valor seleccionado del primer select
            $.ajax({
                url: 'costo/getCostosJSON/' + selectedOption, // URL a tu archivo PHP que maneja la solicitud AJAX
                type: 'GET', // Método de la solicitud
                data: '', // Datos a enviar (si es necesario)
                success: function(data) {
                    // Convertir la cadena de texto JSON a un objeto JavaScript
                    var jsonData = JSON.parse(data);
                    // Verificar si el arreglo no está vacío
                    // Limpiar el segundo select
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').empty();
                    // Restablecer el estado del input y su mensaje de error
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').hide();
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').append('<option value="" selected disabled>-- Seleccionar Costo --</option>');
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').val('');
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').prop('disabled', true);
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').hide();
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="nro_cuotas_max"]').val('');
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="total_cuotas"]').val('');
                    $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="valor_total"]').val('');
                    if (jsonData.length > 0) {

                        // Recorrer el arreglo de objetos y agregar opciones al select
                        jsonData.forEach(function(obj) {
                            // Añadir una opción por cada objeto en el arreglo
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').append('<option value="' + obj.id_costo + '">' + obj.tipo_costo + '</option>');
                        });
                    } else {
                        // Si el arreglo está vacío, mostrar un mensaje o realizar otra acción
                        console.log('El arreglo jsonData está vacío.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar opciones:', error);
                }
            });
        });

        // Cuando se cambia la selección del primer select
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').change(function() {
            // Obtener el valor seleccionado del primer select
            var selectIdCosto = $(this).val();
            var selectIdEstudiante = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').val();

            if (selectIdCosto === '') {
                // Bloquear el segundo select
                $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').prop('disabled', true);
                $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="valor_total"]').val('');
            } else {
                // Desbloquear el segundo select
                $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').prop('disabled', false);
                cargarDatosCosto($('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').val(), $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').val());
                var form = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>');

                // Forzar la validación del input con el nombre 'nombre_input'
                form.validate().element('[name="costo"]');

                $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').val('');
                $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').hide();
            }
        });

        function cargarDatosCosto(idCosto, idEstudiante) {
            console.log(idCosto + ' ' + idEstudiante)
            $.ajax({
                url: 'pago/getCostoJSON', // URL a tu archivo PHP que maneja la solicitud AJAX
                type: 'post', // Método de la solicitud
                data: {
                    idCosto: idCosto,
                    idEstudiante: idEstudiante
                }, // Datos a enviar (si es necesario)
                success: function(data) {
                    // Convertir la cadena de texto JSON a un objeto JavaScript
                    var jsonData = JSON.parse(data);
                    console.log(jsonData)
                    if (jsonData != false) {
                        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="total_cuotas"]').val(jsonData.cuota_total == 0 ? '' : jsonData.cuota_total);
                        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto_pagado"]').val(jsonData.monto_total == null ? '' : jsonData.monto_total);
                        // if ($('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="nro_cuotas_max"]').val() == '')
                        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="nro_cuotas_max"]').val(jsonData.nro_cuotas_max);
                        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="valor_total"]').val(jsonData.valor_costo);
                        var cuota_total = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="nro_cuotas_max"]').val();
                        var cuota_max = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="total_cuotas"]').val();
                        if (cuota_max != '' && cuota_total != '' && cuota_max === cuota_total) {
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').val('');
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').prop('disabled', true);
                            // Restablecer el estado del input

                            // Restablecer el estado del input y su mensaje de error
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').hide();

                        } else {
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').val('');
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').prop('disabled', false);
                            // Restablecer el estado del input

                            // Restablecer el estado del input y su mensaje de error
                            $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> input[name="monto"]').removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').hide();

                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar opciones:', error);
                }
            });
        }

        // Cuando se cambia la selección del primer select
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> .selectPersona').change(function() {
            // Obtener el valor seleccionado del primer select
            var selectedOption = $(this).val();

            console.log('trare la persona: ' + selectedOption)

            if (selectedOption === "") {
                var form = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>');
                form.find('select[name="genero"]').val("");
                form.find('input[name="id_persona"]').val("");
                form.find('input[name="nombre"]').val("").prop('disabled', false);
                form.find('input[name="ci"]').val("").prop('disabled', false);
                form.find('input[name="ap_paterno"]').val("").prop('disabled', false);
                form.find('input[name="ap_materno"]').val("").prop('disabled', false);
                form.find('input[name="fechaNac"]').val("").prop('disabled', false);
                form.find('select[name="extension"]').val("").prop('disabled', false);
                form.find('select[name="genero"]').val("").prop('disabled', false);
                form.find('input[name="direccion"]').val("").prop('disabled', false);
                form.find('input[name="nacionalidad"]').val("").prop('disabled', false);
            } else {

                // Realizar una solicitud AJAX para obtener opciones basadas en el valor seleccionado del primer select
                $.ajax({
                    url: 'persona/getPersonasJSON/' + selectedOption, // URL a tu archivo PHP que maneja la solicitud AJAX
                    type: 'POST', // Método de la solicitud
                    data: '', // Datos a enviar (si es necesario)
                    success: function(data) {
                        // Convertir la cadena de texto JSON a un objeto JavaScript
                        var jsonData = JSON.parse(data);
                        var form = $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>');
                        form.find('input[name="id_persona"]').val(jsonData.id_persona);
                        form.find('input[name="nombre"]').val(jsonData.nombres).prop('disabled', true);
                        form.find('input[name="ci"]').val(jsonData.dni).prop('disabled', true);
                        form.find('input[name="ap_paterno"]').val(jsonData.ap_paterno).prop('disabled', true);
                        form.find('input[name="ap_materno"]').val(jsonData.ap_materno).prop('disabled', true);
                        form.find('input[name="fechaNac"]').val(jsonData.fecha_nac).prop('disabled', true);
                        form.find('select[name="extension"]').val(jsonData.extension).prop('disabled', true);
                        form.find('select[name="genero"]').val(jsonData.sexo).prop('disabled', true);
                        form.find('input[name="direccion"]').val(jsonData.direccion).prop('disabled', true);
                        form.find('input[name="nacionalidad"]').val(jsonData.nacionalidad).prop('disabled', true);
                        console.log(jsonData.nombres)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar opciones:', error);
                    }
                });
            }
        });
    });
    $(function() {
        $('#btnCancelar').click(function() {
            let obj = "";
            $.ajax({
                type: "POST",
                url: 'pago/modalIndex/<?= isset($idPadre) ? $idPadre : '' ?>',
                data: obj,
                success: function(data) {
                    $("#content-lg").fadeOut('slow', function() {
                        // Cuando se complete la solicitud AJAX, reemplazar el contenido actual con el nuevo contenido
                        // y mostrarlo con una transición de desvanecimiento
                        $("#content-lg").html(data).fadeIn('slow');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar el contenido:', error);
                }
            });
        });
        $.validator.setDefaults({
            submitHandler: function() {
                Store("<?= base_url() ?>pago/store", "<?= base_url() ?>pago", '#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?>').validate({
            rules: {
                ci: {
                    required: true,
                    number: true
                },
                estudiante: {
                    required: true,
                },
                nombre: {
                    required: true,
                    minlength: 3,
                },
                ap_paterno: {
                    required: true,
                    minlength: 3,
                },
                ap_materno: {
                    minlength: 3,
                },
                extension: {
                    required: true
                },
                fechaNac: {
                    required: true,
                    validaEdad: true // Regla personalizada para validar edad
                },
                genero: {
                    required: true
                },
                nacionalidad: {
                    required: true,
                },
                servicio: {
                    required: true,
                },
                costo: {
                    required: true,
                    // Agrega una regla de validación remota para verificar si ya se pago el costo del servicio
                    remote: {
                        url: "<?= base_url() ?>pago/verificarCuota",
                        type: "POST",
                        // processData: false,
                        // contentType: false,
                        data: {
                            idCosto: function() {
                                return $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="costo"]').val();
                            },
                            idEstudiante: function() {
                                return $('#<?= (isset($obj)) ? 'FEditPago' : 'FRegPago' ?> select[name="estudiante"]').val();
                            }
                        },
                        // success: function(data) {
                        //     console.log("Respuesta de la petición POST:", data);
                        // }
                    }
                },
                monto: {
                    required: true,
                    number: true,
                    max: function() {
                        var valorPagado = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="monto_pagado"]').val();
                        valorPagado = (valorPagado ? valorPagado : 0);
                        valorPagado = parseFloat(valorPagado);
                        var valorTotal = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="valor_total"]').val();
                        valorTotal = valorTotal ? parseFloat(valorTotal) : 0;
                        var nroCuotas = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="nro_cuotas_max"]').val();
                        nroCuotas = nroCuotas ? parseInt(nroCuotas) : 0;
                        var totalCuotas = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="total_cuotas"]').val();
                        totalCuotas = totalCuotas ? parseInt(totalCuotas) : 0;
                        var valorAIgualar = valorTotal - valorPagado
                        var monto = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="monto"]').val();
                        monto = (monto ? monto : 0);
                        monto = parseFloat(monto);
                        valorMaximo = (totalCuotas - nroCuotas) === 1 ? valorAIgualar : parseFloat($('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="valor_total"]').val());
                        console.log('valor max:' + valorMaximo)
                        return valorMaximo;
                    },
                    validarMonto: true,
                }
            },
            messages: {
                costo: {
                    remote: function() {
                        return "Ya se cumplio el pago de este costo."
                    }
                },
                monto: {
                    equalTo: function() { // Obtener el valor de 'valor_total' del formulario
                        var valorPagado = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="monto_pagado"]').val();
                        valorPagado = (valorPagado ? valorPagado : 0);
                        valorPagado = parseFloat(valorPagado);
                        var valorTotal = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="valor_total"]').val();
                        valorTotal = valorTotal ? parseFloat(valorTotal) : 0;
                        var valorMaximo = valorTotal - valorPagado;
                        console.log(valorMaximo)
                        return "El monto debe completar el valor total: " + valorMaximo.toFixed(2); // Mensaje de error personalizado para la regla equalTo
                    },
                    max: function() {
                        var valorPagado = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="monto_pagado"]').val();
                        valorPagado = (valorPagado ? valorPagado : 0);
                        valorPagado = parseFloat(valorPagado);
                        var valorTotal = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="valor_total"]').val();
                        valorTotal = valorTotal ? parseFloat(valorTotal) : 0;
                        var valorMaximo = valorTotal - valorPagado;
                        console.log(valorMaximo)
                        return "El valor no debe ser mayor a: " + valorMaximo.toFixed(2);
                    },
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        // Regla personalizada para validar edad
        $.validator.addMethod("validaEdad", function(value, element) {
            var fechaNacimiento = new Date(value);
            var hoy = new Date();
            var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();

            // Ajustar la fecha de nacimiento al año actual
            fechaNacimiento.setFullYear(hoy.getFullYear());

            // Verificar si la fecha de nacimiento ya ocurrió este año
            if (hoy < fechaNacimiento) {
                edad--;
            }

            return edad >= 18;
        }, "Debes ser mayor de 18 años.");

        // Regla personalizada para validar edad
        $.validator.addMethod("validarMonto", function(value, element) {
            console.log('ELvalor modono:' + value);
            var valorPagado = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="monto_pagado"]').val();
            valorPagado = (valorPagado ? valorPagado : 0);
            valorPagado = parseFloat(valorPagado);
            var valorTotal = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="valor_total"]').val();
            valorTotal = valorTotal ? parseFloat(valorTotal) : 0;
            var nroCuotasMax = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="nro_cuotas_max"]').val();
            nroCuotasMax = nroCuotasMax ? parseInt(nroCuotasMax) : 0;
            var totalCuotas = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="total_cuotas"]').val();
            totalCuotas = totalCuotas ? parseInt(totalCuotas) : 0;
            var valorAIgualar = valorTotal - valorPagado
            var monto = value;
            monto = (monto ? monto : 0);
            monto = parseFloat(monto);
            valorAIgualar = (nroCuotasMax - totalCuotas) === 1 || (nroCuotasMax - totalCuotas) === 0 ? valorAIgualar : monto;
            console.log('total' + valorAIgualar + 'monto' + monto)
            return (valorAIgualar === monto)
        }, function() {
            var valorPagado = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="monto_pagado"]').val();
            valorPagado = (valorPagado ? valorPagado : 0);
            valorPagado = parseFloat(valorPagado);
            var valorTotal = $('<?= isset($obj) ? '#FEditPago' : '#FRegPago' ?> input[name="valor_total"]').val();
            valorTotal = valorTotal ? parseFloat(valorTotal) : 0;
            var valorMaximo = valorTotal - valorPagado;
            return "El monto debe completar el valor total: " + valorMaximo.toFixed(2); //mensaje de error personalizado
        });

    });
</script>