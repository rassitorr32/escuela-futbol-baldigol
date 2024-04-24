<style>
    /* Estilos para resaltar el texto seleccionado en un input específico   */
    #FEditUsuario input[type="text"]::selection {
        background-color: #007bff;
        /* Cambia el color de fondo de la selección (WebKit/Blink)   */
        color: #ffffff;
        /* Cambia el color del texto de la selección (WebKit/Blink)  */
    }
</style>
<form id="<?= (isset($obj)) ? 'FEditUsuario' : 'FRegUsuario' ?>" enctype="multipart/form-data">
    <?php if (isset($obj)) : ?>
        <div class="modal-header bg-success">
            <h4 class="modal-title" style="color: white;"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <?php endif; ?>
        <?= csrf_field() ?>
        <input type="hidden" name="id_usuario" value="<?= (isset($obj)) ? $obj['id_usuario'] : '' ?>">
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
                    <label>Apellido Paterno</label>
                    <input type="text" class="form-control" name="ap_paterno" value="<?= isset($objPersona) ? $objPersona['ap_paterno'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Apellido Materno</label>
                    <input type="text" class="form-control" name="ap_materno" value="<?= isset($objPersona) ? $objPersona['ap_materno'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>F. Nacimiento</label>
                    <input type="date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Date of Birth" name="fechaNac" value="<?= isset($objPersona) ? $objPersona['fecha_nac'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>C.I.</label>
                    <input type="text" class="form-control" name="ci" value="<?= isset($objPersona) ? $objPersona['dni'] : '' ?>">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
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
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Género</label>
                    <?php $id_select = isset($objPersona) ? $objPersona['sexo'] : '' ?>
                    <select class="form-control show-tick" name="genero">
                        <option value="" selected disabled>-- Seleccionar --</option>
                        <option value="1" <?= $id_select == '1' ? 'selected' : '' ?>>Másculino</option>
                        <option value="0" <?= $id_select == '0' ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Rol(sistema)</label>
                    <?php $id_select = isset($obj) ? $obj['id_rol'] : '' ?>
                    <select class="form-control show-tick" name="rol">
                        <option value="" disabled<?= $id_select == '' ? ' selected' : '' ?>>-- Seleccionar --</option>
                        <option value="1" <?= $id_select == '1' ? 'selected' : '' ?>>Administrador</option>
                        <option value="2" <?= $id_select == '2' ? 'selected' : '' ?>>Profesor</option>
                        <option value="3" <?= $id_select == '3' ? 'selected' : '' ?>>Cajero</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Cargo</label>
                    <?php $id_select = isset($obj) ? $obj['id_cargo'] : '' ?>
                    <select class="form-control show-tick" name="cargo">
                        <option value="" disabled<?= $id_select == '' ? ' selected' : '' ?>>-- Seleccionar --</option>
                        <option value="1" <?= $id_select == '1' ? 'selected' : '' ?>>Profesor</option>
                        <option value="2" <?= $id_select == '2' ? 'selected' : '' ?>>Preparador Físico</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="imageUser">Imagen <span class="breadcrumb-item active">(Max. 10MB)</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageUser<?= (isset($obj)) ? 'Edit' : 'Reg' ?>" name="imageUser" onchange="previsualizar('<?= (isset($obj)) ? 'Edit' : 'Reg' ?>')">
                            <input type="hidden" value="<?= isset($objPersona) ? $objPersona['foto'] : '' ?>" name="imagenActual">
                            <label class="custom-file-label" for="imageUser">Elija una foto</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="form-group">
                    <img src="<?= base_url() ?>assets/dist/img/personal/<?= (isset($objPersona['foto']) && file_exists(FCPATH . 'assets/dist/img/personal/' . $objPersona['foto'])) ? $objPersona['foto'] : 'user_default.png' ?>" alt="" width="200" class="img-thumbnail previsualizar">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Nombre de Usuario</label>
                    <input type="text" class="form-control" name="usuario" value="<?= isset($obj) ? $obj['usuario'] : '' ?>">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" id="contraseña<?= (isset($obj)) ? 'Edit' : 'Reg' ?>" class="form-control" name="contraseña" value="<?= isset($obj) ? $obj['contraseña'] : '' ?>">
                    <input type="hidden" value="<?= isset($obj) ? $obj['contraseña'] : '' ?>" name="contraseñaActual">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="contraseña2" value="<?= isset($obj) ? $obj['contraseña'] : '' ?>">
                </div>
            </div>
            <?php if (!isset($obj)) : ?>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($obj)) : ?>
        </div>
        <?php if (session()->get('leftbar_link') != 'Perfil') : ?>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        <?php else : ?>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</form>

<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                // Deshabilitar el botón de submit para evitar envíos múltiples
                $('#FRegUsuario button[type="submit"]').attr('disabled', 'disabled');
                // Opcional: Cambiar el texto del botón a "Enviando..."
                $('#FRegUsuario button[type="submit"]').html('Enviando...');
                Store("<?= base_url() ?>usuario/store", "<?= base_url() ?><?= (session()->get('leftbar_link') != 'Perfil')? 'usuario' :'perfil' ?>", '#<?= (isset($obj)) ? 'FEditUsuario' : 'FRegUsuario' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditUsuario' : 'FRegUsuario' ?>').validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 3,
                },
                ap_paterno: {
                    required: true,
                    minlength: 3,
                },
                usuario: {
                    required: true,
                    minlength: 3,
                    // Agrega una regla de validación personalizada para verificar si el usuario ya existe
                    remote: {
                        url: "usuario/verificarUsuarioRepetidoJSON",
                        type: "POST",
                        // processData: false,
                        // contentType: false,
                        data: {
                            usuario: function() {
                                return $('#<?= (isset($obj)) ? 'FEditUsuario' : 'FRegUsuario' ?>').find("input[name='usuario']").val();
                            },
                            usuarioActual: function() {
                                return '<?= isset($obj) ? $obj['usuario'] : '' ?>';
                            }
                        }
                    }
                },
                ci: {
                    required: true
                },
                cargo: {
                    required: true
                },
                fechaNac: {
                    required: true,
                },
                genero: {
                    required: true
                },
                rol: {
                    required: true
                },
                cargo: {
                    required: true
                },
                contraseña: {
                    required: true,
                    minlength: 5
                },
                contraseña2: {
                    required: true,
                    equalTo: "#contraseña<?= (isset($obj)) ? 'Edit' : 'Reg' ?>"
                }
            },
            messages: {
                usuario: {
                    remote: "Este nombre de usuario ya está en uso."
                },
                contraseña2: {
                    equalTo: "La contraseña no coincide"
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