<?php $tabs = $content_partials["tabs"]; ?>

<div class="main_content">
    <h2><i class="fa fa-users"></i> <?php echo($language[$content_item_key]); ?></h2>

    <?php if(count($tabs) > 1) : ?>
        <ul class="nav nav-tabs sub-functions" id="">
            <?php $tab_index = 1; ?>
            <?php foreach($tabs as $tab_key => $tab_content) : ?>
                <li<?php echo $tab_index == 1 ? ' class="active"' : ''; ?>><a href="#sub_<?php echo $tab_index; ?>" data-toggle="tab" data-original-title="Regional Leader Sub-Function" data-placement="top" class="tipify"><?php echo $tab_key;?></a></li>
                <?php $tab_index ++ ; ?>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if(count($tabs) > 1) : ?>
        <div class="tab-content tab-content-sub-functions">

            <?php $tab_index = 1; ?>

            <?php foreach($tabs as $tab_key => $tab_content) : ?>
                <div class="tab-pane tor_tab <?php echo $tab_index == 1 ? 'active' : ''; ?>" id="sub_<?php echo $tab_index; ?>">
                    <h2><?php echo $tab_key; ?></h2>

                    <h3>Function Purpose</h3>

                    <?php echo $content_purpose; ?>

                    <h3>Specific Role</h3>

                    <?php echo $content_role; ?>

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tor_1" data-toggle="tab"><i class="fa fa-list-ul"></i> Terms of Reference</a></li>
                        <li><a href="#sog_1" data-toggle="tab"><i class="fa fa-list-ul"></i> Standard Operating Guidelines</a></li>
                    </ul>

                    <div class="guidance">
                        <div class="alert alert-block alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <h5><i class="fa fa-exclamation-triangle"></i> Guidance</h5>
                            <ul>
                                <li>Achievement of TOR objectives to the quality criteria is mandatory.</li>
                                <li>SOGs are optional and should adapted to ensure that the TOR objective is achieved to quality criteria</li>
                                <li>All Tools &amp; Standards referenced in the TOR/SOGs can be found in the "Operational Guidance" framework, which is available on WV Central</li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="tor_1" class="tab-pane active">

                            <div class="well">
                                <h4>Regional Leader</h4>
                                <ol>
                                    <li>Oversight on selection of response model based on recommendation from DDG</li>
                                    <li>Ensures response strategy targets beneficiaries most affected by the emergency; reflects global and national strategies and resolves prioritisation between the response and ongoing national programs</li>
                                    <li>Accountable to Partnership for response strategy effectiveness, national strategy revision (including NO business continuity decisions on stop/redirect/postpone ) and transition of response into national program</li>
                                    <li>Ensure response meets core WV and international Disaster Management policies and standards</li>
                                    <li>Monitors and manages regional organisational risks that have resulted from the emergency response</li>
                                    <li>Coordinate international level WV stakeholders to ensure emergency program objectives can be achieved and monitor strategic level risks</li>
                                    <li>Ensure the allocation of adequate global and national financial and human resources to response program</li>
                                    <li>Ensure the transition of response deliverables and capacity into ongoing national program</li>
                                    <li>Chairs Partnership Executive Team</li>
                                </ol>
                            </div>
                        </div>

                        <div id="sog_1" class="tab-pane">
                            <h4>Key Guidance Tools and Standards:</h4>
                            <ul>
                                <li>WV Disaster Management Policy </li>
                                <li>WV Disaster Management Standards </li>
                                <li>Declaration Decision Group TOR </li>
                                <li>Partnership Executive Team TOR </li>
                                <li>Partnership Coordination Team TOR</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php $tab_index ++; ?>
            <?php endforeach; ?>
        </div>

    <?php else : ?>

        <!-- TODO: No tabs -->
        
    <?php endif; ?>

    <div class="key alert alert-block alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5><i class="fa fa-key"></i> Key</h5>

        <dl class="dl-horizontal">
            <dt><span class="badge badge-important">m</span></dt>
            <dd>Mandatory quality criteria to be achieved to successfully complete the TOR objective</dd>
        </dl>

        <dl class="dl-horizontal">
            <dt><span class="badge badge-warning">e</span></dt>
            <dd>External sourced Tool or Standard to World Vision</dd>
        </dl>

        <dl class="dl-horizontal">
            <dt><span class="badge">i</span></dt>
            <dd>Internal sourced Tool or Standard for World Vision</dd>
        </dl>

    </div>
</div>