<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditEstudiante input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditEstudiante' : 'FRegEstudiante' ?>" enctype="multipart/form-data">
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
        <input type="hidden" name="id_estudiante" value="<?= (isset($obj)) ? $obj['id_tutor'] : '' ?>">
        <input type="hidden" name="id_persona" value="<?= (isset($obj)) ? $obj['id_persona'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($objPersona) ? $objPersona['nombres'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ap. Paterno</label>
                    <input type="text" class="form-control" name="ap_paterno" value="<?= isset($objPersona) ? $objPersona['ap_paterno'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ap. Materno</label>
                    <input type="text" class="form-control" name="ap_materno" value="<?= isset($objPersona) ? $objPersona['ap_materno'] : '' ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>F. Nacimiento</label>
                    <input type="date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Date of Birth" name="fechaNac" value="<?= isset($objPersona) ? $objPersona['fecha_nac'] : '' ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label>C.I.</label>
                    <input type="text" class="form-control" name="ci" value="<?= isset($objPersona) ? $objPersona['dni'] : '' ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label>Extensión CI</label>
                    <?php $id_select = isset($obj) ? $obj['extension'] : '' ?>
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
                    <?php $id_select = isset($obj) ? $obj['sexo'] : '' ?>
                    <select class="form-control show-tick" name="genero">
                        <option value="" disabled>-- Seleccionar --</option>
                        <option value="1" <?= $id_select == '1' ? 'selected' : '' ?>>Másculino</option>
                        <option value="0" <?= $id_select == '0' ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?= isset($objPersona) ? $objPersona['direccion'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?= isset($objPersona) ? $objPersona['nacionalidad'] : '' ?>">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Tutor</label>
                    <?php $id_select = isset($obj['id_dep']) ? $obj['id_dep'] : '' ?>
                    <select class="form-control show-tick selectTutor" name="tutor">
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($tutor_list)) : ?>
                            <?php foreach ($tutor_list as $key => $value) : ?>
                                <option value="<?= $value['id_tutor'] ?>" <?= $id_select == $value['id_tutor'] ? 'selected' : '' ?>><?= $value['nombres'] . ' ' . $value['ap_paterno'] . ' ' . $value['ap_materno'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <!-- <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Peso</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="peso" value="">
                        <div class="input-group-append">
                            <span class="input-group-text">Kg.</span>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Categoría</label>
                    <input type="text" class="form-control" name="id_sub" value="">
                </div>
            </div> -->
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="imageEstudiante">Imagen <span class="breadcrumb-item active">(Max. 10MB)</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageUser<?= (isset($obj)) ? 'Edit' : 'Reg' ?>" name="imageEstudiante" onchange="previsualizar('<?= (isset($obj)) ? 'Edit' : 'Reg' ?>')">
                            <input type="hidden" value="<?= isset($objPersona['foto']) ? $objPersona['foto'] : '' ?>" name="imagenActual">
                            <label class="custom-file-label" for="imageEstudiante">Elija una foto</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="form-group">
                    <img src="<?= base_url() ?>assets/dist/img/estudiantes/<?= (isset($objPersona['foto']) && file_exists(FCPATH . 'assets/dist/img/estudiantes/' . $objPersona['foto'])) ? $objPersona['foto'] : 'user_default.png' ?>" alt="" width="200" class="img-thumbnail previsualizar">
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
    $(document).ready(function() {
        $('.selectTutor').select2({
            //theme: 'bootstrap4',
            placeholder: '-- Ninguno --', // Texto del placeholder
            width: '100%', // Ancho del select
            // // minimumResultsForSearch: Infinity, // Ocultar la barra de búsqueda

        });
    });

    $(function() {

        $.validator.setDefaults({
            submitHandler: function() {
                // Deshabilitar el botón de submit para evitar envíos múltiples
                $('#FRegEstudiante button[type="submit"]').attr('disabled', 'disabled');
                // Opcional: Cambiar el texto del botón a "Enviando..."
                $('#FRegEstudiante button[type="submit"]').html('Enviando...');
                Store("<?= base_url() ?>estudiante/store", "<?= base_url() ?>estudiante", '#<?= (isset($obj)) ? 'FEditEstudiante' : 'FRegEstudiante' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditEstudiante' : 'FRegEstudiante' ?>').validate({
            rules: {
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