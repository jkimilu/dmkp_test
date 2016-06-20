<!DOCTYPE html>
<html lang="en">
<?php echo theme_view('_header'); ?>

    <div class="container-fluid max-width">
        <div class="row-fluid login">
            <div class="span8 kushoto relative">
                <img src="<?php echo base_url('themes/ems/img/home.png'); ?>" alt="">

                <h2 style="margin-top: 15px;">  Emergency Management System Manual</h2>
                <h4>Second Edition: Online Version</h4>

                <hr>

                <ul style="color: #999;">
                    <li>Optimised for different device screens sizes</li>
                    <li>Access the latest version</li>
                    <li>Access from anywhere</li>
                    <li>Role-based views</li>
                    <li>Interactive</li>
                </ul>
            </div>

            <div class="span4 kulia">
                <h4 class="well well-small"><center><i class="fa fa-cogs"></i> Administrator Login</center></h4>

                <?php if(Template::message() != '') : ?>
                    <?php echo Template::message(); ?>
                <?php endif; ?>

                <?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>
                    <h5 style="margin-bottom: 3px;">Email Address</h5>
                    <input name="login" class="span12" style="margin-bottom: 0px;" type="text"/>

                    <h5 style="margin-bottom: 3px;">Password</h5>
                    <input name="password" class="span12" type="password"/>

                    <label class="checkbox">
                        <input name="remember_me" type="checkbox" id="remember_me" value="1" tabindex="3"> Remember me
                    </label>

                    <hr style="margin: 10px 0px;">

                    <div class="overflow_auto">
                        <span class="pull-left"><a href="#forgotPasswordModal" data-toggle="modal" data-original-title="Click here to reset your password" data-placement="top" class="tipify"><small>Forgot Password?</small></a></span>

                        <button class="btn btn-warning pull-right" type="submit" name="log-me-in">
                            <i class="fa fa-lock"></i> Log in
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div id="forgotPasswordModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <?php echo form_open('forgot_password', array('autocomplete' => 'off')); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="myModalLabel"><i class="fa fa-key"></i> Reset Password</h4>
            </div>

            <div class="modal-body container-fluid">
                <div class="row-fluid">
                    <p class="well well-small">Please enter your email address below and we'll send you a temporary password.</p>
                    <input class="span12" placeholder="Email Address" type="text" name="email">
                </div>
            </div>

            <div class="modal-footer">
                <a href="#none" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
                <button class="btn btn-primary" name="send"><i class="fa fa-envelope-o"></i> Submit</button>
            </div>

        <?php echo form_close(); ?>
    </div>

<?php echo theme_view('_footer_login', array('show' => false)); ?>
</html>