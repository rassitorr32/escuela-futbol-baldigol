<!-- Start Page title and tab -->
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="header-action">
                <h1 class="page-title"><?= $title['page'] ?></h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $breadcrumb[0]['route'] ?>"><?= $breadcrumb[0]['title'] ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $breadcrumb[1]['title'] ?></li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item">
                    <a class="nav-link" id="pills-calendar-tab" data-toggle="pill" href="#pills-calendar" role="tab" aria-controls="pills-calendar" aria-selected="false">Calendar</a>
                </li>
                <li hidden></li>
                <li hidden></li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="widgets1">
                            <div class="icon">
                                <i class="icon-trophy text-success font-30"></i>
                            </div>
                            <div class="details">
                                <h6 class="mb-0 font600">Total Earned</h6>
                                <span class="mb-0">$96K +</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="widgets1">
                            <div class="icon">
                                <i class="icon-heart text-warning font-30"></i>
                            </div>
                            <div class="details">
                                <h6 class="mb-0 font600">Total Likes</h6>
                                <span class="mb-0">6,270</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="widgets1">
                            <div class="icon">
                                <i class="icon-handbag text-danger font-30"></i>
                            </div>
                            <div class="details">
                                <h6 class="mb-0 font600">Delivered</h6>
                                <span class="mb-0">720 Delivered</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="widgets1">
                            <div class="icon">
                                <i class="icon-user text-primary font-30"></i>
                            </div>
                            <div class="details">
                                <h6 class="mb-0 font600">Jobs</h6>
                                <span class="mb-0">614</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-calendar" role="tabpanel" aria-labelledby="pills-calendar-tab">
                        <div class="card">
                            <div class="card-body" style="overflow: auto;">
                                <?php

                                use App\Controllers\Calendario;

                                $calendario = new Calendario();
                                echo $calendario->getViewCalendario(1);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                    <div class="item-action dropdown ml-2">
                                        <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body form-horizontal">
                                <?php

                                use App\Controllers\Usuario;

                                $usuario = new Usuario();
                                echo $usuario->edit(session('id_usuario'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= sweetAlert() ?>

<script>
    $(document).ready(function() {
        <?php if (session('page_link') == 'Calendario') : ?>

            $('#pills-calendar-tab').click();
        <?php endif; ?>

        <?php if (session('page_link') == 'Perfil') : ?>

            $('#pills-profile-tab').click();
        <?php endif; ?>
        // Selecciona todos los enlaces dentro de la lista de navegación
        $('#pills-calendar-tab').on('click', function() {
            $.ajax({
                url: 'usuario/pageLink', // La URL de tu controlador
                type: 'POST',
                data: {
                    link: 'Calendario'
                },
                success: function(data) {
                    console.log(data)
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        $('#pills-profile-tab').on('click', function() {
            $.ajax({
                url: 'usuario/pageLink', // La URL de tu controlador
                type: 'POST',
                data: {
                    link: 'Perfil'
                },
                success: function(data) {
                    console.log(data)
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>