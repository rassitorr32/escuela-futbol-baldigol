<!-- Start Quick menu with more functio -->
<div class="user_div">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#righttab-statistics">Statistics</a></li>
            </ul>
            <div class="tab-content mt-3">
                <div class="tab-pane fade show active" id="righttab-statistics" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div>Total Revenue</div>
                            <div class="py-3 m-0 text-center h1 text-success">$79,452</div>
                            <div class="d-flex">
                                <span class="text-muted">Income</span>
                                <div class="ml-auto"><i class="fa fa-caret-up text-success"></i>4%</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>$43,320</strong></div>
                                        <div class="float-right"><small class="text-muted">Bank of America</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-azure" role="progressbar" style="width: 87%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="clearfix">
                                        <div class="float-left"><strong>$36,132</strong></div>
                                        <div class="float-right"><small class="text-muted">Wells Fargo</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-green" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-yellow"><i class="fa fa-users"></i> </div>
                            <div class="content">
                                <span>Total Student</span>
                                <h5 class="number mb-0">
                                    <?php

                                    use App\Models\EstudianteModel;
                                    use App\Models\UsuarioModel;

                                    $estudiante_model = new EstudianteModel();
                                    echo count($estudiante_model->getEstudiantesWithPersona());
                                    ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-gray"><i class="fa fa-sitemap"></i> </div>
                            <div class="content">
                                <span>Department</span>
                                <h5 class="number mb-0">14</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-dark"><i class="fa fa-user-circle-o"></i> </div>
                            <div class="content">
                                <span>Personal Total</span>
                                <h5 class="number mb-0">
                                    <?php
                                    $usuario_model = new UsuarioModel();
                                    echo count($usuario_model->findAll());
                                    ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-azure"><i class="fa fa-tags"></i> </div>
                            <div class="content">
                                <span>Total Courses</span>
                                <h5 class="number mb-0">31</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-pink"><i class="fa fa-credit-card"></i> </div>
                            <div class="content">
                                <span>Expense</span>
                                <h5 class="number mb-0">$7,254</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-green"><i class="fa fa-bank"></i> </div>
                            <div class="content">
                                <span>Total Income</span>
                                <h5 class="number mb-0">$27,852</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-cyan"><i class="fa fa-map-o"></i> </div>
                            <div class="content">
                                <span>Our Center</span>
                                <h5 class="number mb-0">52</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body top_counter">
                            <div class="icon bg-indigo"><i class="fa fa-smile-o"></i> </div>
                            <div class="content">
                                <span>Smiley Face</span>
                                <h5 class="number mb-0">10K</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="righttab-Result" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Result 2019</h3>
                            <div class="card-options">
                                <a href="#"><i class="fa fa-file-excel-o" data-toggle="tooltip" title="Export Excel"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>87%</strong></div>
                                        <div class="float-right"><small class="text-muted">Art & Design</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-azure" role="progressbar" style="width: 87%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>80%</strong></div>
                                        <div class="float-right"><small class="text-muted">Fashion</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-green" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>63%</strong></div>
                                        <div class="float-right"><small class="text-muted">Sports Science</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-orange" role="progressbar" style="width: 63%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>91%</strong></div>
                                        <div class="float-right"><small class="text-muted">Computers</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-indigo" role="progressbar" style="width: 91%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="clearfix">
                                        <div class="float-left"><strong>35%</strong></div>
                                        <div class="float-right"><small class="text-muted">Biological Sciences</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-pink" role="progressbar" style="width: 35%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="row text-center">
                                <div class="col-6 border-right">
                                    <label class="mb-0">Total Pass</label>
                                    <div class="font-20 font-weight-bold">1,052</div>
                                </div>
                                <div class="col-6">
                                    <label class="mb-0">Total Fail</label>
                                    <div class="font-20 font-weight-bold">198</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Result 2018</h3>
                            <div class="card-options">
                                <a href="#"><i class="fa fa-file-excel-o" data-toggle="tooltip" title="Export Excel"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>80%</strong></div>
                                        <div class="float-right"><small class="text-muted">Fashion</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-green" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>87%</strong></div>
                                        <div class="float-right"><small class="text-muted">Art & Design</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-azure" role="progressbar" style="width: 87%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>91%</strong></div>
                                        <div class="float-right"><small class="text-muted">Computers</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-indigo" role="progressbar" style="width: 91%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>35%</strong></div>
                                        <div class="float-right"><small class="text-muted">Biological Sciences</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-pink" role="progressbar" style="width: 35%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="clearfix">
                                        <div class="float-left"><strong>63%</strong></div>
                                        <div class="float-right"><small class="text-muted">Sports Science</small></div>
                                    </div>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar bg-orange" role="progressbar" style="width: 63%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="row text-center">
                                <div class="col-6 border-right">
                                    <label class="mb-0">Total Pass</label>
                                    <div class="font-20 font-weight-bold">845</div>
                                </div>
                                <div class="col-6">
                                    <label class="mb-0">Total Fail</label>
                                    <div class="font-20 font-weight-bold">142</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="righttab-Students" role="tabpanel">
                    <div id="users">
                        <div class="input-group mt-2 mb-2">
                            <input type="text" class="form-control search" placeholder="Search Student">
                        </div>
                        <ul class="right_chat list-unstyled list">
                            <li class="alfabet">A</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Abigail Churchill</span>
                                        <span class="message">Art & Design</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Alexandra Carr</span>
                                        <span class="message">Fashion</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Alison Berry</span>
                                        <span class="message">Fashion</span>
                                    </div>
                                </a>
                            </li>
                            <li class="alfabet">B</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Bella Alan</span>
                                        <span class="message">Sports Science</span>
                                    </div>
                                </a>
                            </li>
                            <li class="alfabet">C</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Caroline Alan</span>
                                        <span class="message">Sports Science</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar6.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Connor Campbell</span>
                                        <span class="message">Computers</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar7.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Charles Campbell</span>
                                        <span class="message">Computers</span>
                                    </div>
                                </a>
                            </li>
                            <li class="alfabet">D</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar8.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Donna Hudson</span>
                                        <span class="message">Computers</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar9.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Dylan Jones</span>
                                        <span class="message">Computers</span>
                                    </div>
                                </a>
                            </li>
                            <li class="alfabet">G</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar8.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Gordon Hudson</span>
                                        <span class="message">Sports Science</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar9.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Gabrielle Walker</span>
                                        <span class="message">Computers</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar10.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Gavin North</span>
                                        <span class="message">Computers</span>
                                    </div>
                                </a>
                            </li>
                            <li class="alfabet">S</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Stephanie Hudson</span>
                                        <span class="message">Sports Science</span>
                                    </div>
                                </a>
                            </li>
                            <li class="alfabet">W</li>
                            <li>
                                <a href="javascript:void(0);" class="media">
                                    <img class="media-object" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">William Paige</span>
                                        <span class="message">Fashion</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="user_chatbody chat_app">
                        <div class="card-header bline pt-1 pl-0 pr-0">
                            <h3 class="card-title">Abigail Churchill <small>Online</small></h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="p-1" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item active" href="#">Online</a>
                                    <a class="dropdown-item" href="#">Away</a>
                                    <a class="dropdown-item" href="#">Do not disturb</a>
                                    <a class="dropdown-item" href="#">Invisible</a>
                                </div>
                                <a href="javascript:void(0)" class="p-1 chat_close"><i class="fa fa-close"></i></a>
                            </div>
                        </div>
                        <div class="chat_windows">
                            <ul class="mb-0">
                                <li class="other-message">
                                    <img class="avatar mr-3" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="avatar">
                                    <div class="message">
                                        <p class="bg-light-blue">Are we meeting today?</p>
                                        <span class="time">10:10 AM, Today</span>
                                    </div>
                                </li>
                                <li class="other-message">
                                    <img class="avatar mr-3" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="avatar">
                                    <div class="message">
                                        <p class="bg-light-blue">Hi Aiden, how are you? How is the project coming along?</p>
                                        <p class="bg-light-blue">Are we meeting today?</p>
                                        <span class="time">10:15 AM, Today</span>
                                    </div>
                                </li>
                                <li class="my-message">
                                    <div class="message">
                                        <p class="bg-light-gray">Project has been already finished and I have results to show you.</p>
                                        <div class="file_folder">
                                            <a href="javascript:void(0);">
                                                <div class="icon">
                                                    <i class="fa fa-file-excel-o text-success"></i>
                                                </div>
                                                <div class="file-name">
                                                    <p class="mb-0 text-muted">Report2017.xls</p>
                                                    <small>Size: 68KB</small>
                                                </div>
                                            </a>
                                        </div>
                                        <span class="time">10:17 AM, Today</span>
                                    </div>
                                </li>
                                <li class="other-message">
                                    <img class="avatar mr-3" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="avatar">
                                    <div class="message">
                                        <div class="media_img">
                                            <img src="<?= base_url() ?>assets/images/gallery/1.jpg" class="w100 img-thumbnail" alt="">
                                            <img src="<?= base_url() ?>assets/images/gallery/2.jpg" class="w100 img-thumbnail" alt="">
                                        </div>
                                        <span class="time">10:15 AM, Today</span>
                                    </div>
                                </li>
                                <li class="other-message">
                                    <img class="avatar mr-3" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="avatar">
                                    <div class="message">
                                        <p class="bg-light-blue">Are we meeting today I have results?</p>
                                        <span class="time">10:18 AM, Today</span>
                                    </div>
                                </li>
                                <li class="my-message">
                                    <div class="message">
                                        <p class="bg-light-gray">Well we have good budget for the project</p>
                                        <span class="time">10:25 AM, Today</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="chat-message clearfix">
                                <a href="javascript:void(0);"><i class="icon-camera"></i></a>
                                <a href="javascript:void(0);"><i class="icon-camcorder"></i></a>
                                <a href="javascript:void(0);"><i class="icon-paper-plane"></i></a>
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control" placeholder="Enter text here...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="righttab-Todo" role="tabpanel">
                    <ul class="list-unstyled mb-0 todo_list">
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                                <span class="custom-control-label">Report Panel Usag</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                <span class="custom-control-label">Report Panel Usag</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                                <span class="custom-control-label">New logo design for Angular Admin</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                <span class="custom-control-label">Design PSD files for Angular Admin</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" checked="">
                                <span class="custom-control-label">New logo design for Angular Admin</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>