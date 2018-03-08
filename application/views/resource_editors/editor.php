<div class="admin-box">
    <h3>Resource Data</h3>
    <?php echo form_open($submitUrl); ?>
        <input type="hidden" name="id" value="<?php echo $recordId; ?>"/>

        <fieldset>

            <div class="control-group">
                <label for="category">Provider</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'provider_id', 'id' => 'provider_id', 'class' => 'form-control'), $providers, $selectedProviders); ?>
                </div>
            </div>
            <hr>
            <div class="control-group">
                <label for="category">Category</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'category', 'id' => 'category', 'class' => 'form-control'), $categories, $selectedCategories); ?>
                </div>
            </div>

            <hr/>

            <div class="control-group">
                <label for="grouping">Grouping</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'grouping', 'id' => 'grouping', 'class' => 'form-control'), $groups, $selectedGroups); ?>
                </div>
            </div>

            <hr/>

            <div class="control-group">
                <label for="guidance_descriptor_title">Guidance Descriptor - Title</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'guidance_descriptor_title', 'id' => 'guidance_descriptor_title', 'class' => 'form-control'), $guidanceDescriptorTitle); ?>
                </div>
            </div>

            <div class="control-group">
                <label for="guidance_descriptor_text">Guidance Descriptor - Text</label>
                <div class="controls">
                    <?php echo form_textarea(array('name'=> 'guidance_descriptor_text', 'id' => 'guidance_descriptor_text', 'style' => 'width:60%;'), $guidanceDescriptorText); ?>
                </div>
            </div>

            <hr/>

            <?php if($latestVersionEnabled) : ?>
                <div class="control-group">
                    <label for="latest_version">Latest Version</label>
                    <div class="controls">
                        <?php echo form_input(array('name'=> 'latest_version', 'id' => 'latest_version', 'class' => 'form-control'), $latestVersion); ?>
                    </div>
                </div>

                <hr/>
            <?php endif; ?>

            <?php if($contactPersonEnabled) : ?>
                <div class="control-group">
                    <label for="contact_person">Contact Person</label>
                    <div class="controls">
                        <?php echo form_dropdown(array('name'=> 'contact_person', 'id' => 'contact_person', 'class' => 'form-control'), $contactPersons['persons'], $selectedContactPersons); ?>
                    </div>
                </div>

                <hr/>
            <?php endif; ?>

            <?php if($gateKeeperEnabled) : ?>
                <div class="control-group">
                    <label for="gate_keeper">Gate Keeper</label>
                    <div class="controls">
                        <?php echo form_dropdown(array('name'=> 'gate_keeper', 'id' => 'gate_keeper', 'class' => 'form-control'), $gateKeepers['persons'], $selectedGateKeepers); ?>
                    </div>
                </div>

                <hr/>
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit" value="save" class="btn btn-primary">Save</button>
                <a href="<?php echo $backUrl; ?>" class="btn btn-danger">Discard</a>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>
