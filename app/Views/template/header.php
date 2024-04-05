<!-- Start Page header -->
<div class="section-body <?=session('configuracion')['fixnavbar']==1?'sticky-top':''?> <?=session('configuracion')['pageheader']==1?'top_dark':''?>" id="page_top">
    <div class="container-fluid">
        <div class="page-header">
            <div class="left">
                <!-- <div class="input-group">
                    <input type="text" class="form-control" placeholder="What you want to find">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                </div> -->
            </div>
            <div class="right">
                <div class="notification d-flex">

                    <div class="dropdown d-flex">
                        <a href="javascript:void(0)" class="chip ml-3" data-toggle="dropdown">
                            <?= session('usuario')['foto'] == null || session('usuario')['foto'] == 'user_default.png' || !file_exists(FCPATH . 'assets/dist/img/personal/' . session('usuario')['foto']) ? '<div class="avatar avatar-pink" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name">
                    <span>' . strtoupper(substr(session('usuario')['nombres'], 0, 1)) . strtoupper(substr(session('usuario')['ap_paterno'], 0, 1)) . '</span>
                    </div>' :
                    '<span class="avatar" style="background-image: url(' . base_url() . 'assets/dist/img/personal/' . session('usuario')['foto'] . ')"></span>'?> <?= session('usuario')['usuario'] ?></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fe fe-user"></i> Profile</a>
                            <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i> Settings</a>
                            <a class="dropdown-item" href="app-email.html"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-send"></i> Message</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-help-circle"></i> Need help?</a>
                            <a class="dropdown-item" href="<?=base_url()?>login/exit"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>