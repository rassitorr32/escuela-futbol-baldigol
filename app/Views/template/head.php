<!doctype html>
<html lang="en" dir="ltr" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <title>Escuela de Futbol</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Plugins css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/dist/summernote.css" />


    <!-- Core css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.min.css" />

    <!-- jquery -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery-3.4.1.min.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">
</head>

<style>
    body {
    height: 100vh; /* 100% del viewport height */
    margin: 0; /* Eliminar margen por defecto */
    padding: 0; /* Eliminar padding por defecto */
}

</style>

<body class="<?=session('configuracion')['font_setting']?> theme-<?=session('configuracion')['choose-skin']?> <?= session('configuracion')['darkmode'] == '1' ? 'dark-mode' : '' ?> <?= session('configuracion')['gradient'] == '1' ? 'gradient' : '' ?> <?= session('configuracion')['sidebar'] == '1' ? 'sidebar_dark' : '' ?> <?= session('configuracion')['rtl'] == '1' ? 'rtl' : '' ?> <?= session('configuracion')['boxlayout'] == '1' ? 'boxlayout' : '' ?> <?= session('configuracion')['iconcolor'] == '1' ? 'iconcolor' : '' ?>">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>

    <div id="main_content">
        <!-- Start Main top header -->
        <div id="header_top" class="header_top <?= session('configuracion')['min_sidebar'] == '1' ? 'dark' : '' ?>">
            <div class="container">
                <div class="hleft">
                    <a class="header-brand" href="<?= base_url() ?>"><i class="fa fa-futbol-o brand-logo"></i></a>
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fe fe-align-center"></i></a>
                        <!-- <a href="page-search.html" class="nav-link icon"><i class="fe fe-search" data-toggle="tooltip" data-placement="right" title="Search..."></i></a>
                        <a href="app-email.html" class="nav-link icon app_inbox"><i class="fe fe-inbox" data-toggle="tooltip" data-placement="right" title="Inbox"></i></a>
                        <a href="app-filemanager.html" class="nav-link icon app_file xs-hide"><i class="fe fe-folder" data-toggle="tooltip" data-placement="right" title="File Manager"></i></a>
                        <a href="app-social.html" class="nav-link icon xs-hide"><i class="fe fe-share-2" data-toggle="tooltip" data-placement="right" title="Social Media"></i></a>
                        <a href="javascript:void(0)" class="nav-link icon theme_btn"><i class="fe fe-feather"></i></a> -->
                        <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fe fe-settings"></i></a>
                    </div>
                </div>
                <div class="hright">
                    <a href="javascript:void(0)" class="nav-link icon right_tab"><i class="fe fe-align-right"></i></a>
                    <a href="<?= base_url() ?>login/exit" class="nav-link icon"><i class="fe fe-power"></i></a>
                </div>
            </div>
        </div>
        



        
        