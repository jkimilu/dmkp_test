<div class="container-fluid max-width ">
    <div class="row-fluid login">

        <div class="span8 kushoto relative">
            <img src="<?php echo base_url('themes/ems/img/home.png'); ?>" alt="" />

            <h2 style="margin-top: 15px;">  Emergency Management System Manual</h2>
            <h4>Second Edition: Online Version</h4>

            <hr />

            <ul style="color: #999;">
                <li>Optimised for different device screens sizes</li>
                <li>Access the latest version</li>
                <li>Access from anywhere</li>
                <li>Role-based views</li>
                <li>Interactive</li>
            </ul>

        </div>

        <div class="span4 kulia">

            <div class="alert alert-danger">
                Connect the EMS Manual with my wvcentral Account
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>

            <div class="well well-small">
                <img src="<?php echo base_url('themes/dmkp/img/connect.jpg'); ?>" />
            </div>

            <?php echo form_open('dmkp/login'); ?>
                <label class="checkbox">
                    <input name="allow_info" type="checkbox" checked="checked"> Allow EMS Manual to know who I am and access my information
                </label>

                <label class="checkbox">
                    <input name="allow_info" type="checkbox"> Always remember me
                </label>

                <hr />

                <input type="hidden" name="login" value="1"/>

                <button type="submit" class="btn btn-warning btn-large btn-block"><i class="fa fa-exchange"></i> wvcentral Connect</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>