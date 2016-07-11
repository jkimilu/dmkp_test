<?php $tabs = isset($content_partials["tabs"]) ? $content_partials["tabs"] : null; ?>

<div class="main_content">

    <?php
    $contentTitle = null;

    if(isset($contentEditedTitles[$content_item_key])) {
        $contentTitle = $contentEditedTitles[$content_item_key];
    } else {
        $contentTitle = trim($content_variables['title']) == '' ? $language[$content_item_key] : $content_variables['title'] ;
    }
    ?>

<?php if($tabs != null) : ?>

        <h3><i class="fa fa-users"></i> <?php echo($contentTitle); ?></h3>

        <?php echo $content_variables['content']; ?>

        <?php if(count($tabs) > 1) : ?>
            <div class="tab-content tab-content-sub-functions">

                <?php $tab_index = 1; ?>

                <h3><?php echo $tab_key;?></h3>

                <?php foreach($tabs as $tab_key => $tab_content) : ?>
                    <div class="tab-pane tor_tab <?php echo $tab_index == 1 ? 'active' : ''; ?>" id="sub_<?php echo $tab_index; ?>">
                        <h3><?php echo $tab_key; ?></h3>

                        <h3>Function Purpose</h3>

                        <?php echo $tab_content['content_purpose']; ?>

                        <h3>Specific Role</h3>

                        <?php echo $tab_content['content_role']; ?>

                        <div class="guidance">
                            <div class="alert alert-block alert-danger fade in">
                                <h5><i class="fa fa-exclamation-triangle"></i> Guidance</h5>
                                <ul>
                                    <li>Achievement of TOR objectives to the quality criteria is mandatory.</li>
                                    <li>SOGs are optional and should adapted to ensure that the TOR objective is achieved to quality criteria</li>
                                    <li>All Tools &amp; Standards referenced in the TOR/SOGs can be found in the "Operational Guidance" framework, which is available on WV Central</li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content">

                            <h5>Terms of Reference</h5>

                            <div id="tor_<?php echo $tab_index; ?>" class="tab-pane active">
                                <div class="well">
                                    <h4 class="well_h4"><?php echo $tab_content["title"]; ?></h4>
                                    <?php echo $tab_content["tor"]; ?>
                                </div>
                            </div>

                            <h5>Standard Operating Guidelines</h5>

                            <div id="sog_<?php echo $tab_index; ?>" class="tab-pane">
                                <div class="key alert alert-block alert-danger fade in">
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

                                <?php echo $tab_content["sog"]; ?>

                            </div>
                        </div>
                    </div>
                    <?php $tab_index ++; ?>
                <?php endforeach; ?>
            </div>

        <?php else : ?>

            <h3>Function Purpose</h3>

            <?php echo $tabs[0]['content_purpose']; ?>

            <h3>Specific Role</h3>

            <?php echo $tabs[0]['content_role']; ?>

            <div class="guidance">
                <div class="alert alert-block alert-danger fade in">
                    <h5><i class="fa fa-exclamation-triangle"></i> Guidance</h5>
                    <ul>
                        <li>Achievement of TOR objectives to the quality criteria is mandatory.</li>
                        <li>SOGs are optional and should adapted to ensure that the TOR objective is achieved to quality criteria</li>
                        <li>All Tools &amp; Standards referenced in the TOR/SOGs can be found in the "Operational Guidance" framework, which is available on WV Central</li>
                    </ul>
                </div>
            </div>

            <div class="tab-content">

                <h5>Terms of Reference</h5>

                <div id="tor" class="tab-pane active">

                    <div class="well">
                        <h4 class="well_h4"><?php echo $tabs[0]["title"]; ?></h4>
                        <?php echo $tabs[0]["tor"]; ?>
                    </div>
                </div>

                <h5>Standard Operating Guidelines</h5>

                <div id="sog" class="tab-pane">
                    <div class="key alert alert-block alert-danger fade in">
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

                    <?php echo $tabs[0]["sog"]; ?>

                </div>
            </div>

        <?php endif; ?>
    <?php else : ?>

        <h3>  <?php echo($contentTitle); ?></h3>
        <?php echo $content_variables['content']; ?>

    <?php endif; ?>
</div>

<pagebreak />