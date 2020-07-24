<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('head');?>
   <style>.collection-product-wrapper .product-top-filter .product-filter-content .product-page-filter{} .my {
      border-top: 1px dashed #ddd;
      margin-top: 10px;
      padding-top: 10px;
      }
   </style>
   <body>
   <?php $this->load->view('header');?>

<!--section start-->
<section class="register-page section-b-space mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Create your account</h3>
                <p>Already registered? Please log in below:</p>
                <div class="theme-card">
                    <form class="theme-form" action="<?= base_url('index.php/register') ?>" method='post'>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="first_name">First Name <span class="s-c">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?= set_value('first_name'); ?>" >
                                <?= form_error('first_name'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="review">Last Name <span class="s-c">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?= set_value('last_name'); ?>" >
                                <?= form_error('last_name'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="user_name">Email Address <span class="s-c">*</span></label>
                                <input type="input" name="user_name" class="form-control" id="" placeholder="Enter User Name" value="<?= set_value('user_name'); ?>" >
                                <?= form_error('user_name'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="Mobile_Number.">Mobile Number <span class="s-c">*</span></label>
                                <input type="mobile" class="form-control" name="mobile_no" id="mobile_no" placeholder="Please enter your Mobile Number" value="<?= set_value('mobile_no'); ?>" >
                                <?= form_error('mobile_no'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="Enter_Password">Enter Password <span class="s-c">*</span></label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" value="<?= set_value('password'); ?>">
                                <?= form_error('password'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="Re-Type">Re-Type Password <span class="s-c">*</span></label>
                                <input type="Password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-Type Password" value="<?= set_value('confirm_password'); ?>" >
                                <?= form_error('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="city">City Name <span class="s-c">*</span></label>
                                <input type="text" class="form-control" name="city_name" id="city_name" placeholder="Please enter your city" value="<?= set_value('city_name'); ?>" >
                                <?= form_error('city_name'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="review">Zip Code <span class="s-c">*</span></label>
                                <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code" value="<?= set_value('zip'); ?>" >
                                <?= form_error('zip'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">create Account</button>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo base_url('index.php/login_view') ?>"><p class="l-p">Already Have An Account? <span class="sp">Login</span> </p></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
<?php $this->load->view('footer');?>
</body>

</html>