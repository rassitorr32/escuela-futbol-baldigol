<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditCategoria input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditCategoria' : 'FRegCategoria' ?>" enctype="multipart/form-data">
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
        <input type="hidden" name="id_categoria" value="<?= (isset($obj)) ? $obj['id_categoria'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($obj) ? $obj['nombre'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Edad Inicial</label>
                    <input type="number" class="form-control" name="edad_inicio" value="<?= isset($obj) ? $obj['edad_inicio'] : '' ?>">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Edad Máxima</label>
                    <input type="number" class="form-control" name="edad_final" value="<?= isset($obj) ? $obj['edad_final'] : '' ?>">
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
                $('#FRegCategoria button[type="submit"]').attr('disabled', 'disabled');
                // Opcional: Cambiar el texto del botón a "Enviando..."
                $('#FRegCategoria button[type="submit"]').html('Enviando...');
                Store("<?= base_url() ?>categoria/store", "<?= base_url() ?>categoria", '#<?= (isset($obj)) ? 'FEditCategoria' : 'FRegCategoria' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditCategoria' : 'FRegCategoria' ?>').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3,
                    pattern: /^[\w\s]+$/
                },
                edad_inicio: {
                    required: true,
                },
                edad_final: {
                    required: true,
                },
            },
            messages: {
                nombre: {
                    pattern: "Por favor, ingrese solo letras, números y espacios."
                },
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