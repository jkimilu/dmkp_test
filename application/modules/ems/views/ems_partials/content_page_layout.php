<div class="row-fluid body">

    <div class="left_col span3">

        <form class="form-search" enctype="multipart/form-data" method="get" action="">
            <input name="search" type="text" placeholder="Search" class="span12 search-query">
        </form>

        <div class="accordion" id="accordion_nav">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapseOne">
                        <i class="fa fa-info-circle"></i> EMS summary
                    </a>
                </div>

                <div id="collapseOne" class="accordion-body in collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-pills nav-stacked small_font">
                            <li class="active"><a href="summary.html">  Summary</a></li>
                            <li><a href="how.html">  How to use this manual</a></li>
                            <li><a href="why.html">  Why this manual?</a></li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapseTwo">
                        <i class="fa fa-list-ol"></i> EMS Principles
                    </a>
                </div>

                <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-pills nav-stacked small_font">
                            <li><a href="intro_principles.html">Introduction</a></li>
                            <li><a href="principles_mngmnt.html">1. Management by objective</a></li>
                            <li><a href="principles_unity.html">2. Unity of command</a></li>
                            <li><a href="principles_flexible.html">3. Flexible &amp; temporary structure</a></li>
                            <li><a href="principles_span.html">4. Span of control</a></li>
                            <li><a href="principles_terminology.html">5. Common terminology</a></li>
                            <li><a href="principles_competency.html">6. Competency based staffing</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapseThree">
                        <i class="fa fa-cogs"></i> EMS Functions
                    </a>
                </div>

                <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-pills nav-stacked small_font">
                            <li class="Lead"><a href="intro_functions.html">Introduction</a></li>
                            <li class="Lead"><a href="lead.html"><i class="fa fa-users"></i> Response Manager (Lead)</a></li>
                            <li class="Plan"><a href="plan.html"><i class="fa fa-file"></i> Programmes (Plan)</a></li>
                            <li class="Implement"><a href="implement.html"><i class="fa fa-cogs"></i> Operations (Implement)</a></li>
                            <li class="Resource"><a href="resource.html"><i class="fa fa-briefcase"></i> Support Services (Resource)</a></li>
                            <li class="Facilitate"><a href="facilitate.html"><i class="fa fa-comments"></i> Liaison (Facilitate)</a></li>
                            <li class="Protect"><a href="protect.html"><i class="fa fa-shield"></i> Security (Protect)</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapseFour">
                        <i class="fa fa-exchange"></i> Shared Leadership in EMS
                    </a>
                </div>

                <div id="collapseFour" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-pills nav-stacked small_font">
                            <li><a href="leadership_shared.html">Introduction</a></li>
                            <li><a href="leadership_levels.html">  Levels of Accountability and Responsibility</a></li>
                            <li><a href="leadership_shared_ems.html">  Shared Leadership &amp; EMS</a></li> <li><a href="orient.html">  1. Orient</a></li> <li><a href="ensure.html">  2. Ensure</a></li> <li><a href="enable.html">  3. Enable</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapseFive">
                        <i class="fa fa-list-ul"></i> TORs &amp; SOGs
                    </a>
                </div>

                <div id="collapseFive" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-pills nav-stacked small_font">
                            <li><a href="ts_response_manager.html">  Response Manager</a></li>
                            <li><a href="ts_senior_leadership.html">  Senior Leadership</a></li>
                            <li><a href="ts_programmes.html">  Programmes Function Lead</a></li>
                            <li><a href="ts_operations.html">  Operations Function Lead</a></li>
                            <li><a href="ts_support.html">  Support Services Function Lead</a></li>
                            <li><a href="ts_liaison.html">  Liaison Function Lead</a></li>
                            <li><a href="ts_security.html">  Security Function Lead</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right_col span9">
        <?php echo $breadcrumb; ?>

        <!-- Content section -->

        <?php echo $page_content; ?>

        <div class="well overflow_auto">
            <?php if ($previous_link != null) : ?>
                <a href="<?php echo($previous_link); ?>" class="btn pull-left"><i class="fa fa-arrow-left"></i> <?php echo $language[$previous_node]; ?> </a>
            <?php endif; ?>

            <?php if ($next_link != null) : ?>
                <a href="<?php echo($next_link); ?>" class="btn pull-right"><?php echo $language[$next_node]; ?> <i class="fa fa-arrow-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>