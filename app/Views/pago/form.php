<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditPago input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }

    #FRegPago input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink) */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }

    */ #FEditPago input,
    #FEditPago select,
    #FEditPago textarea {
        background-color: #f2f2f2;
        color: #000;
        border-color: #E8E9E9;
    }

    #FregPago input,
    #FregPago select,
    #FregPago textarea {
        background-color: #f2f2f2;
        color: #000;
        border-color: #E8E9E9;
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
        <input type="hidden" name="id_pago_padre" value="<?= (isset($obj['id_dep'])) ? $obj['id_dep'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Estudiante</label>
                    <?php $id_select = isset($obj['id_estudiante']) ? $obj['id_estudiante'] : ''; ?>
                    <select class="form-control show-tick selectEstudiante" name="estudiante" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9; <?= (isset($obj['id_pago'])) ? 'pointer-events: none;' : '' ?>">
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($estudiante_list)) : ?>
                            <?php foreach ($estudiante_list as $key => $value) : ?>
                                <option value=<?= $value['id_tutor'] ?> <?= $id_select == $value['id_tutor'] ? 'selected' : '' ?>><?= $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . $value['ap_materno'] . ' CI:' . $value['dni'] ?></option>
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
                    <label>Buscar Persona</label>
                    <?php $id_select = isset($obj['id_persona']) ? $obj['id_persona'] : ''; ?>
                    <select class="form-control show-tick selectEstudiante" name="estudiante" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9; <?= (isset($obj['id_pago'])) ? 'pointer-events: none;' : '' ?>">
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($persona_list)) : ?>
                            <?php foreach ($persona_list as $key => $value) : ?>
                                <option value=<?= $value['id_persona'] ?> <?= $id_select == $value['id_persona'] ? 'selected' : '' ?>><?= $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . $value['ap_materno'] . ' CI:' . $value['dni'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group">
                    <label>C.I. (Buscar...)</label>
                    <input type="text" class="form-control" name="ci" value="<?= isset($obj) ? $obj['dni'] : '' ?>" style="background-color: #f2f2f2; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($obj) ? $obj['nombres'] : '' ?>" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ap. Paterno</label>
                    <input type="text" class="form-control" name="ap_paterno" value="<?= isset($obj) ? $obj['ap_paterno'] : '' ?>" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Ap. Materno</label>
                    <input type="text" class="form-control" name="ap_materno" placeholder="--Opcional--" value="<?= isset($obj) ? $obj['ap_materno'] : '' ?>" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>F. Nacimiento</label>
                    <input type="date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Date of Birth" name="fechaNac" value="<?= isset($obj) ? $obj['fecha_nac'] : '' ?>" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label>Extensión CI</label>
                    <select class="form-control show-tick" name="extension" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                        <option value="" disabled>-- Seleccionar --</option>
                        <option value="tj">tj</option>
                        <option value="po">po</option>
                        <option value="bn">bn</option>
                        <option value="sc">sc</option>
                        <option value="lp">lp</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Género</label>
                    <?php $id_select = isset($obj['id_tutor']) ? $obj['id_tutor'] : '' ?>
                    <select class="form-control show-tick" name="genero" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                        <option value="" disabled>-- Seleccionar --</option>
                        <option value="1" <?= $id_select == '1' ? 'selected' : '' ?>>Másculino</option>
                        <option value="0" <?= $id_select == '0' ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?= isset($obj) ? $obj['direccion'] : '' ?>" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?= isset($obj) ? $obj['nacionalidad'] : '' ?>" style="background-color: #f2f2f2; color: #000; border-color: #E8E9E9;">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Tutor</label>
                    <?php $id_select = isset($obj['id_dep']) ? $obj['id_dep'] : '' ?>
                    <select class="form-control show-tick" name="tutor" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;" disable>
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($tutor_list)) : ?>
                            <?php foreach ($tutor_list as $key => $value) : ?>
                                <option value="<?= $value['id_tutor'] ?>" <?= $id_select == $value['id_tutor'] ? 'selected' : '' ?>><?= $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . $value['ap_materno'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <h5>Datos del pago</h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Servicio</label>
                    <?php $id_select = isset($obj['id_servicio']) ? $obj['id_servicio'] : '' ?>
                    <select class="form-control show-tick selectServicio" name="servicio" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                        <option value="" selected disabled>-- Seleccionar servicio --</option>
                        <?php if (isset($servicio_list)) : ?>
                            <?php foreach ($servicio_list as $key => $value) : ?>
                                <option value="<?= $value['id_servicio'] ?>" <?= $id_select == $value['id_servicio'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Costo de</label>
                    <select class="form-control show-tick selectCosto" name="costo" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;" disabled>
                        <option value="" disable selected>--Seleccionar costo--</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Monto</label>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" name="precio" placeholder="Precio" aria-label="Precio" aria-describedby="basic-addon2" style="background-color: #f2f2f2;; color: #000; border-color: #E8E9E9;">
                            <span class="input-group-text" id="basic-addon2">.00</span>
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
                        <div class="input-group-append">
                            <span class="input-group-text">Subir</span>
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
        $('.selectEstudiante').select2({
            //theme: 'bootstrap4',
            placeholder: '-- Seleccione Estudiante --', // Texto del placeholder
            width: '100%', // Ancho del select
            // // minimumResultsForSearch: Infinity, // Ocultar la barra de búsqueda

        });
        // Deshabilitar el Select2
        $('.selectEstudiante').prop('disabled', <?= isset($obj['id_pago']) ? 'true' : 'false' ?>);

        // Cuando se cambia la selección del primer select
        $('.selectServicio').change(function() {
            // Obtener el valor seleccionado del primer select
            var selectedOption = $(this).val();

            // Desbloquear el segundo select
            $('.selectCosto').prop('disabled', false);

            // Realizar una solicitud AJAX para obtener opciones basadas en el valor seleccionado del primer select
            $.ajax({
                url: 'costo/getCostosJSON/' + selectedOption, // URL a tu archivo PHP que maneja la solicitud AJAX
                type: 'GET', // Método de la solicitud
                data: '', // Datos a enviar (si es necesario)
                success: function(data) {
                    // Convertir la cadena de texto JSON a un objeto JavaScript
                    var jsonData = JSON.parse(data);
                    // Verificar si el arreglo no está vacío
                    if (jsonData.length > 0) {
                        // Limpiar el segundo select
                        $('.selectCosto').empty();

                        // Recorrer el arreglo de objetos y agregar opciones al select
                        jsonData.forEach(function(obj) {
                            // Añadir una opción por cada objeto en el arreglo
                            $('.selectCosto').append('<option value="' + obj.id_costo + '">' + obj.tipo_costo + '</option>');
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
                },
                genero: {
                    required: true
                },
                direccion: {
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
                },
                precio: {
                    required: true,
                    number: true
                }
            },
            messages: {},
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
    });
</script>