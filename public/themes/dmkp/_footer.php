    <div class="row-fluid footer">
        <hr />

        <ul class="unstyled inline pull-left">
            <li><a href="<?php echo site_url('dmkp/copyright_notice'); ?>">Copyright Notice</a></li>
            <li class="administrator"><a href="<?php echo site_url('admin'); ?>" target="_blank">Admin</a></li>
        </ul>

        <ul class="unstyled inline pull-right">
            <li>&copy; World Vision International 2014 | All Rights Reserved</li>
        </ul>
    </div>

    <div id="logoutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel"><i class="fa fa-ban"></i> Log Out</h4>
        </div>

        <div class="modal-body">
            <p><?php echo $logged_in_user['first_name'] ?>, are you sure you want to log out?</p>
        </div>

        <div class="modal-footer">
            <a href="#none" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
            <a href="<?php echo site_url('dmkp/logout'); ?>" class="btn btn-primary"><i class="fa fa-ban"></i> Log Out</a>
        </div>
    </div>

    <div id="feedbackModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel"><i class="fa fa-comments"></i> Feed Back Form</h4>
        </div>

        <!-- form -->
        <?php echo form_open(site_url('dmkp/submit_feedback')); ?>
            <div class="modal-body container-fluid">
                <!-- .row-fluid -->
                <div class="row-fluid">
                    <div class="alert alert-danger">Fields marked with an asterix (*) are required. <button class="close" type="button" data-dismiss="alert">x</button></div>

                    <h4>Type of feedback<span class="red_font">*</span></h4>

                    <label class="checkbox inline">
                        <input name="feedback_type[]" id="" value="1" type="checkbox"> Content
                    </label>

                    <label class="checkbox inline">
                        <input name="feedback_type[]" id="" value="2" type="checkbox"> Links
                    </label>

                    <label class="checkbox inline">
                        <input name="feedback_type[]" id="" value="3" type="checkbox"> Design
                    </label>

                    <label class="checkbox inline">
                        <input name="feedback_type[]" id="" value="4" type="checkbox"> Other
                    </label>

                    <h4>Message<span class="red_font">*</span></h4>
                    <textarea class="span12" rows="4" name="message"></textarea>

                    <h4>Explain where on the page the issue is<span class="red_font">*</span></h4>
                    <textarea class="span12" rows="2" placeholder="eg. In the second paragraph, fourth line..." name="explanation"></textarea>

                    <input name="url_with_issue" value="<?php echo current_url(); ?>" type="hidden">

                    <div class="controls controls-row">
                        <input name="full_name" class="span6" placeholder="Your Name" id="disabledInput" value="Amos Doornbos" disabled="" type="text">
                        <input name="full_name" class="span6" placeholder="Your Email Address" value="amos@facesofanotherworld.com" disabled="" type="text">
                    </div>
                </div>
                <!-- /.row-fluid -->
            </div>
            <!-- /.container-fluid -->

            <div class="modal-footer">
                <a href="#none" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
                <button type="submit" class="btn btn-primary"> Submit Form</button>
            </div>
        <?php echo form_close(); ?>
    </div>

    <!-- Le javascript
            ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('themes/dmkp/js/bootstrap.min.js'); ?>"></script>

    <!-- Manually trigger the javascript functions -->
    <script>
        $(document).ready(function(){
            {
                $('.tipify').tooltip(); //Tool Tip
                $('.pop').popover(); // Pop Over
                $('.carousel').carousel(); // Carousel

                <?php echo(isset($extraJS) ? $extraJS : ''); ?>
            }
        });
    </script>

    <ul class="unstyled inline holla">
        <li><a href="#feedbackModal" class="btn btn-gray" data-toggle="modal"><i class="fa fa-comments"></i> Feedback</a></li>
        <li><a href="<?php echo site_url('dmkp/need_help'); ?>" class="btn btn-gray"><i class="fa fa-medkit"></i> Need help now?</a></li>
    </ul>
</body>