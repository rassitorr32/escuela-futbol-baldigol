<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="header-action">
                <h1 class="page-title"><?= $title['page'] ?></h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Panel</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title['module'] ?></li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pro-all">Lista</a></li>
                <li hidden></li>
                <li hidden></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pro-add">Agregar</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="tab-content">
            <div class="tab-pane active" id="pro-all">
                <div class="table-responsive card">
                    <?= $table ?>
                </div>
            </div>
            <div class="tab-pane" id="pro-add">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Información Básica</h3>
                                <div class="card-options ">
                                    <!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a> -->
                                    <!-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <?php

                                use App\Controllers\Estudiante;

                                $estudiante = new Estudiante();
                                echo $estudiante->add();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#modal-lg').on('shown.bs.modal', function() {
  console.log('El modal se ha mostrado');
        $('#selectTutor').select2({
            //theme: 'bootstrap4',
            placeholder: '-- Ninguno --', // Texto del placeholder
            width: '100%', // Ancho del select
            // // minimumResultsForSearch: Infinity, // Ocultar la barra de búsqueda

        });
    });
    });
</script>

<?= sweetAlert() ?>