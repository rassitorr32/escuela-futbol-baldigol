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
                    <label>Area</label>
                    <?php $id_select = isset($obj) ? $obj['id_area'] : '' ?>
                    <select class="form-control show-tick" name="area">
                        <option value="" disabled selected>-- Seleccionar --</option>
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
                    <select class="form-control show-tick" name="servicio">
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
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                Store("<?= base_url() ?>temporada/store", "<?= base_url() ?>temporada", '#<?= (isset($obj)) ? 'FEditTemporada' : 'FRegTemporada' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditTemporada' : 'FRegTemporada' ?>').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3,
                },
                descripcion: {
                    required: true,
                    minlength: 3,
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