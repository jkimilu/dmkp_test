<?php if(isset($first_time_message)) : ?>
    <?php if($first_time_message) : ?>
        <div class="row-fluid row-alert">
            <div class="span12">
                <div class="alert alert-block alert-error fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h3 class="alert-heading"><i class="fa fa-user"></i> Welcome <?php echo $logged_in_user["first_name"]." ".$logged_in_user["last_name"]; ?>!</h3>
                    <p>In an effort to make you access sections of the EMS that are most relevant to you in a faster and more convenient way we have created role-based view sessions. By default you have been logged in on the `Default View` session. To learn how to change your view session please click the button below.</p>
                    <p>
                        <a class="btn btn-danger" href="#">Learn More</a> <a class="btn" href="#">Dont show this again</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row-fluid body">

    <div class="left_col span3">

        <div class="affix">
            <?php search_form(); ?>
            <?php front_end_ems_tree($tree_navigation, $language); ?>
        </div>

    </div>

    <div class="right_col span9">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url("/"); ?>">Home</a> <span class="divider">/</span></li>
            <li class="active">Copyright Notice</li>
        </ul>

        <div class="main_content">
            <h2>Copyright Notice</h2>

            <hr>

            <h4>© World Vision International 2014</h4>

            <p>All rights reserved. No portion of this publication may be reproduced in any
                form, except for brief excerpts in reviews, without prior permission of the
                publisher.</p>

            <p>Published by Humanitarian &amp; Emergency Affairs (HEA) on behalf of
                World Vision International.</p>

            <p>World Vision is a Christian humanitarian organisation dedicated to working
                with children, families and communities to overcome poverty and injustice.
                Motivated by our Christian faith, World Vision is dedicated to working with
                the world's most vulnerable people. World Vision serves all people regardless
                of religion, race ethnicity or gender.</p>

            <p>For further information about this publication or World Vision International
                publications, please contact via email <a href="#formModal" data-original-title="Click to submit form" data-placement="top" data-toggle="modal" class="tipify"><i class="fa fa-envelope-o"></i> wvi_publishing@wvi.org</a></p>

            <p>Managed on behalf of HEA by Tristan Clements.</p>
            <p>Editor-in-Chief: Edna Valdez.</p>
            <p>Production Management: Katie Klopman Fike, Daniel Mason.</p>
            <p>Copyediting: Audrey Dorsch.</p>

            <p>Website Design and Development: <a href="http://www.bluedigital.co.ke" target="_blank">Blue Digital</a>.
            </p>
        </div>
    </div>
</div>