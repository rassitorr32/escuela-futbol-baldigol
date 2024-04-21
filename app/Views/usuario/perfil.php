<!-- Start Page title and tab -->
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center ">
        <div class="header-action">
                <h1 class="page-title"><?= $title['page'] ?></h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=$breadcrumb[0]['route']?>"><?=$breadcrumb[0]['title']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$breadcrumb[1]['title']?></li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-calendar-tab" data-toggle="pill" href="#pills-calendar" role="tab" aria-controls="pills-calendar" aria-selected="false">Calendar</a>
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
                            <div class="card-body">
                                <?php

                                use App\Controllers\Calendario;

                                $calendario = new Calendario();
                                echo $calendario->getViewCalendario(1);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-timeline" role="tabpanel" aria-labelledby="pills-timeline-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Activity</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
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
                            <div class="card-body">
                                <div class="timeline_item ">
                                    <img class="tl_avatar" src="<?= base_url() ?>assets/images/xs/avatar1.jpg" alt="" />
                                    <span><a href="javascript:void(0);">Elisse Joson</a> San Francisco, CA <small class="float-right text-right">20-April-2019 - Today</small></span>
                                    <h6 class="font600">Hello, 'Im a single div responsive timeline without media Queries!</h6>
                                    <div class="msg">
                                        <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. I write the best placeholder text, and I'm the biggest developer on the web card she has is the Lorem card.</p>
                                        <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 12 Love</a>
                                        <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-comments"></i> 1 Comment</a>
                                        <div class="collapse p-4 section-gray show" id="collapseExample">
                                            <form class="well">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                </div>
                                                <button class="btn btn-primary">Submit</button>
                                            </form>
                                            <ul class="recent_comments list-unstyled mt-4 mb-0">
                                                <li>
                                                    <div class="avatar_img">
                                                        <img class="avatar" src="<?= base_url() ?>assets/images/xs/avatar4.jpg" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h5>Donald Gardner <small class="float-right font-14">Just now</small></h5>
                                                        <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline_item ">
                                    <img class="tl_avatar" src="<?= base_url() ?>assets/images/xs/avatar4.jpg" alt="" />
                                    <span><a href="javascript:void(0);" title="">Dessie Parks</a> Oakland, CA <small class="float-right text-right">19-April-2019 - Yesterday</small></span>
                                    <h6 class="font600">Oeehhh, that's awesome.. Me too!</h6>
                                    <div class="msg">
                                        <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. on the web by far... While that's mock-ups and this is politics, are they really so different? I think the only card she has is the Lorem card.</p>
                                        <div class="timeline_img mb-20">
                                            <img class="width100" src="<?= base_url() ?>assets/images/gallery/1.jpg" alt="Awesome Image">
                                            <img class="width100" src="<?= base_url() ?>assets/images/gallery/2.jpg" alt="Awesome Image">
                                        </div>
                                        <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 23 Love</a>
                                        <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1"><i class="fa fa-comments"></i> 2 Comment</a>
                                        <div class="collapse p-4 section-gray" id="collapseExample1">
                                            <form class="well">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                </div>
                                                <button class="btn btn-primary">Submit</button>
                                            </form>
                                            <ul class="recent_comments list-unstyled mt-4 mb-0">
                                                <li>
                                                    <div class="avatar_img">
                                                        <img class="avatar" src="<?= base_url() ?>assets/images/xs/avatar4.jpg" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h5>Donald Gardner <small class="float-right font-14">Just now</small></h5>
                                                        <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                                                        <div class="timeline_img mb-20">
                                                            <img class="width150" src="<?= base_url() ?>assets/images/gallery/7.jpg" alt="Awesome Image">
                                                            <img class="width150" src="<?= base_url() ?>assets/images/gallery/8.jpg" alt="Awesome Image">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="avatar_img">
                                                        <img class="avatar" src="<?= base_url() ?>assets/images/xs/avatar3.jpg" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h5>Dessie Parks <small class="float-right font-14">1min ago</small></h5>
                                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline_item ">
                                    <img class="tl_avatar" src="<?= base_url() ?>assets/images/xs/avatar7.jpg" alt="" />
                                    <span><a href="javascript:void(0);" title="">Rochelle Barton</a> San Francisco, CA <small class="float-right text-right">12-April-2019</small></span>
                                    <h6 class="font600">An Engineer Explains Why You Should Always Order the Larger Pizza</h6>
                                    <div class="msg">
                                        <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. I write the best placeholder text, and I'm the biggest developer on the web by far... While that's mock-ups and this is politics, is the Lorem card.</p>
                                        <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 7 Love</a>
                                        <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2"><i class="fa fa-comments"></i> 1 Comment</a>
                                        <div class="collapse p-4 section-gray" id="collapseExample2">
                                            <form class="well">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                </div>
                                                <button class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Company <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Username <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email address <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">First Name <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Last Name <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Address <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" placeholder="Home Address" value="455 S. Airport St. Moncks Corner">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">City <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Postal Code <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Country <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <select class="form-control custom-select">
                                            <option value="">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">About Me <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <textarea rows="5" class="form-control" placeholder="Here can be your description">Oh so, your weak rhyme You doubt I'll bother, reading into it I'll probably won't, left to my own devices But that's the difference in our opinions.</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="new_post">
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                    </div>
                                    <div class="mt-4 text-right">
                                        <button class="btn btn-warning"><i class="icon-link"></i></button>
                                        <button class="btn btn-warning"><i class="icon-camera"></i></button>
                                        <button class="btn btn-primary">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card blog_single_post">
                                    <div class="img-post">
                                        <img class="d-block img-fluid" src="<?= base_url() ?>assets/images/gallery/6.jpg" alt="First slide">
                                    </div>
                                    <div class="card-body">
                                        <h4><a href="#">All photographs are accurate</a></h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                    </div>
                                    <div class="footer">
                                        <div class="actions">
                                            <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue Reading</a>
                                        </div>
                                        <ul class="stats list-unstyled">
                                            <li><a href="javascript:void(0);">General</a></li>
                                            <li><a href="javascript:void(0);" class="icon-heart"> 28</a></li>
                                            <li><a href="javascript:void(0);" class="icon-bubbles"> 128</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card blog_single_post">
                                    <div class="img-post">
                                        <img class="d-block img-fluid" src="<?= base_url() ?>assets/images/gallery/4.jpg" alt="First slide">
                                    </div>
                                    <div class="card-body">
                                        <h4><a href="#">All photographs are accurate</a></h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                    </div>
                                    <div class="footer">
                                        <div class="actions">
                                            <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue Reading</a>
                                        </div>
                                        <ul class="stats list-unstyled">
                                            <li><a href="javascript:void(0);">General</a></li>
                                            <li><a href="javascript:void(0);" class="icon-heart"> 28</a></li>
                                            <li><a href="javascript:void(0);" class="icon-bubbles"> 128</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card blog_single_post">
                                    <div class="img-post">
                                        <img class="d-block img-fluid" src="<?= base_url() ?>assets/images/gallery/1.jpg" alt="First slide">
                                    </div>
                                    <div class="card-body">
                                        <h4><a href="#">All photographs are accurate</a></h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                    </div>
                                    <div class="footer">
                                        <div class="actions">
                                            <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue Reading</a>
                                        </div>
                                        <ul class="stats list-unstyled">
                                            <li><a href="javascript:void(0);">General</a></li>
                                            <li><a href="javascript:void(0);" class="icon-heart"> 28</a></li>
                                            <li><a href="javascript:void(0);" class="icon-bubbles"> 128</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card blog_single_post">
                                    <div class="img-post">
                                        <img class="d-block img-fluid" src="<?= base_url() ?>assets/images/gallery/2.jpg" alt="First slide">
                                    </div>
                                    <div class="card-body">
                                        <h4><a href="#">All photographs are accurate</a></h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                    </div>
                                    <div class="footer">
                                        <div class="actions">
                                            <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue Reading</a>
                                        </div>
                                        <ul class="stats list-unstyled">
                                            <li><a href="javascript:void(0);">General</a></li>
                                            <li><a href="javascript:void(0);" class="icon-heart"> 28</a></li>
                                            <li><a href="javascript:void(0);" class="icon-bubbles"> 128</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>