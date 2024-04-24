<!-- Start Page title and tab -->
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title"><?= $title['page'] ?></h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><?= $title['module'] ?></li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#admin-panel">Panel</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#admin-Activity">Activity</a></li> -->
            </ul>
        </div>
    </div>
</div>
<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="row clearfix row-deck">
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box green" data-toggle="tooltip" title="Nuevo Personal"><?= $totalNuevosUsuarios ?></div>
                        <a href="<?= base_url() ?>usuario" class="my_sort_cut text-muted">
                            <i class="fa fa-user-circle-o"></i>
                            <span>Personal</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <a href="app-contact.html" class="my_sort_cut text-muted">
                            <i class="fa fa-address-book"></i>
                            <span>Contact</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body ribbon">
                        <div class="ribbon-box orange" data-toggle="tooltip" title="Nuevos estudiantes"><?= $totalNuevosEstudiantes ?></div>
                        <a href="<?= base_url() ?>estudiante" class="my_sort_cut text-muted">
                            <i class="fa fa-users"></i>
                            <span>Estudiantes</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <a href="app-filemanager.html" class="my_sort_cut text-muted">
                            <i class="fa fa-folder"></i>
                            <span>FileManager</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <a href="library.html" class="my_sort_cut text-muted">
                            <i class="fa fa-book"></i>
                            <span>Library</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body">
                        <a href="holiday.html" class="my_sort_cut text-muted">
                            <i class="fa fa-bullhorn"></i>
                            <span>Holiday</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="admin-Dashboard" role="tabpanel">
                <div class="row clearfix">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informe de la Escuela</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between">
                                    <div class="font-12 mb-2"><span>Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="#">Learn More</a></span></div>
                                    <div class="selectgroup w250">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="intensity" value="low" class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">1D</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="intensity" value="medium" class="selectgroup-input">
                                            <span class="selectgroup-button">1W</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="intensity" value="high" class="selectgroup-input">
                                            <span class="selectgroup-button">1M</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="intensity" value="veryhigh" class="selectgroup-input">
                                            <span class="selectgroup-button">1Y</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="chart-container">
                                    <!-- Aquí va tu gráfico Apex -->
                                    <div id="apex-chart-line-column"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="clearfix">
                                            <div class="float-left"><strong>Fees</strong></div>
                                            <div class="float-right"><small class="text-muted">35%</small></div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-indigo" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="text-uppercase font-10">Compared to last year</span>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="clearfix">
                                            <div class="float-left"><strong>Donation</strong></div>
                                            <div class="float-right"><small class="text-muted">61%</small></div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-yellow" role="progressbar" style="width: 61%" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="text-uppercase font-10">Compared to last year</span>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="clearfix">
                                            <div class="float-left"><strong>Income</strong></div>
                                            <div class="float-right"><small class="text-muted">87%</small></div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-green" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="text-uppercase font-10">Compared to last year</span>
                                    </div>
                                    <div class="col-xl-3 col-md-6 mb-2">
                                        <div class="clearfix">
                                            <div class="float-left"><strong>Expense</strong></div>
                                            <div class="float-right"><small class="text-muted">42%</small></div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-pink" role="progressbar" style="width: 42%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="text-uppercase font-10">Compared to last year</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix row-deck">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ultimas Sesiones</h3>
                                <!-- <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
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
                                </div> -->
                            </div>
                            <div class="table-responsive" style="height: 310px;">
                                <?= $tableUltimoLogin ?>
                            </div>
                            <!-- <div class="card-footer d-flex justify-content-between">
                                <div class="font-14"><span>Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="#">View All</a></span></div>
                                <div>
                                    <button type="button" class="btn btn-primary">Export</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Performance</h3>
                            </div>
                            <div class="card-body">
                                <div id="apex-radar-multiple-series"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Nuevos Estudiantes</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?= $tableNuevosEstudiantes ?>
                                    <!-- <table class="table table-striped mb-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Assigned Professor</th>
                                                <th>Date Of Admit</th>
                                                <th>Fees</th>
                                                <th>Branch</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Jens Brincker</td>
                                                <td>Kenny Josh</td>
                                                <td>27/05/2016</td>
                                                <td>
                                                    <span class="tag tag-success">paid</span>
                                                </td>
                                                <td>Mechanical</td>
                                                <td>
                                                    <a href="javascript:void(0)"><i class="fa fa-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mark Hay</td>
                                                <td> Mark</td>
                                                <td>26/05/2018</td>
                                                <td>
                                                    <span class="tag tag-warning">unpaid</span>
                                                </td>
                                                <td>Science</td>
                                                <td>
                                                    <a href="javascript:void(0)"><i class="fa fa-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Anthony Davie</td>
                                                <td>Cinnabar</td>
                                                <td>21/05/2018</td>
                                                <td>
                                                    <span class="tag tag-success ">paid</span>
                                                </td>
                                                <td>Commerce</td>
                                                <td>
                                                    <a href="javascript:void(0)"><i class="fa fa-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>David Perry</td>
                                                <td>Felix </td>
                                                <td>20/04/2019</td>
                                                <td>
                                                    <span class="tag tag-danger">unpaid</span>
                                                </td>
                                                <td>Mechanical</td>
                                                <td>
                                                    <a href="javascript:void(0)"><i class="fa fa-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Anthony Davie</td>
                                                <td>Beryl</td>
                                                <td>24/05/2017</td>
                                                <td>
                                                    <span class="tag tag-success ">paid</span>
                                                </td>
                                                <td>M.B.A.</td>
                                                <td>
                                                    <a href="javascript:void(0)"><i class="fa fa-check"></i></a>
                                                    <a href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="admin-Activity" role="tabpanel">
                <div class="row clearfix row-deck">
                    <div class="col-xl-7 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quick Mail</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
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
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text w80">To:</span>
                                    </div>
                                    <input type="text" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">CC BCC</span>
                                    </div>
                                </div>
                                <div class="input-group mt-1 mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text w80">Subject:</span>
                                    </div>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="summernote">
                                    Hi there,
                                    <br />
                                    <p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
                                    <br />
                                    <p>Thank you!</p>
                                    <h6>Summer Note</h6>
                                </div>
                                <button class="btn btn-default mt-3">Send</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">University Stats</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
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
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-lg-4 col-4 border-right">
                                        <label class="mb-0 font-10">Department</label>
                                        <h4 class="font-20 font-weight-bold">05</h4>
                                    </div>
                                    <div class="col-lg-4 col-4 border-right">
                                        <label class="mb-0 font-10">Total Teacher</label>
                                        <h4 class="font-20 font-weight-bold">43</h4>
                                    </div>
                                    <div class="col-lg-4 col-4">
                                        <label class="mb-0 font-10">Total Student</label>
                                        <h4 class="font-20 font-weight-bold">267</h4>
                                    </div>
                                </div>
                                <table class="table table-striped mt-4">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="d-block">Mechanical Engineering<span class="float-right">43%</span></label>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-indigo" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="d-block">Business Analysis - BUS <span class="float-right">27%</span></label>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="d-block">Computer Technology - CT <span class="float-right">81%</span></label>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 81%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="d-block">Management - MGT <span class="float-right">61%</span></label>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 61%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="d-block">Science <span class="float-right">77%</span></label>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <small>Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="#">Learn More</a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="table-responsive todo_list">
                                <table class="table table-hover text-nowrap table-striped table-vcenter mb-0">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th class="w150 text-right">Due</th>
                                            <th class="w100">Priority</th>
                                            <th class="w80 text-center"><i class="icon-user"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Report Panel Usag</span>
                                                </label>
                                            </td>
                                            <td class="text-right">Feb 12-2019</td>
                                            <td><span class="tag tag-danger ml-0 mr-0">HIGH</span></td>
                                            <td>
                                                <span class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">NG</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                                    <span class="custom-control-label">Report Panel Usag</span>
                                                </label>
                                            </td>
                                            <td class="text-right">Feb 18-2019</td>
                                            <td><span class="tag tag-warning ml-0 mr-0">MED</span></td>
                                            <td>
                                                <img src="<?= base_url() ?>assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="avatar" data-original-title="Avatar Name">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">New logo design for Angular Admin</span>
                                                </label>
                                            </td>
                                            <td class="text-right">March 02-2019</td>
                                            <td><span class="tag tag-success ml-0 mr-0">High</span></td>
                                            <td>
                                                <img src="<?= base_url() ?>assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="avatar" data-original-title="Avatar Name">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">Report Panel Usag</span>
                                                </label>
                                            </td>
                                            <td class="text-right">Feb 12-2019</td>
                                            <td><span class="tag tag-danger ml-0 mr-0">HIGH</span></td>
                                            <td>
                                                <span class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">NG</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                                    <span class="custom-control-label">Report Panel Usag</span>
                                                </label>
                                            </td>
                                            <td class="text-right">Feb 18-2019</td>
                                            <td><span class="tag tag-warning ml-0 mr-0">MED</span></td>
                                            <td>
                                                <img src="<?= base_url() ?>assets/images/xs/avatar3.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="avatar" data-original-title="Avatar Name">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked>
                                                    <span class="custom-control-label">New logo design for Angular Admin</span>
                                                </label>
                                            </td>
                                            <td class="text-right">March 02-2019</td>
                                            <td><span class="tag tag-success ml-0 mr-0">High</span></td>
                                            <td>
                                                <span class="avatar avatar-blue" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">NG</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                                    <span class="custom-control-label">Design PSD files for Angular Admin</span>
                                                </label>
                                            </td>
                                            <td class="text-right">March 20-2019</td>
                                            <td><span class="tag tag-warning ml-0 mr-0">MED</span></td>
                                            <td>
                                                <img src="<?= base_url() ?>assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="avatar" data-original-title="Avatar Name">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                                    <span class="custom-control-label">Design PSD files for Angular Admin</span>
                                                </label>
                                            </td>
                                            <td class="text-right">March 20-2019</td>
                                            <td><span class="tag tag-warning ml-0 mr-0">MED</span></td>
                                            <td>
                                                <img src="<?= base_url() ?>assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="avatar" data-original-title="Avatar Name">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>