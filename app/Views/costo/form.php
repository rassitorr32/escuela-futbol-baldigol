<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditCosto input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?>" enctype="multipart/form-data">
    <?php if (isset($obj)) : ?>
        <div class="modal-header btn-primary">
            <h4 class="modal-title" style="color: white;"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <?php endif; ?>
        <?= csrf_field() ?>
        <input type="hidden" name="id_costo" value="<?= (isset($obj)) ? $obj['id_costo'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Servicio</label>
                    <?php $id_select = isset($obj['id_servicio']) ? $obj['id_servicio'] : '' ?>
                    <select class="form-control show-tick selectServicio" name="servicio" <?= isset($obj['id_servicio']) ? 'disabled' : '' ?>>
                        <option value="" selected disabled>-- Seleccionar servicio --</option>
                        <?php if (isset($servicio_list)) : ?>
                            <?php foreach ($servicio_list as $key => $value) : ?>
                                <option value="<?= $value['id_servicio'] ?>" <?= $id_select == $value['id_servicio'] ? 'selected' : '' ?>><?= $value['tipo_servicio'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <div id="selectSubServicio" style="display: none;">
                    <label>Sub Servicio</label>
                    <select class="form-control show-tick" name="sub_servicio" disabled>
                        <option value="" selected disable>-- Sub Servicio --</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Costo</label>
                    <input type="text" class="form-control" name="tipo_costo" value="<?= isset($obj) ? $obj['tipo_costo'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" value="<?= isset($obj) ? $obj['fecha_inicio'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Fecha Final</label>
                    <input type="date" class="form-control" name="fecha_final" value="<?= isset($obj) ? $obj['fecha_final'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Monto</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="valor" value="<?= isset($obj) ? $obj['valor'] : '' ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">Bs.</span>
                                <span class="input-group-text">0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!isset($obj)) : ?>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($obj)) : ?>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    <?php endif; ?>
</form>

<script>
    $(function() {
        $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?> select[name="servicio"]').change(function() {
            var idServicio = $(this).val();
            $.ajax({
                url: 'servicio/listSubServicio/' + idServicio, // La URL de tu controlador
                type: 'GET',
                data: '',
                success: function(data) {
                    // console.log(data)
                    jsonData = JSON.parse(data)
                    console.log(jsonData)
                    // Limpiar el segundo select
                    $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?> select[name="sub_servicio"]').empty();
                    $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?> select[name="sub_servicio"]').append('<option value="">-- Sub Servicio --</option>');

                    if (jsonData != null && jsonData.length > 0) {
                        $('#<?= isset($obj)?'FEditCosto':'FRegCosto'?> #selectSubServicio').show();
                        // Desbloquear el segundo select
                        $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?> select[name="sub_servicio"]').prop('disabled', false);

                        // Recorrer el arreglo de objetos y agregar opciones al select
                        jsonData.forEach(function(obj) {
                            // Añadir una opción por cada objeto en el arreglo
                            $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?> select[name="sub_servicio"]').append('<option value="' + obj.id_servicio + '">' + obj.tipo_servicio + '</option>');
                        });
                    } else {
                        $('#<?= isset($obj)?'FEditCosto':'FRegCosto'?> #selectSubServicio').hide();
                        // Desbloquear el segundo select
                        $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?> select[name="sub_servicio"]').prop('disabled', true);
                        // Si el arreglo está vacío, mostrar un mensaje o realizar otra acción
                        console.log('El arreglo jsonData está vacío.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $.validator.setDefaults({
            submitHandler: function() {
                // Deshabilitar el botón de submit para evitar envíos múltiples
                $('#FRegCosto button[type="submit"]').attr('disabled', 'disabled');
                // Opcional: Cambiar el texto del botón a "Enviando..."
                $('#FRegCosto button[type="submit"]').html('Enviando...');
                Store("<?= base_url() ?>costo/store", "<?= base_url() ?>costo", '#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditCosto' : 'FRegCosto' ?>').validate({
            rules: {
                servicio: {
                    required: true,
                },
                sub_servicio:{
                    required: true
                },
                tipo_costo: {
                    required: true,
                    minlength: 3,
                    pattern: /^[A-Za-zñÑ\s]+$/
                },
                fecha_inicio: {
                    required: true,
                },
                fecha_final: {
                    required: true,
                },
                valor: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                tipo_costo: {
                    pattern: "Por favor, ingrese solo letras, números y espacios."
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
    });
</script>