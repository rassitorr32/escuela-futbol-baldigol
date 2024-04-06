<form id="<?= (isset($obj)) ? 'FEditEstudiante' : 'FRegEstudiante' ?>" enctype="multipart/form-data">
    <?php if (isset($obj['id_pago'])) : ?>
        <div class="modal-header bg-success">
            <h4 class="modal-title" style="color: white;"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <?php endif; ?>
        <?= csrf_field() ?>
        <input type="hidden" name="id_estudiante" value="<?= (isset($obj['id_tutor'])) ? $obj['id_tutor'] : '' ?>">
        <input type="hidden" name="id_dep" value="<?= (isset($obj['id_pago'])) ? $obj['id_pago'] : '' ?>">
        <div class="row clearfix">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" name="nombre" value="<?= isset($obj) ? $obj['nombres'] : '' ?>" style="background-color: #f2f2f2;; color: #000;" readonly>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ap. Paterno</label>
                    <input type="text" class="form-control" name="ap_paterno" value="<?= isset($obj) ? $obj['ap_paterno'] : '' ?>" style="background-color: #f2f2f2;; color: #000;" readonly>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ap. Materno</label>
                    <input type="text" class="form-control" name="ap_materno" value="<?= isset($obj) ? $obj['ap_materno'] : '' ?>" style="background-color: #f2f2f2;; color: #000;" readonly>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>F. Nacimiento</label>
                    <input type="date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Date of Birth" name="fechaNac" value="<?= isset($obj) ? $obj['fecha_nac'] : '' ?>" style="background-color: #f2f2f2;; color: #000;" readonly>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label>C.I.</label>
                    <input type="text" class="form-control" name="ci" value="<?= isset($obj) ? $obj['dni'] : '' ?>" style="background-color: #f2f2f2;; color: #000;" readonly>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <label>Extensión CI</label>
                    <select class="form-control show-tick" name="extension" style="background-color: #f2f2f2;; color: #000; pointer-events: none;" readonly>
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
                    <select class="form-control show-tick" name="genero" style="background-color: #f2f2f2;; color: #000; pointer-events: none;" readonly>
                        <option value="" disabled>-- Seleccionar --</option>
                        <option value="1" <?= $id_select == '1' ? 'selected' : '' ?>>Másculino</option>
                        <option value="0" <?= $id_select == '0' ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="<?= isset($obj) ? $obj['direccion'] : '' ?>" style="background-color: #f2f2f2;; color: #000; pointer-events: none;" readonly>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nacionalidad</label>
                    <input type="text" class="form-control" name="nacionalidad" value="<?= isset($obj) ? $obj['nacionalidad'] : '' ?>" style="background-color: #f2f2f2;; color: #000;" readonly>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Tutor</label>
                    <?php $id_select = isset($obj['id_dep']) ? $obj['id_dep'] : '' ?>
                    <select class="form-control show-tick" name="tutor" style="background-color: #f2f2f2;; color: #000; pointer-events: none;">
                        <option value="" selected>-- Ninguno --</option>
                        <?php if (isset($tutor_list)) : ?>
                            <?php foreach ($tutor_list as $key => $value) : ?>
                                <option value=<?= $value['id_tutor'] ?> <?= $id_select == $value['id_tutor'] ? 'selected' : '' ?>><?= $value['nombres'].' '.$value['ap_paterno'].' '.$value['ap_materno'] ?></option>
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
                    <label for="imageEstudiante">Subir Comprobante <span class="breadcrumb-item active">(PNG o JPEG, Max. 10MB)</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageUser<?= (isset($obj)) ? 'Edit' : 'Reg' ?>" name="imageEstudiante" onchange="previsualizar('<?= (isset($obj)) ? 'Edit' : 'Reg' ?>')">
                            <input type="hidden" value="<?= isset($obj['foto']) ? $obj['foto'] : '' ?>" name="imagenActual">
                            <label class="custom-file-label" for="imageEstudiante">Elija una foto</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Subir</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="form-group">
                    <img src="<?= base_url() ?>assets/dist/img/estudiantes/<?= (isset($obj['foto']) && file_exists(FCPATH . 'assets/dist/img/estudiantes/' . $obj['foto'])) ? $obj['foto'] : 'user_default.png' ?>" alt="" width="200" class="img-thumbnail previsualizar">
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    <?php endif; ?>
</form>

<script>
    $(function() {

        $.validator.setDefaults({
            submitHandler: function() {
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