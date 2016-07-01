<div class="row-fluid">
    <!-- .main_col -->
    <div class="main_col main_col_copy">
        <h2><i class="fa fa-search"></i> Search Results</h2>

        <form class="form-search" enctype="multipart/form-data" method="get" action="search_results.html">
            <input name="search" placeholder="Search" class="span12 search-query" value="<?php echo $term; ?>" type="text">
        </form>

        <div class="alert alert-danger">
            11 matches found for <i>"World Vision International"</i>
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>

        <!-- tabbed results -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#results_tab_1" data-toggle="tab" class="tipify" data-original-title="<?php echo count($results['dm_policies']); ?> result">DM Policies <span class="badge badge-warning"><?php echo count($results['dm_policies']); ?></span></a></li>
            <li class=""><a href="#results_tab_2" data-toggle="tab" class="tipify" data-original-title="<?php echo count($results['dm_standards']); ?> results">DM Standards <span class="badge badge-warning"><?php echo count($results['dm_standards']); ?></span></a></li>
            <li><a href="#results_tab_3" data-toggle="tab" class="tipify" data-original-title="<?php echo count($results['ems']); ?> results">DM EMS Manual <span class="badge badge-warning"><?php echo count($results['ems']); ?></span></a></li>
            <li><a href="#results_tab_4" data-toggle="tab" class="tipify" data-original-title="<?php echo count($results['dm_preparedness']); ?> results">DM Preparedness <span class="badge badge-warning"><?php echo count($results['dm_preparedness']); ?></span></a></li>
            <li><a href="#results_tab_5" data-toggle="tab" class="tipify" data-original-title="<?php echo count($results['capacity_building']); ?> results">Capacity Building <span class="badge badge-warning"><?php echo count($results['capacity_building']); ?></span></a></li>
        </ul>
        <!-- /tabbed results -->

        <!-- tab content -->
        <div class="tab-content">
            <!-- tab-pane -->
            <div class="tab-pane active" id="results_tab_1">
                <!-- search results -->
                <ul class="unstyled search_ul">
                    <!-- li -->
                    <li>
                        <a href="#none"><h3><span class="highlight">World Vision International</span> Offices</h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->
                </ul>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_2">
                <!-- search results -->
                <ul class="unstyled search_ul">
                    <!-- li -->
                    <li>
                        <a href="#"><h3><span class="highlight">World Vision International</span> Staff Manual</h3></a>
                        <p><span><a href="#">http://projects.bluedigital.co.ke/wvi/public/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#none"><h3>The <span class="highlight">World Vision International</span> Emergency Management System</h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/public/index.php/ems/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#none"><h3>Careers at <span class="highlight">World Vision International</span></h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/public/index.php/ems/index/ems_summary/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                </ul>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_3">
                <!-- search results -->
                <ul class="unstyled search_ul">

                    <!-- li -->
                    <li>
                        <a href="#none"><h3>Careers at <span class="highlight">World Vision International</span></h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/public/index.php/ems/index/ems_summary/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#none"><h3><span class="highlight">World Vision International</span> Offices</h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->
                </ul>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_4">
                <!-- search results -->
                <ul class="unstyled search_ul">
                    <!-- li -->
                    <li>
                        <a href="http://projectss.bluedigital.co.ke/wvi/testededs/rwerdwe/wr"><h3>The <span class="highlight">World Vision International</span> Offices</h3></a>
                        <p><span><a href="http://projecssts.bluedigital.co.ke/wvi/testededs/ewrwer/345">http://projects.bluedigital.co.ke/wvi/public/index.php/ems/index/ems_summary/how_to_use_this_manual/0/1</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#"><h3><span class="highlight">World Vision International</span> Staff Manual</h3></a>
                        <p><span><a href="#">http://projects.bluedigital.co.ke/wvi/public/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#none"><h3>The <span class="highlight">World Vision International</span> Emergency Management System</h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/public/index.php/ems/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#none"><h3>Careers at <span class="highlight">World Vision International</span></h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/public/index.php/ems/index/ems_summary/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->

                    <!-- li -->
                    <li>
                        <a href="#none"><h3><span class="highlight">World Vision International</span> Offices</h3></a>
                        <p><span><a href="#none">http://projects.bluedigital.co.ke/wvi/</a></span></p>
                        <p class="search_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim...</p>
                    </li>
                    <!-- /li -->
                </ul>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_5">
                <!-- search results -->
                <div class="well text-center"><i class="fa fa-warning"></i> Your search for <i><span class="highlight">"World Vision International"</span></i> yielded no results within the capacity building section.</div>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->
        </div>
        <!-- /tab content -->
    </div>
</div>