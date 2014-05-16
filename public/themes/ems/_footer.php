        <div class="row-fluid footer">
            <hr />

            <ul class="unstyled inline pull-left">
                <li><a href="<?php echo site_url('ems/abbreviations'); ?>">Abbreviations</a></li> <li><a href="definitions.html">Definitions</a></li>
                <li><a href="<?php echo site_url('ems/terms'); ?>">Terms &amp; Conditions</a></li>
            </ul>

            <ul class="unstyled inline pull-right">
                <li>&copy; 2014 World Vision International | All Rights Reserved</li>
            </ul>
        </div>
    </div>

    <!-- Le javascript
            ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('themes/ems/js/jquery-1.8.2.min.js'); ?>"></script>
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