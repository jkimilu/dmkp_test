<div class="admin-box">
    <h3>Edit Course</h3> 
    <?php echo form_open($saveCourseUrl); ?>
        <input type="hidden" name="id" value="<?php echo $course->id; ?>"/>

        <fieldset>


            <div class="control-group">
                <label for="name">Name</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'name', 'id' => 'name', 'min-length'=>"100", 'class' => 'form-control'), $course->name); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="course_provider_id">Provider</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'course_provider_id', 'id' => 'course_provider_id', 'class' => 'form-control'), $providers, $course->course_provider_id); ?>
                </div>
            </div>
            <hr>
          <!--  <div class="control-group">
                <label for="course_category_id">Category</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'course_category_id', 'id' => 'course_category_id', 'class' => 'form-control'), $categories, $course->course_category_id); ?>
                </div>
            </div> -->

            <hr/>

             <div class="control-group">
                <label for="course_category_id">Categories</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'category_id[]', 'id' => 'category_id[]', 'class' => 'form-control select2',"required"=>"required","multiple"=>true), $categories,$coursecategories); ?>
                </div>
            </div>

            <div class="control-group">
                <label for="category">Duration</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'duration', 'id' => 'duration', 'class' => 'form-control'), $course->duration); ?>
                </div>
            </div>

            <hr/>

            <div class="control-group">
                <label for="category">Link</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'url', 'id' => 'url', 'class' => 'form-control'), $course->url); ?>
                </div>
            </div>

            
            <hr>

            <div class="control-group">
                <label for="guidance_descriptor_text">Description - Text</label>
                <div class="controls">
                    <?php echo form_textarea(array('name'=> 'description', 'rows'=>2, 'id' => 'description', 'style' => 'width:60%;'), $course->description); ?>
                </div>
            </div>

            <hr/>
             <hr>
             <div class="control-group">
                <label for="name">Language</label>
                <div class="controls">
                   <?php echo form_dropdown(array('name'=> 'language[]', 'id' => 'language', 'class' => 'form-control select2','multiple'=>true), $languages, $data["language"]); ?>
                </div>
            </div>
            <!--
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
            <?php endif; ?>-->

            <div class="form-actions">
                <button type="submit" value="save" class="btn btn-primary">Save</button>
                <a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-danger">Cancel</a>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>
