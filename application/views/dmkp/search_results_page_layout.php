<div class="row-fluid">
    <!-- .main_col -->
    <div class="main_col main_col_copy">
        <h2><i class="fa fa-search"></i> Search Results</h2>

        <?php search_form($term, false); ?>

        <div class="alert alert-danger">
            <?php echo $totalResults; ?> matches found for <i>"<?php echo $term; ?>"</i>
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
                <?php if(count($results['dm_policies']) > 0) : ?>
                    <ul class="unstyled search_ul">
                        <!-- li -->
                        <?php foreach($results['dm_policies'] as $result) : ?>
                            <li>
                                <a href="<?php echo($result->link); ?>"><h3><?php echo($result->content_title); ?></h3></a>
                                <p><span><a href="<?php echo($result->link); ?>"><?php echo($result->link); ?></a></span></p>
                                <p class="search_p"><?php echo($result->brief_text); ?></p>
                            </li>
                        <?php endforeach; ?>
                        <!-- /li -->
                    </ul>
                <?php else: ?>
                    <div class="well text-center"><i class="fa fa-warning"></i> Your search for <i><span class="highlight">"<?php echo $term; ?>"</span></i> yielded no results within the DM Policies section.</div>
                <?php endif; ?>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_2">
                <!-- search results -->
                <?php if(count($results['dm_standards']) > 0) : ?>
                    <ul class="unstyled search_ul">
                        <!-- li -->
                        <?php foreach($results['dm_standards'] as $result) : ?>
                            <li>
                                <a href="<?php echo($result->link); ?>"><h3><?php echo($result->content_title); ?></h3></a>
                                <p><span><a href="<?php echo($result->link); ?>"><?php echo($result->link); ?></a></span></p>
                                <p class="search_p"><?php echo($result->brief_text); ?></p>
                            </li>
                        <?php endforeach; ?>
                        <!-- /li -->
                    </ul>
                <?php else: ?>
                    <div class="well text-center"><i class="fa fa-warning"></i> Your search for <i><span class="highlight">"<?php echo $term; ?>"</span></i> yielded no results within the DM Standards section.</div>
                <?php endif; ?>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_3">
                <!-- search results -->
                <?php if(count($results['ems']) > 0) : ?>
                    <ul class="unstyled search_ul">
                        <!-- li -->
                        <?php foreach($results['ems'] as $result) : ?>
                            <li>
                                <a href="<?php echo($result->link); ?>"><h3><?php echo($result->content_title); ?></h3></a>
                                <p><span><a href="<?php echo($result->link); ?>"><?php echo($result->link); ?></a></span></p>
                                <p class="search_p"><?php echo($result->brief_text); ?></p>
                            </li>
                        <?php endforeach; ?>
                        <!-- /li -->
                    </ul>
                <?php else: ?>
                    <div class="well text-center"><i class="fa fa-warning"></i> Your search for <i><span class="highlight">"<?php echo $term; ?>"</span></i> yielded no results within the EMS section.</div>
                <?php endif; ?>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_4">
                <!-- search results -->
                <?php if(count($results['dm_preparedness']) > 0) : ?>
                    <ul class="unstyled search_ul">
                        <!-- li -->
                        <?php foreach($results['dm_preparedness'] as $result) : ?>
                            <li>
                                <a href="<?php echo($result->link); ?>"><h3><?php echo($result->content_title); ?></h3></a>
                                <p><span><a href="<?php echo($result->link); ?>"><?php echo($result->link); ?></a></span></p>
                                <p class="search_p"><?php echo($result->brief_text); ?></p>
                            </li>
                        <?php endforeach; ?>
                        <!-- /li -->
                    </ul>
                <?php else: ?>
                    <div class="well text-center"><i class="fa fa-warning"></i> Your search for <i><span class="highlight">"<?php echo $term; ?>"</span></i> yielded no results within the DM Preparedness section.</div>
                <?php endif; ?>
                <!-- /search results -->
            </div>
            <!-- /tab-pane -->

            <!-- tab-pane -->
            <div class="tab-pane" id="results_tab_5">
                <?php if(count($results['capacity_building']) > 0) : ?>
                    <ul class="unstyled search_ul">
                        <!-- li -->
                        <?php foreach($results['capacity_building'] as $result) : ?>
                            <li>
                                <a href="<?php echo($result->link); ?>"><h3><?php echo($result->content_title); ?></h3></a>
                                <p><span><a href="<?php echo($result->link); ?>"><?php echo($result->link); ?></a></span></p>
                                <p class="search_p"><?php echo($result->brief_text); ?></p>
                            </li>
                        <?php endforeach; ?>
                        <!-- /li -->
                    </ul>
                <?php else: ?>
                    <div class="well text-center"><i class="fa fa-warning"></i> Your search for <i><span class="highlight">"<?php echo $term; ?>"</span></i> yielded no results within the Capacity Building section.</div>
                <?php endif; ?>
            </div>
            <!-- /tab-pane -->
        </div>
        <!-- /tab content -->
    </div>
</div>