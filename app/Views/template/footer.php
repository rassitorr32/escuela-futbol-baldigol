        <!-- Start main footer -->
        <div class="section-body">
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            Copyright © 2024 <a href="#">Luis Suarez</a>.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        </div>
        </div>

        <script> var baseUrl = "<?=base_url()?>"</script>
        <!-- Start Main project js, jQuery, Bootstrap -->
        <script src="<?= base_url() ?>assets/bundles/lib.vendor.bundle.js"></script>

        <!-- Start all plugin js -->
        <script src="<?= base_url() ?>assets/bundles/counterup.bundle.js"></script>
        <script src="<?= base_url() ?>assets/bundles/apexcharts.bundle.js"></script>
        <script src="<?= base_url() ?>assets/bundles/summernote.bundle.js"></script>

        <script src="<?= base_url() ?>assets/bundles/fullcalendar.bundle.js"></script>

        <!-- Start project main js  and page js -->
        <script src="<?= base_url() ?>assets/js/core.js"></script>
        <script src="<?= base_url() ?>assets/js/page/calendar.js"></script>
        <script src="<?= base_url() ?>assets/js/page/index.js"></script>
        <script src="<?= base_url() ?>assets/js/page/summernote.js"></script>
        <!-- SweetAlert2 -->
        <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

        <!-- js propios -->

        <script src="<?= base_url() ?>assets/js/crud.js"></script>
        <script src="<?= base_url() ?>assets/js/generateTable.js"></script>
        <?php
        // Obtener una instancia del enrutador
        $router = \Config\Services::router();

        // Obtener la ruta completa del controlador actual
        $rutaControlador = $router->controllerName();

        // Extraer solo el nombre del controlador de la ruta completa
        $controlador = basename($rutaControlador);
        ?>
        <?php
        $router = service('router');
        // Obtener el nombre del controlador actual
        $controllerName = $router->controllerName();
        // Extraer el nombre del controlador sin el namespace
        $controllerNameWithoutNamespace = class_basename($controllerName);
        ?>
        <script>
            generateTable('<?= isset($idTable)?$idTable:'table'.$controllerNameWithoutNamespace ?>','<?= isset($tituloTable)?$tituloTable:'' ?>');
        </script>

        <!-- Seccion de modals -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="content-lg">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- jquery-validation -->
        <script src="<?= base_url() ?>assets/plugins/jquery-validation/jquery.validate.js"></script>
        <script src="<?= base_url() ?>assets/plugins/jquery-validation/additional-methods.js"></script>
        <!-- mensajes de validacion en español -->
        <script src="<?= base_url() ?>assets/plugins/jquery-validation/localization/messages_es.js"></script>

        <script src="<?= base_url() ?>assets/plugins/select2/select2.js"></script>
        </body>

        </html>