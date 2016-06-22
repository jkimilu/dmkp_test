<?php echo form_open($submitUrl); ?>
    <div class="form-group">
        <label for="category">Category</label>
        <?php echo form_dropdown(array('name'=> 'category', 'id' => 'category', 'class' => 'form-control'), $categories, $selectedCategories); ?>
    </div>

    <div class="form-group">
        <label for="grouping">Grouping</label>
        <?php echo form_dropdown(array('name'=> 'grouping', 'id' => 'grouping', 'class' => 'form-control'), $groups, $selectedGroups); ?>
    </div>

    <div class="form-group">
        <label for="guidance_descriptor_title">Guidance Descriptor - Title</label>
        <?php echo form_input(array('name'=> 'guidance_descriptor_title', 'id' => 'guidance_descriptor_title', 'class' => 'form-control'), $guidanceDescriptorTitle); ?>
    </div>

    <div class="form-group">
        <label for="guidance_descriptor_text">Guidance Descriptor - Text</label>
        <?php echo form_textarea(array('name'=> 'guidance_descriptor_text', 'id' => 'guidance_descriptor_text', 'class' => 'form-control'), $guidanceDescriptorText); ?>
    </div>

    <?php if($latestVersionEnabled) : ?>
        <div class="form-group">
            <label for="latest_version">Latest Version</label>
            <?php echo form_input(array('name'=> 'latest_version', 'id' => 'latest_version', 'class' => 'form-control'), $latestVersion); ?>
        </div>
    <?php endif; ?>

    <?php if($contactPersonEnabled) : ?>
        <div class="form-group">
            <label for="contact_person">Contact Person</label>
            <?php echo form_dropdown(array('name'=> 'contact_person', 'id' => 'contact_person', 'class' => 'form-control'), $contactPersons, $selectedContactPersons); ?>
        </div>
    <?php endif; ?>

    <?php if($gateKeeperEnabled) : ?>
        <div class="form-group">
            <label for="gate_keeper">Gate Keeper</label>
            <?php echo form_dropdown(array('name'=> 'gate_keeper', 'id' => 'gate_keeper', 'class' => 'form-control'), $gateKeepers, $selectedGateKeepers); ?>
        </div>
    <?php endif; ?>

    <button type="submit" value="save" class="btn btn-primary">Save</button>
    <button type="submit" value="discard" class="btn btn-danger">Discard</button>
<?php echo form_close(); ?>