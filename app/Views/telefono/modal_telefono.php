<div class="modal-header bg-info">
    <h4 class="modal-title"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <button type="button" class="btn btn-primary mb-3" id="showFormBtn"><i class="fa fa-plus"></i></button>
    <form id="telefonoForm" style="display: none;">
        <div class="form-row">
            <div class="col">
                <div class="form-group"><input type="text" class="form-control" id="numero" name="numero" placeholder="Número"></div>
            </div>
            <div class="col">
                <div class="form-group"><input type="text" class="form-control" id="cod_area" name="cod_area" placeholder="Código de Área"></div>
            </div>
            <div class="col">
                <div class="form-group"><input type="text" class="form-control" id="tipo_tel" name="tipo_tel" placeholder="Tipo de Teléfono"></div>
            </div>
            <input type="hidden" id="id_persona" name="id_persona" value="<?= isset($idPersona) ? $idPersona : '' ?>">
            <input type="hidden" id="id_telefono" name="id_telefono">
            <input type="hidden" id="telefonoIndex" name="telefonoIndex">
            <div class="col">
                <button type="submit" class="btn btn-primary">Agregar/Editar Teléfono</button>
                <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancelar</button>
            </div>
        </div>
        <br>
    </form>

    <div class="row justify-content-center">
        <h3>Teléfonos Agregados</h3>
        <div class="row" style="max-height: 300px; overflow-y: auto;">

            <?= $table ?>
        </div>
    </div>

</div>


</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {
        // Verificar si existe tbody dentro de la tabla
        if ($('#tableTelefono').find('tbody').length === 0) {
            // Si no existe tbody, agregarlo a la tabla
            $('#tableTelefono').append('<tbody id="telefonosBody"></tbody>');
        }

        // Mostrar formulario al hacer clic en "Agregar Teléfono"
        $("#showFormBtn").click(function() {
            $("#telefonoForm").toggle();
            $("#telefonoForm")[0].reset();
            $("#id_telefono").val("");
            $("#cancelEditBtn").hide();
        });

        // Función para agregar teléfono o editar teléfono existente
        $.validator.setDefaults({
            submitHandler: function(form) {
                var numero = $("#numero").val();
                var cod_area = $("#cod_area").val();
                var tipo_tel = $("#tipo_tel").val();
                var id_persona = $("#id_persona").val();
                var telefonoIndex = $("#telefonoIndex").val();

                var formData = new FormData(form); // Obtener los datos del formulario correctamente

                //Se oculta el formulario
                $("#telefonoForm").hide();

                $.ajax({
                    url: 'telefono/store',
                    method: 'POST',
                    processData: false, // No procesar los datos (ya que FormData los maneja)
                    contentType: false, // No establecer contentType (FormData también se encarga de esto)
                    data: formData,
                    success: function(obj) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Guardado exitoso",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        objTelefono = JSON.parse(obj);
                        if ($("#id_telefono").val() === "") {
                            $("#telefonosBody").append("<tr><td>" + $("#numero").val() + "</td><td>" + $("#cod_area").val() + "</td><td>" + $("#tipo_tel").val() + "</td><td><button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" + JSON.stringify({
                                idTelefono: objTelefono.id_telefono,
                                idPersona: $("#id_persona").val()
                            }) + "'>Eliminar</button> <button type='button' class='btn btn-primary btn-sm editBtn'>Editar</button></td></tr>");
                        } else {
                            // Editar teléfono existente
                            $("#telefonosBody").find("tr").eq(telefonoIndex).html("<td>" + objTelefono.numero + "</td><td>" + objTelefono.cod_area + "</td><td>" + objTelefono.tipo_tel + "</td><td><button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" + JSON.stringify({
                                idTelefono: objTelefono.id_telefono,
                                idPersona: objTelefono.id_persona
                            }) + "'>Eliminar</button> <button type='button' class='btn btn-primary btn-sm editBtn'>Editar</button></td>");
                        }
                        //resetea el formulario
                        $("#telefonoForm")[0].reset();
                        $("#id_telefono").val("");
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        $('#telefonoForm').validate({
            rules: {
                numero: {
                    required: true,
                    digits: true,
                    number: true
                },
                cod_area: {
                    required: true,
                    maxlength: 6,
                    digits: true,
                    number: true
                },
                tipo_tel: {
                    required: true,
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

        // Cancelar edición
        $("#cancelEditBtn").click(function() {
            $("#telefonoForm")[0].reset();
            $("#id_telefono").val("");
            $("#cancelEditBtn").hide();
            $("#telefonoForm").hide();
        });

        // Editar teléfono
        $(document).on("click", ".editBtn", function() {
            var currentRow = $(this).closest("tr");
            var idsObj = $(this).closest('tr').find('.deleteBtn').data('id');
            var telefono_id = idsObj.idTelefono; // Obtener el ID del teléfono
            var persona_id = idsObj.idPersona;
            var numero = currentRow.find("td").eq(0).text();
            var cod_area = currentRow.find("td").eq(1).text();
            var tipo_tel = currentRow.find("td").eq(2).text();
            var index = currentRow.index();

            // Completar el formulario de edición con los datos del teléfono seleccionado
            $("#numero").val(numero);
            $("#cod_area").val(cod_area);
            $("#tipo_tel").val(tipo_tel);
            $('#id_telefono').val(telefono_id);
            $("#id_persona").val(persona_id); // Si es necesario
            $("#telefonoIndex").val(index);
            $("#cancelEditBtn").show();
            $("#telefonoForm").show();
        });

        // Eliminar teléfono
        $(document).on("click", ".deleteBtn", function() {
            var deleteBtn = $(this); // Guardar referencia al botón de eliminar
            var idData = deleteBtn.data("id"); // Obtener los datos del atributo data-id
            var idTelefono = idData.idTelefono; // Obtener el id del teléfono de los datos
            Swal.fire({
                position: "top-end",
                title: "¿Está seguro?",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, elimínalo!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest("tr").remove();
                    var id = '';
                    let formData = '';
                    $.ajax({
                        url: 'telefono/delete/' + idTelefono,
                        method: 'POST',
                        data: formData,
                        success: function(obj) {
                            if (obj = 'ok') {
                                Swal.fire({
                                    position: "top-end",
                                    title: "Eliminado!",
                                    text: "El telefono ah sido eliminado.",
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Ups...",
                                    text: "¡Algo salió mal!",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            Swal.fire({
                                icon: "error",
                                title: "Ups...",
                                text: "¡Algo salió mal!",
                            });
                        }
                    });
                }
            });
        });
    });
</script>