<!-- <style>
    .mt-100 {
        margin-top: 100px
    }

    body {
        background: #00B4DB;
        background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
        background: linear-gradient(to right, #0083B0, #00B4DB);
        color: #514B64;
        min-height: 100vh
    }

    .select-container {
        position: relative;
        z-index: 2;
        /* Asegura que esté por encima del input file y otros elementos */
    }

    /* Ajusta el z-index del input file para que sea inferior al del select múltiple */
    .custom-file {
        z-index: 1;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script> -->
<form id="<?= (isset($obj)) ? 'FEditTutor' : 'FRegTutor' ?>" enctype="multipart/form-data">
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
        <input type="hidden" name="id_tutor" value="<?= (isset($obj)) ? $obj['id_tutor'] : '' ?>">
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
                    <select class="form-control show-tick" name="extension">
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
            <!-- <div class="col-md-12 col-sm-12">
                <div class="select-container">
                    <div class="form-group">
                        <label for="selectItems">Selecciona los elementos:</label>
                        <select id="choices-multiple-remove-button" placeholder="Select upto 5 tags" multiple>
                        </select>
                    </div>
                </div>
            </div> -->
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
                    <label for="imageTutor">Imagen <span class="breadcrumb-item active">(Max. 10MB)</span></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageUser<?= (isset($obj)) ? 'Edit' : 'Reg' ?>" name="imageTutor" onchange="previsualizar('<?= (isset($obj)) ? 'Edit' : 'Reg' ?>')">
                            <input type="hidden" value="<?= isset($objPersona['foto']) ? $objPersona['foto'] : '' ?>" name="imagenActual">
                            <label class="custom-file-label" for="imageTutor">Elija una foto</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Subir</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="form-group">
                    <img src="<?= base_url() ?>assets/dist/img/tutores/<?= (isset($objPersona['foto']) && file_exists(FCPATH . 'assets/dist/img/estudiantes/' . $objPersona['foto'])) ? $objPersona['foto'] : 'user_default.png' ?>" alt="" width="200" class="img-thumbnail previsualizar">
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
        //         const element = document.getElementById('choices-multiple-remove-button');
        // const example = new Choices(element);

        // element.addEventListener(
        //   'addItem',
        //   function(event) {
        //     // do something creative here...
        //     console.log(event.detail.id);
        //     console.log(event.detail.value);
        //     console.log(event.detail.label);
        //     console.log(event.detail.customProperties);
        //     console.log(event.detail.groupValue);
        //   },
        //   false,
        // );

        // cargarSelectTutor();

        $.validator.setDefaults({
            submitHandler: function() {
                Store("<?= base_url() ?>tutor/store", "<?= base_url() ?>tutor", '#<?= (isset($obj)) ? 'FEditTutor' : 'FRegTutor' ?>');
            }
        });
        $('#<?= (isset($obj)) ? 'FEditTutor' : 'FRegTutor' ?>').validate({
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

    // function cargarSelectTutor() {
    //     $.ajax({
    //         url: '<?= base_url('estudiante/getEstudiantes') ?>',
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             // console.log(response[1].id_tutor)
    //             // Aquí manejas la respuesta y llenas el select múltiple con los datos recibidos
    //             if (response) {
    //                 var select = $('#choices-multiple-remove-button');
    //                 //select.empty(); // Limpiar las opciones existentes
    //                 var arregloSelect = [];
    //                 // Iterar sobre las opciones recibidas y agregarlas al select
    //                 $.each(response, function(index, option) {
    //                     select.append($('<option>', {
    //                         value: option.id_tutor,
    //                         text: option.nombres,
    //                         selected: true
    //                     }));
    //                 });

    //                 // Inicializar el plugin Choices nuevamente después de cambiar las opciones
    //                 // Esto es necesario si estás usando el plugin Choices para el select múltiple
    //                 var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
    //                     removeItemButton: true,
    //                     maxItemCount: 5,
    //                     searchResultLimit: 5,
    //                     renderChoiceLimit: 5
    //                 });
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             // Manejar errores si la solicitud Ajax falla
    //             console.error('Error al cargar datos:', error);
    //         }
    //     });

    // }
</script>