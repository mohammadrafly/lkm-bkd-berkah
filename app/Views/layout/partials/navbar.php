<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">

        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('assets/img/avatar/avatar-1.png') ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= session()->get('name') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
            <div id="logged-in-time" class="dropdown-title">Logged in 5 min ago</div>
              <div class="dropdown-divider"></div>
              <a href="javascript:void(0);" onclick="signOut()" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>