<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditTemporada input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
    #FEditTemporada .form-control {
        background-color: #fff; /* Establece el color de fondo a blanco */
        color: #000; /* Establece el color del texto a negro */
        border-color: #ccc;
    }
    #FEditTemporada .form-control:disabled {
        background-color: #e9ecef;
        opacity: 1;
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditTemporada' : 'FRegTemporada' ?>" enctype="multipart/form-data">
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
        <input type="hidden" name="id_temporada" value="<?= (isset($obj)) ? $obj['id_temporada'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($obj) ? $obj['nombre'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Tipo Temporada</label>
                    <input type="text" class="form-control" name="tipo_temporada" value="<?= isset($obj) ? $obj['tipo_temporada'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Turno</label>
                    <?php $id_select = isset($obj) ? $obj['id_turno'] : '' ?>
                    <select class="form-control show-tick" name="turno">
                        <option value="" disabled selected>-- Seleccionar --</option>
                        <?php if (isset($turno_list)) : ?>
                            <?php foreach ($turno_list as $key => $value) : ?>
                                <option value=<?= $value['id_turno'] ?> <?= $id_select == $value['id_turno'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Complejo</label>
                    <?php $id_select = isset($obj) ? $obj['id_complejo'] : '' ?>
                    <select class="form-control show-tick selectComplejo" name="complejo">
                        <option value="" disabled selected>-- Seleccionar --</option>
                        <?php if (isset($complejo_list)) : ?>
                            <?php foreach ($complejo_list as $key => $value) : ?>
                                <option value=<?= $value['id_complejo'] ?> <?= $id_select == $value['id_complejo'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Area</label>
                    <?php $id_select = isset($obj) ? $obj['id_area'] : '' ?>
                    <select class="form-control show-tick selectArea" name="area" <?=isset($obj) ? '' : 'disabled' ?>>
                        <option value="" disabled selected>-- Selecciona Complejo --</option>
                        <?php if (isset($area_list)) : ?>
                            <?php foreach ($area_list as $key => $value) : ?>
                                <option value=<?= $value['id_area'] ?> <?= $id_select == $value['id_area'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Categoria</label>
                    <?php $id_select = isset($obj) ? $obj['id_categoria'] : '' ?>
                    <select class="form-control show-tick" name="categoria">
                        <option value="" disabled selected>-- Seleccionar --</option>
                        <?php if (isset($categoria_list)) : ?>
                            <?php foreach ($categoria_list as $key => $value) : ?>
                                <option value=<?= $value['id_categoria'] ?> <?= $id_select == $value['id_categoria'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Servicio</label>
                    <?php $id_select = isset($obj) ? $obj['id_servicio'] : '' ?>
                    <select class="form-control show-tick selectServicio" name="servicio">
                        <option value="" disabled selected>-- Seleccionar --</option>
                        <?php if (isset($servicio_list)) : ?>
                            <?php foreach ($servicio_list as $key => $value) : ?>
                                <option value=<?= $value['id_servicio'] ?> <?= $id_select == $value['id_servicio'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" value="<?= isset($obj) ? $obj['fecha_inicio'] : '' ?>">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Fecha  Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" value="<?= isset($obj) ? $obj['fecha_fin'] : '' ?>">
                </div>
            </div>
            <?php if (!isset($obj['id_temporada'])) : ?>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($obj['id_temporada'])) : ?>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    <?php endif; ?>
</form>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        // Cuando se cambia la selección del primer select
        $('.selectComplejo').change(function() {
            // Obtener el valor seleccionado del primer select
            var selectedOption = $(this).val();

            // Desbloquear el segundo select
            $('.selectArea').prop('disabled', false);

            // Realizar una solicitud AJAX para obtener opciones basadas en el valor seleccionado del primer select
            $.ajax({
                url: 'area/getAreasJSON/' + selectedOption, // URL a tu archivo PHP que maneja la solicitud AJAX
                type: 'GET', // Método de la solicitud
                data: '', // Datos a enviar (si es necesario)
                success: function(data) {
                    // Convertir la cadena de texto JSON a un objeto JavaScript
                    var jsonData = JSON.parse(data);
                    // Verificar si el arreglo no está vacío
                    if (jsonData.length > 0) {
                        // Limpiar el segundo select
                        $('.selectArea').empty();

                        $('.selectArea').append('<option value="" selected disable>-- Selecciona Area --</option>');
                        // Recorrer el arreglo de objetos y agregar opciones al select
                        jsonData.forEach(function(obj) {
                            // Añadir una opción por cada objeto en el arreglo
                            $('.selectArea').append('<option value="' + obj.id_area + '">' + obj.nombre + '</option>');
                        });
                    } else {
                        // Limpiar el segundo select
                        $('.selectArea').empty();
                        $('.selectArea').append('<option value="">--Sin Areas--</option>');
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
        $.validator.setDefaults({
            submitHandler: function() {
                // Deshabilitar el botón de submit para evitar envíos múltiples
                $('#FRegTemporada button[type="submit"]').attr('disabled', 'disabled');
                // Opcional: Cambiar el texto del botón a "Enviando..."
                $('#FRegTemporada button[type="submit"]').html('Enviando...');
                Store("<?= base_url() ?>temporada/store", "<?= base_url() ?>temporada", '#<?= (isset($obj)) ? 'FEditTemporada' : 'FRegTemporada' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditTemporada' : 'FRegTemporada' ?>').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3,
                },
                tipo_temporada: {
                    required: true,
                    minlength: 3,
                },
                turno: {
                    required: true
                },
                complejo: {
                    required: true
                },
                area: {
                    required: true
                },
                categoria: {
                    required: true
                },
                servicio: {
                    required: true
                },
                fecha_inicio: {
                    required: true
                },
                fecha_fin: {
                    required: true
                },
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