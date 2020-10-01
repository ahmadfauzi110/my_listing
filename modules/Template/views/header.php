<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark bg-primary navbar-shadow navbar-brand-center bg-gradient-x-blue">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="<?=base_url('dashboard')?>">
                <img class="brand-logo" style="width: 80px;margin-top : -5px" alt="logo" src="<?=base_url()?>assets/image/logo.png">
                <!-- <h3 class="brand-text">Online</h3></a></li> -->
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a></li>
              
            </ul>
            <ul class="nav navbar-nav float-right">         
      
              
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="avatar avatar-online"><img src="<?= base_url('assets/image/user.png') ?>" onerror="imgError(this)"><i></i></span><span class="user-name"><?= $this->user->nama?></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?=site_url('login/do_logout')?>"><i class="ft-power"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>