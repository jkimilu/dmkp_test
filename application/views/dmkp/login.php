<div class="container-fluid max-width ">
    <div class="row-fluid login">
        <div class="span8 kushoto relative">
            <img src="<?php echo base_url('themes/dmkp/img/home.png'); ?>" alt="" />

            <hr class="divide" />

            <h2>  Disaster Management Knowledge Portal</h2>

            <div class="well well_login">A one-stop shop for standards, tools and templates for use in disaster management by the World Vision HEA Division.</div>

            <h4>First Edition: Online Version</h4>

            <ul class="ul_benefits">
                <li>Optimised for different device screens sizes</li>
                <li>Available 24 hours a day, 7 days a week</li>
                <li>Always access the latest version</li>
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