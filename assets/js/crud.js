//Abrir el formulario para editar
function Edit(url, id) {

    let obj = "";
    // Muestra el indicador de carga antes de la solicitud AJAX
    $("#modal-lg").modal("show");
    $("#content-lg").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');

    $.ajax({
        type: "POST",
        url: url + '/' + (id != null ? id : ''),
        data: obj,
        success: function (data) {
            $("#content-lg").html(data);
        },
        error: function (e) {
            Swal.fire({
                icon: 'error',
                title: e.responseJSON.message,
                showConfirmButton: false,
                timer: 1000
            });

            setTimeout(function () {
                //location.reload();
            }, 1200);
        },
    });
}

function Store(urlStore, urlModulo, idForm) {
    let formData = new FormData($(idForm)[[0]]);
    // console.log(formData.get("username"));
    $.ajax({
        type: "POST",
        url: urlStore,
        data: formData,
        cache: false, //vacie el cache
        contentType: false,
        processData: false,
        success: function (message) {
            console.log(message);
            window.location.href = urlModulo;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar el error de la petición Ajax
            console.error("Error en la petición Ajax:", errorThrown);
        }
    });
}
function cambiarEstado(elemento, url, id) {
    var obj = new FormData();

    // Agregar los campos nombre y apellido al objeto FormData
    obj.append('estado', (elemento.textContent == 'Activo' ? 0 : 1));
    // formData.append('apellido', $('[name="apellido"]').val());


    Swal.fire({
        title: 'Estás seguro de cambiar el estado?',
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        denyButtonText: "Cancelar",
        buttonsStyling: true, // Mantener el estilo predeterminado de los botones
        customClass: {
            confirmButton: 'btn btn-primary', // Clase personalizada para el botón de confirmación
            cancelButton: 'btn btn-outline-secondary' // Clase personalizada para el botón de cancelación
        }
    }).then((result) => {//captura el resultado 
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url + '/' + id,
                processData: false, // Evitar que jQuery procese los datos
                contentType: false, // No establecer el tipo de contenido
                data: obj,
                success: function (data) {
                    if (elemento.textContent == 'Activo') {
                        $(elemento).text("Inactivo");
                        $(elemento).removeClass().addClass('btn btn-danger');
                    }
                    else if (elemento.textContent == 'Inactivo') {
                        $(elemento).text("Activo");
                        $(elemento).removeClass().addClass('btn btn-success');
                    }
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Estado cambiado con exito!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // $("#modal-lg").modal("show");
                    // $("#content-lg").html(data);
                    console.log(data);
                }
            });
        }
    });
}

//Previsualizar la imagen
function previsualizar(accion) {
    let image = document.getElementById("imageUser" + accion).files[0];

    if (image["type"] != "image/jpeg" && image["type"] != "image/png") {
        $("#imageUser" + accion).val("");
        Swal.fire({
            icon: 'error',
            title: 'La imagen debe estar en formato PNG o JPEG',
            showConfirmButton: true
        });
    } else if (image["size"] > 10000000) {
        $("#imageUser" + accion).val("");
        Swal.fire({
            icon: 'error',
            title: 'La imagen no puede superar 10MB',
            showConfirmButton: true
        });
    } else {
        let dataImage = new FileReader;
        dataImage.readAsDataURL(image);//para cargar el binario de la imagen

        $(dataImage).on("load", function (event) {
            let routeImage = event.target.result;
            $(".previsualizar").attr("src", routeImage);
        })//cuando se cargue la imagen
    }
    console.log(image);
}

/**Ver el usuario en un modal */
function verItem(url, id) {

    let obj = "";
    // Muestra el indicador de carga antes de la solicitud AJAX
    $("#modal-lg").modal("show");
    $("#content-lg").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');

    $.ajax({
        type: "POST",
        url: url + '/' + id,
        data: obj,
        success: function (data) {
            $("#content-lg").html(data);
        },
        error: function (e) {
            Swal.fire({
                icon: 'error',
                title: e.responseJSON.message,
                showConfirmButton: false,
                timer: 1000
            });

            setTimeout(function () {
                //location.reload();
            }, 1200);
        },
    });
}