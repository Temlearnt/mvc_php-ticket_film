<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="POS - Bootstrap Admin Template">
  <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
  <meta name="author" content="Dreamguys - Bootstrap Admin Template">
  <meta name="robots" content="noindex, nofollow">
  <title>Admin Page</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= BASEURL?>public/assets/img/icon/logo.png">
  <link rel="stylesheet" href="<?= BASEURL?>/vendors/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= BASEURL?>/vendors/css/animate.css">
  <link rel="stylesheet" href="<?= BASEURL?>/vendors/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL?>/vendors/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="<?= BASEURL?>/vendors/plugins/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= BASEURL?>/vendors/css/style.css">
  <?php
    if ($data['about'] === TRUE) : ?>
        <link rel="stylesheet" href="<?= BASEURL; ?>public/assets/css/about.css" />
    <?php
    endif;
    ?>
</head>

<body>
  <div class="main-wrapper">

    <div class="header">
      <div class="header-left active">
        <a href="index.html" class="logo">
          <img src="<?= BASEURL?>public/assets/img/icon/logo.png" alt="">
        </a>
        <a href="index.html" class="logo-small">
          <img src="<?= BASEURL?>/vendors/img/logo-small.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
      </div>
      <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
          <span></span>
          <span></span>
          <span></span>
        </span>
      </a>
      <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
          <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
            <span class="user-img"><img src="<?= BASEURL?>/vendors/img/profiles/avator1.jpg" alt="">
              <span class="status online"></span></span>
          </a>
          <div class="dropdown-menu menu-drop-user">
            <div class="profilename">
              <div class="profileset">
                <span class="user-img"><img src="<?= BASEURL?>/vendors/img/profiles/avator1.jpg" alt="">
                  <span class="status online"></span></span>
                <div class="profilesets">
                  <h6>John Doe</h6>
                  <h5>Admin</h5>
                </div>
              </div>
              <hr class="m-0">
              <a class="dropdown-item" href="<?=BASEURL?>admin/about"><i class="me-2" data-feather="settings"></i>About Us</a>
              <hr class="m-0">
              <a class="dropdown-item logout pb-0" href="<?=BASEURL?>auth/logout"><img src="<?= BASEURL?>/vendors/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
            </div>
          </div>
        </li>
      </ul>


      <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="profile.html">My Profile</a>
          <a class="dropdown-item" href="<?=BASEURL?>admin/about">Settings</a>
          <a class="dropdown-item" href="<?=BASEURL?>auth/logout">Logout</a>
        </div>
      </div>

    </div>