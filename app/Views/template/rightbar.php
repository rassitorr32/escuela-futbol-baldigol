<!-- Start Rightbar setting panel -->
<div id="rightsidebar" class="right_sidebar">
    <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings" aria-expanded="true">Settings</a></li>
        <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity" aria-expanded="false">Activity</a></li> -->
    </ul>
    <div class="tab-content">
        <form id="FEditConfiguracion" enctype="multipart/form-data">
            <div role="tabpanel" class="tab-pane vivify fadeIn active" id="Settings" aria-expanded="true">
                <?= csrf_field() ?>
                <input type="hidden" name="id_usuario" value="<?= session('usuario')['id_usuario'] ?>">
                <input type="hidden" name="id_configuracion" value="<?= session('configuracion')['id_configuracion'] ?>">
                <div class="mb-4">
                    <h6 class="font-14 font-weight-bold text-muted">Theme Color</h6>
                    <ul class="choose-skin list-unstyled mb-0">
                        <li data-theme="azure" <?= session('configuracion')['choose-skin'] == 'azure' ? 'class="active"' : '' ?>>
                            <div class="azure"></div>
                        </li>
                        <li data-theme="indigo" <?= session('configuracion')['choose-skin'] == 'indigo' ? 'class="active"' : '' ?>>
                            <div class="indigo"></div>
                        </li>
                        <li data-theme="purple" <?= session('configuracion')['choose-skin'] == 'purple' ? 'class="active"' : '' ?>>
                            <div class="purple"></div>
                        </li>
                        <li data-theme="orange" <?= session('configuracion')['choose-skin'] == 'orange' ? 'class="active"' : '' ?>>
                            <div class="orange"></div>
                        </li>
                        <li data-theme="green" <?= session('configuracion')['choose-skin'] == 'green' ? 'class="active"' : '' ?>>
                            <div class="green"></div>
                        </li>
                        <li data-theme="cyan" <?= session('configuracion')['choose-skin'] == 'cyan' ? 'class="active"' : '' ?>>
                            <div class="cyan"></div>
                        </li>
                        <li data-theme="blush" <?= session('configuracion')['choose-skin'] == 'blush' ? 'class="active"' : '' ?>>
                            <div class="blush"></div>
                        </li>
                        <li data-theme="white" <?= session('configuracion')['choose-skin'] == 'white' ? 'class="active"' : '' ?>>
                            <div class="bg-white"></div>
                        </li>
                    </ul>
                </div>
                <div class="mb-4">
                    <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                    <div class="custom-controls-stacked font_setting">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-muli" <?= session('configuracion')['font_setting'] == 'font-muli' ? ' checked' : '' ?>>
                            <span class="custom-control-label">Muli Google Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-montserrat" <?= session('configuracion')['font_setting'] == 'font-montserrat' ? ' checked' : '' ?>>
                            <span class="custom-control-label">Montserrat Google Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-poppins" <?= session('configuracion')['font_setting'] == 'font-poppins' ? ' checked' : '' ?>>
                            <span class="custom-control-label">Poppins Google Font</span>
                        </label>
                    </div>
                </div>
                <div>
                    <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                    <ul class="setting-list list-unstyled mt-1 setting_switch">
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Night Mode</span>
                                <input type="hidden" name="custom-switch-checkbox[darkmode]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[darkmode]" class="custom-switch-input btn-darkmode" <?= session('configuracion')['darkmode'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <!-- <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Fix Navbar top</span>
                                <input type="hidden" name="custom-switch-checkbox[fixnavbar]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[fixnavbar]" class="custom-switch-input btn-fixnavbar" >
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li> -->
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Header Dark</span>
                                <input type="hidden" name="custom-switch-checkbox[pageheader]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[pageheader]" class="custom-switch-input btn-pageheader" <?= session('configuracion')['pageheader'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Min Sidebar Dark</span>
                                <input type="hidden" name="custom-switch-checkbox[min_sidebar]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[min_sidebar]" class="custom-switch-input btn-min_sidebar" <?= session('configuracion')['min_sidebar'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Sidebar Dark</span>
                                <input type="hidden" name="custom-switch-checkbox[sidebar]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[sidebar]" class="custom-switch-input btn-sidebar" <?= session('configuracion')['sidebar'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Icon Color</span>
                                <input type="hidden" name="custom-switch-checkbox[iconcolor]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[iconcolor]" class="custom-switch-input btn-iconcolor" <?= session('configuracion')['iconcolor'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Gradient Color</span>
                                <input type="hidden" name="custom-switch-checkbox[gradient]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[gradient]" class="custom-switch-input btn-gradient" <?= session('configuracion')['gradient'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <!-- <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Box Shadow</span>
                                <input type="hidden" name="custom-switch-checkbox[boxshadow]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[boxshadow]" class="custom-switch-input btn-boxshadow" >
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li> -->
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">RTL Support</span>
                                <input type="hidden" name="custom-switch-checkbox[rtl]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[rtl]" class="custom-switch-input btn-rtl" <?= session('configuracion')['rtl'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Box Layout</span>
                                <input type="hidden" name="custom-switch-checkbox[boxlayout]" value="off">
                                <input type="checkbox" name="custom-switch-checkbox[boxlayout]" class="custom-switch-input btn-boxlayout" <?= session('configuracion')['boxlayout'] == '1' ? ' checked' : '' ?>>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="form-group">
                    <button type="button" id="btn-save-changes" class="btn btn-primary btn-block mt-3 btn-save-changes">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#btn-save-changes').click(function() {
            saveConfiguration();
        });

        function saveConfiguration() {
            var formData = new FormData($('#FEditConfiguracion')[0]); // Obtener el valor de choose-skin
            var chooseSkin = $('.choose-skin li.active').attr('data-theme');

            // Agregar el valor de choose-skin al formData
            formData.append('choose-skin', chooseSkin);

            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>configuracion/store',
                data: formData,
                cache: false, //vacie el cache
                contentType: false,
                processData: false,
                // beforeSend: function(response) {
                //     xhr.setRequestHeader('X-CSRF-TOKEN', '<?= csrf_token() ?>');
                // },
                success: function(response) {
                    // Ocultar el rightsidebar
                    $('#rightsidebar').removeClass('open');
                    // Configuración guardada exitosamente
                    console.log('Configuración guardada exitosamente.');
                    console.log(response);
                    if (response == 'ok') {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Estado cambiado con exito!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Ups...",
                            text: "¡Algo salió mal!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Error al guardar la configuración
                    console.error('Error al guardar la configuración.');
                }
            });
        }
    });

    //     }
    // });

    // Obtener todos los elementos de interruptores (switches)
    var switches = document.querySelectorAll('.custom-switch-input');

    // Iterar sobre cada interruptor y agregar un evento de cambio
    switches.forEach(function(switchElement) {
        switchElement.addEventListener('change', function() {
            // Obtener la clase personalizada del interruptor
            var classList = this.classList;

            // Iterar sobre las clases del interruptor
            classList.forEach(function(className) {
                // Verificar si la clase comienza con 'btn-'
                if (className.startsWith('btn-')) {
                    if (className == 'btn-iconcolor') {
                        var iconoComplejo = document.querySelector(".fa-building"); // Seleccionar todos los elementos con la clase "iconoComplejo"
                        var iconoTurno = document.querySelector(".fa-clock-o");
                        var colorDefecto ="rgba(255, 255, 255, 0.9)";
                            if ((switchElement.checked ? 'Activado' : 'Desactivado')=="Desactivado") {
                                iconoComplejo.style.color = colorDefecto;
                                iconoTurno.style.color = colorDefecto;
                            }else{
                                iconoComplejo.style.color = "#17a2b8";
                                iconoTurno.style.color = "#21ba45";
                            }
                    }
                    // Enviar la clase y el estado del interruptor
                    console.log(className + ': ' + (switchElement.checked ? 'Activado' : 'Desactivado'));
                    // Aquí puedes hacer lo que desees con la clase y el estado, como enviarlos a través de una solicitud AJAX, etc.
                }
            });
        });
    });

    // Obtener todos los elementos de radio en el grupo de opciones de fuente
    var fontRadios = document.querySelectorAll('.custom-controls-stacked input[type="radio"]');

    // Iterar sobre cada radio y agregar un evento de cambio
    fontRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Obtener el valor del radio seleccionado
            var fontValue = this.value;

            // Imprimir el valor del radio seleccionado
            console.log('Fuente seleccionada:', fontValue);
            // Aquí puedes hacer lo que desees con el valor de la fuente, como enviarlo a través de una solicitud AJAX, etc.
        });
    });

    // Obtener todos los elementos de la lista de temas
    var themeItems = document.querySelectorAll('.choose-skin li');
    // Iterar sobre cada elemento de tema y agregar un evento de clic
    themeItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Obtener el tema seleccionado
            var selectedTheme = this.getAttribute('data-theme');

            // Establecer el tema seleccionado (podrías tener tu propia función para hacer esto)
            // setTheme(selectedTheme);

            // Imprimir el tema seleccionado
            console.log('Tema seleccionado:', selectedTheme);
            // Aquí puedes hacer lo que desees con el tema seleccionado, como aplicarlo a tu página, etc.
        });
    });

    // Función para bloquear o desbloquear un botón según una variable booleana
    function toggleButton(buttonClass, isEnabled) {
        // Obtener el botón por su clase
        var button = document.querySelector('.' + buttonClass);

        // Verificar si el botón y la variable están definidos
        if (button && isEnabled !== undefined) {
            // Bloquear el botón si isEnabled es false, de lo contrario, desbloquearlo
            if (isEnabled) {
                button.removeAttribute('disabled');
            } else {
                button.setAttribute('disabled', 'disabled');
            }
        }
    }
</script>