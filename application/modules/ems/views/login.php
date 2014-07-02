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

            <h4><center>Connect the EMS Manual with my wvcentral Account</center></h4>

            <div class="well well-small">
                <img src="<?php echo base_url('themes/ems/img/connect.jpg'); ?>" />
            </div>

            <?php echo form_open('ems/login'); ?>
                <label class="checkbox">
                    <input name="allow_info" type="checkbox" checked="checked"> Allow EMS Manual to know who I am and access my information
                </label>

                <label class="checkbox">
                    <input name="allow_info" type="checkbox"> Always remember me
                </label>

                <hr />

                <input type="hidden" name="login" value="1"/>

                <button type="submit" class="btn btn-warning btn-large btn-block tipify" data-original-title="Click to log in" data-placement="bottom"><i class="fa fa-exchange"></i> WV Central Connect</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>