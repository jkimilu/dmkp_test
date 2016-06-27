    <div class="container-fluid max-width">
        <div class="row-fluid footer footer_login">
            <hr />

            <ul class="unstyled inline pull-left">
                <li>Humanitarian Emergency Affairs, World Vision International</li>
                <li class="not_administrator"><a href="<?php echo site_url('/'); ?>">Not Admin?</a></li>
                <li>Developed by <a href="http://www.bluedigital.co.ke" target="_blank" data-original-title="BlueDigital's Website" data-placement="top" class="tipify">bluedigital.co.ke</a></li>
            </ul>

            <ul class="unstyled inline pull-right">
                <li>&copy; World Vision International 2016 | All Rights Reserved</li>
            </ul>
        </div>
    </div>

    <!-- Le javascript
            ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('themes/dmkp/js/jquery-1.8.2.min.js'); ?>"></script>
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

        (function($) {
            var x = 0;
            var y = 0;

            //cache a reference to the banner
            var banner = $(".body_login");

            // set initial banner background position
            banner.css('backgroundPosition', x + 'px' + ' ' + y + 'px');

            // scroll up background position every 90 milliseconds
            window.setInterval(function() {
                banner.css("backgroundPosition", x + 'px' + ' ' + y + 'px');
                y--;
            }, 100);
        })(jQuery);
    </script>
</body>