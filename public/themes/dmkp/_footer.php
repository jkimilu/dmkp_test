        <div class="row-fluid footer">
            <hr />

            <ul class="unstyled inline pull-left">
                <li><a href="<?php echo site_url('ems/index/appendices/abbreviations/5/0'); ?>">Abbreviations</a></li> <li><a href="<?php echo site_url('ems/index/appendices/definitions/5/1'); ?>">Definitions</a></li>
                <li><a href="<?php echo site_url('ems/copyright_notice'); ?>">Copyright Notice</a></li>
                <li class="administrator"><a href="<?php echo site_url('admin'); ?>" target="_blank">Admin</a></li>
            </ul>

            <ul class="unstyled inline pull-right">
                <li>&copy; World Vision International 2014 | All Rights Reserved</li>
            </ul>
        </div>
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
            <a href="<?php echo site_url('ems/logout'); ?>" class="btn btn-primary"><i class="fa fa-ban"></i> Log Out</a>
        </div>
    </div>

    <!-- Le javascript
            ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('themes/ems/js/bootstrap.min.js'); ?>"></script>

    <!-- Manually trigger the javascript functions -->
    <script>
        $(document).ready(function(){
            {
                $('.tipify').tooltip(); //Tool Tip
                $('.pop').popover(); // Pop Over
                $('.carousel').carousel(); // Carousel
            }
        });
    </script>
</body>