<!-- header start -->
<header class="header-2 header-6 ">
   <div class="mobile-fix-option"></div>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><i class="fa fa-phone" aria-hidden="true"></i>Call Us: 123 - 456 - 7890 </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ml-auto">
            <?php if ($this->session->userdata('logged_in') == TRUE) { ?>
               <li class="nav-item active">
                  <img src="<?php echo base_url(); ?>assets/images/service/user-profile-avatar.png" class="img-fluid" alt="profile-image" style="width:30px;">
                  <a><?php echo $this->session->userdata('first_name'); ?></a>
                  <span class="pd-5">|</span>
                  <a href="<?php echo base_url(); ?>index.php/logout">Logout</a>
               </li>
            <?php
            } else { ?>
               <li class="mobile-wishlist nav-item mr-3"><a href="<?php echo base_url('index.php/login_view') ?>"><i class="fa fa-sign-in"></i>Login </a></li>
               <li class="mobile-wishlist nav-item"><a href="<?php echo base_url('index.php/register_view') ?>"><i class="fa fa-sign-out"></i>Register </a></li>
            <?php } ?>
      </div>
   </nav>

   <div class="container">
      <div class="row ">

      </div>
   </div>
</header>