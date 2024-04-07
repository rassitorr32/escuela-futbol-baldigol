<div class="modal-header btn-primary">
    <h4 class="modal-title"><i class="<?= $title['icon'] ?? '' ?>"></i> <?= $title['page'] ?? '' ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <button type="button" class="btn btn-primary mb-3" id="showFormBtn"><i class="fa fa-plus"></i></button>
    <form id="costoForm" style="display: none;">
        <div class="form-row">
            <div class="col">
                <div class="form-group"><input type="text" class="form-control" id="tipo_costo" name="tipo_costo" placeholder="Tipo"></div>
            </div>
            <div class="col">
                <div class="form-group"><input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio"></div>
            </div>
            <div class="col">
                <div class="form-group"><input type="date" class="form-control" id="fecha_final" name="fecha_final" placeholder="Fecha Final"></div>
            </div>
            <div class="col">
                <div class="form-group"><input type="number" step="0.01" min="0" name="valor" id="valor" placeholder="Ingrese el precio"></div>
            </div>
            <input type="hidden" id="id_servicio" name="id_servicio" value="<?= isset($idServicio) ? $idServicio : '' ?>">
            <input type="hidden" id="id_costo" name="id_costo">
            <input type="hidden" id="costoIndex" name="costoIndex">
            <div class="col">
                <button type="submit" class="btn btn-primary">Agregar/Editar Costo</button>
                <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancelar</button>
            </div>
        </div>
        <br>
    </form>

    <div class="row justify-content-center">
        <h3>Costos Agregados</h3>
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
        if ($('#tableCosto').find('tbody').length === 0) {
            // Si no existe tbody, agregarlo a la tabla
            $('#tableCosto').append('<tbody id="costosBody"></tbody>');
        }

        // Mostrar formulario al hacer clic en "Agregar Teléfono"
        $("#showFormBtn").click(function() {
            $("#costoForm").toggle();
            $("#costoForm")[0].reset();
            $("#id_costo").val("");
            $("#cancelEditBtn").hide();
        });

        // Función para agregar teléfono o editar teléfono existente
        $.validator.setDefaults({
            submitHandler: function(form) {
                var tipo_costo = $("#tipo_costo").val();
                var fecha_inicio = $("#fecha_inicio").val();
                var fecha_final = $("#fecha_final").val();
                var valor = $("#valor").val();
                var id_servicio = $("#id_servicio").val();
                var costoIndex = $("#costoIndex").val();

                var formData = new FormData(form); // Obtener los datos del formulario correctamente

                //Se oculta el formulario
                $("#costoForm").hide();

                $.ajax({
                    url: 'costo/store',
                    method: 'POST',
                    processData: false, // No procesar los datos (ya que FormData los maneja)
                    contentType: false, // No establecer contentType (FormData también se encarga de esto)
                    data: formData,
                    success: function(obj) {
                        console.log(obj)
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Guardado exitoso",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        objCosto = JSON.parse(obj);
                        
                        console.log(objCosto)
                        if ($("#id_costo").val() === "") {
                            $("#costosBody").append("<tr><td>" + $("#tipo_costo").val() + "</td><td>" + $("#fecha_inicio").val() + "</td><td>" + $("#fecha_final").val() + "</td><td>" + $("#valor").val() + "</td><td><button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" + JSON.stringify({
                                idCosto: objCosto.id_costo,
                                idServicio: $("#id_servicio").val()
                            }) + "'>Eliminar</button> <button type='button' class='btn btn-primary btn-sm editBtn'>Editar</button></td></tr>");
                        } else {
                            // Editar teléfono existente
                            $("#costosBody").find("tr").eq(costoIndex).html("<td>" + objCosto.tipo_costo + "</td><td>" + objCosto.fecha_inicio + "</td><td>" + objCosto.fecha_final + "</td><td>" + objCosto.valor + "</td><td><button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" + JSON.stringify({
                                idCosto: objCosto.id_costo,
                                idServicio: objCosto.id_servicio
                            }) + "'>Eliminar</button> <button type='button' class='btn btn-primary btn-sm editBtn'>Editar</button></td>");
                        }
                        //resetea el formulario
                        $("#costoForm")[0].reset();
                        $("#id_costo").val("");
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        $('#costoForm').validate({
            rules: {
                tipo_costo: {
                    required: true,
                },
                fecha_inicio: {
                    required: true,
                },
                fecha_final: {
                    required: true,
                },
                valor: {
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
            $("#costoForm")[0].reset();
            $("#id_costo").val("");
            $("#cancelEditBtn").hide();
            $("#costoForm").hide();
        });

        // Editar teléfono
        $(document).on("click", ".editBtn", function() {
            var currentRow = $(this).closest("tr");
            var idsObj = $(this).closest('tr').find('.deleteBtn').data('id');
            var costo_id = idsObj.idCosto; // Obtener el ID del teléfono
            var persona_id = idsObj.idServicio;
            var tipo_costo = currentRow.find("td").eq(0).text();
            var fecha_inicio = currentRow.find("td").eq(1).text();
            var fecha_final = currentRow.find("td").eq(2).text();
            var valor = currentRow.find("td").eq(3).text();
            var index = currentRow.index();

            // Completar el formulario de edición con los datos del teléfono seleccionado
            $("#tipo_costo").val(tipo_costo);
            $("#fecha_inicio").val(fecha_inicio);
            $("#fecha_final").val(fecha_final);
            $("#valor").val(valor);
            $('#id_costo').val(costo_id);
            $("#id_servicio").val(persona_id); // Si es necesario
            $("#costoIndex").val(index);
            $("#cancelEditBtn").show();
            $("#costoForm").show();
        });

        // Eliminar teléfono
        $(document).on("click", ".deleteBtn", function() {
            var deleteBtn = $(this); // Guardar referencia al botón de eliminar
            var idData = deleteBtn.data("id"); // Obtener los datos del atributo data-id
            var idCosto = idData.idCosto; // Obtener el id del teléfono de los datos
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
                        url: 'costo/delete/' + idCosto,
                        method: 'POST',
                        data: formData,
                        success: function(obj) {
                            if (obj = 'ok') {
                                Swal.fire({
                                    position: "top-end",
                                    title: "Eliminado!",
                                    text: "El costo ah sido eliminado.",
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