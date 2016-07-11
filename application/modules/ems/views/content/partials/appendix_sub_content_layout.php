<?php $tabs = isset($content_partials["tabs"]) ? $content_partials["tabs"] : null; ?>

<div class="main_content">

    <?php $contentTitle = trim($content_variables['title']) == '' ? $language[$content_item_key] : $content_variables['title'] ; ?>

    <h2><i class="fa fa-users"></i> <?php echo($contentTitle); ?></h2>

    <h3>Function Purpose</h3>

    <?php echo $content_variables['content']; ?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tor" data-toggle="tab"><i class="fa fa-list-ul"></i> Terms Of Reference</a></li>
        <li><a href="#sog" data-toggle="tab"><i class="fa fa-list-ul"></i> Standard Operating Guidelines</a></li>
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
        <div id="tor" class="tab-pane active">

            <div class="well">
                <?php echo $content_partials["terms_of_reference"]; ?>
            </div>
        </div>

        <div id="sog" class="tab-pane">
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

            <?php echo $content_partials["standard_operating_guidelines"]; ?>

        </div>
    </div>
</div>

<?php if(isset($content_partials['image_popups'])) : $popup_helpers->diagram_popups($content_partials['image_popups']); endif; ?>
<?php if(isset($content_partials['popups'])) : $popup_helpers->popups($content_partials['popups']); endif; ?>