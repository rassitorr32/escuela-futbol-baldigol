<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditServicio input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditServicio' : 'FRegServicio' ?>" enctype="multipart/form-data">
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
        <input type="hidden" name="id_servicio" value="<?= (isset($obj)) ? $obj['id_servicio'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($obj) ? $obj['nombre'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" class="form-control" name="descripcion" value="<?= isset($obj) ? $obj['descripcion'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Asociar Servicio a: (opcional)</label>
                    <?php $id_select = isset($obj['id_dep']) ? $obj['id_dep'] : '' ?>
                    <select class="form-control show-tick selectServicio" name="id_dep">
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($servicio_list)) : ?>
                            <?php foreach ($servicio_list as $key => $value) : ?>
                                <option value="<?= $value['id_servicio'] ?>" <?= $id_select == $value['id_servicio'] ? 'selected' : '' ?>><?= $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
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
        $.validator.setDefaults({
            submitHandler: function() {
                // Deshabilitar el botón de submit para evitar envíos múltiples
                $('#FRegServicio button[type="submit"]').attr('disabled', 'disabled');
                // Opcional: Cambiar el texto del botón a "Enviando..."
                $('#FRegServicio button[type="submit"]').html('Enviando...');
                Store("<?= base_url() ?>servicio/store", "<?= base_url() ?>servicio", '#<?= (isset($obj)) ? 'FEditServicio' : 'FRegServicio' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditServicio' : 'FRegServicio' ?>').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3,
                    pattern: /^[A-Za-zñÑ\s]+$/
                },
                descripcion: {
                    required: true,
                    minlength: 3,
                    pattern: /^[A-Za-zñÑ\s]+$/
                },
            },
            messages: {
                nombre: {
                    pattern: "Por favor, ingrese solo letras, números y espacios."
                },
                descripcion: {
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