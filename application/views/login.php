<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('head');?>
<body>
<?php $this->load->view('header');?>
    <!--section start-->
    <section class="login-page section-b-space mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-3 col-md-3 col-sm-6 p-b-5"></div>
                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 p-b-10">
                    <h3>Login</h3>
                    <p>Already registered? Please log in below:</p>
                    <div class="theme-card">
                        <form class="theme-form" action="<?= base_url('index.php/login') ?>" method='post'>
                            <div class="form-group">
                                <label for="email">Username/Email</label>
                                <input type="input" name="user_name" class="form-control" id="" placeholder="Enter User Name" value="<?= set_value('user_name'); ?>" >
                                <?= form_error('user_name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" value="<?= set_value('password'); ?>">
                                <?= form_error('password'); ?>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url('index.php/register_view') ?>">
                                        <p class="l-p">Don't have an account? <span class="sp">Register</span></p>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-3 col-sm-6 p-b-5"></div>
            </div>
        </div>
    </section>
    <!--Section ends-->
    <?php $this->load->view('footer'); ?>
</body>

</html>