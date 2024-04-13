<!-- Start Main leftbar navigation -->
<div id="left-sidebar" class="sidebar" style="z-index: 9;">
    <h5 class="brand-name">Escuela-Futbol<a href="javascript:void(0)" class="menu_option float-right<?= session('configuracion')['grid_menu'] == '1' ? ' active' : '' ?>"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link <?= session()->get('leftbar_section') == 'Escuela' ? 'active' : '' ?>" data-toggle="tab" href="#menu-uni">Escuela</a></li>
        <?php if (session('usuario')['id_rol'] == '1') : ?>
            <li class="nav-item"><a class="nav-link <?= session()->get('leftbar_section') == 'Admin' ? 'active' : '' ?>" data-toggle="tab" href="#menu-admin">Admin</a></li>
        <?php endif; ?>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade <?= session()->get('leftbar_section') == 'Escuela' ? 'show active' : '' ?>" id="menu-uni" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu<?= session('configuracion')['grid_menu'] == '1' ? ' grid' : '' ?>">
                    <li <?= session()->get('leftbar_link') == 'Panel' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i><span>Panel</span></a></li>
                    <li <?= session()->get('leftbar_link') == 'Estudiante' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>Estudiante"><i class="fa fa-users"></i><span>Estudiantes</span></a></li>
                    <li <?= session()->get('leftbar_link') == 'Tutor' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>tutor"><i class="fa fa-male"></i><span>Tutores</span></a></li>
                    <li <?= session()->get('leftbar_link') == 'Calendario' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>Calendario"><i class="fa fa-calendar"></i><span>Calendario</span></a></li>
                    <li <?= session()->get('leftbar_link') == 'Pago' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>pago"><i class="fa fa-credit-card"></i><span>Pagos</span></a></li>
                </ul>
            </nav>
        </div>
        <?php if (session('usuario')['id_rol'] == '1') : ?>
            <div class="tab-pane fade <?= session()->get('leftbar_section') == 'Admin' ? 'show active' : '' ?>" id="menu-admin" role="tabpanel">
                <nav class="sidebar-nav">
                    <ul class="metismenu<?= session('configuracion')['grid_menu'] == '1' ? ' grid' : '' ?>">
                        <li <?= session()->get('leftbar_link') == 'Usuario' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>Usuario"><i class="fa fa-user-circle-o"></i><span>Personal</span></a></li>
                        <!-- <li><a href="noticeboard.html"><i class="fa fa-dashboard"></i><span>Noticeboard</span></a></li> -->
                        <li <?= session()->get('leftbar_link') == 'Categoria' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>categoria"><i class="fa fa-list-ul"></i><span>Categoría</span></a></li>
                        <li <?= session()->get('leftbar_link') == 'Complejo' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>complejo"><i class="fa fa-building" style="color:<?= session('configuracion')['iconcolor'] == '1' ? '#17a2b8' : 'rgba(255, 255, 255, 0.9)' ?>"></i><span>Complejo</span></a></li>
                        <li <?= session()->get('leftbar_link') == 'Area' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>area"><i class="fa fa-map-pin fa-credit-card"></i><span>Area</span></a></li>
                        <li <?= session()->get('leftbar_link') == 'Turno' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>turno"><i class="fa fa-clock-o" style="color:<?= session('configuracion')['iconcolor'] == '1' ? '#21ba45' : 'rgba(255, 255, 255, 0.9)' ?>"></i><span>Turno</span></a></li>
                        <li <?= session()->get('leftbar_link') == 'Servicio' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>servicio"><i class="fa fa-flag"></i><span>Servicio</span></a></li>
                        <li <?= session()->get('leftbar_link') == 'Servicio' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>costo"><i class="fa fa-money" style="color:<?= session('configuracion')['iconcolor'] == '1' ? '#17a2b8' : 'rgba(255, 255, 255, 0.9)' ?>"></i><span>Costo</span></a></li>
                        <li <?= session()->get('leftbar_link') == 'Temporada' ? 'class="active"' : '' ?>><a href="<?= base_url() ?>temporada"><i class="fa fa-calendar-check-o"></i><span>Temporada</span></a></li>
                        <!-- <li><a href="setting.html"><i class="fa fa-gear"></i><span>Settings</span></a></li> -->
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.menu_option').click(function() {
            var formData = new FormData(); // Obtener el valor de choose-skin
            // var chooseSkin = $('.choose-skin li.active').attr('data-theme');
            // Verificar si el elemento tiene la clase "active"
            if (!this.classList.contains('active')) {
                // La clase "active" está presente en el elemento
                formData.append('grid_menu', 'on');
            } else {
                // La clase "active" no está presente en el elemento
                formData.append('grid_menu', 'off');
            }
            // Agregar el valor de choose-skin al formData

            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>configuracion/storeGridMenu',
                data: formData,
                cache: false, //vacie el cache
                contentType: false,
                processData: false,
                success: function(response) {
                    // Configuración guardada exitosamente
                    console.log('Configuración grid_menu guardada exitosamente.');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Error al guardar la configuración
                    console.error('Error al guardar la configuración.');
                }
            });
        });
    });
</script>
<!-- Start project content area -->
<div class="page">