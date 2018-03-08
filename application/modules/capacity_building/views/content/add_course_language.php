<div class="admin-box">
    <h3>Manage Course Languages</h3> 
    <?php echo form_open(); ?>
       

        <fieldset>


           
            <div class="control-group">
                <label for="course_provider_id">Course</label>
                <div class="controls">
                    <?php echo $course->name; ?>
                </div>
            </div>
            <hr>
             <div class="control-group">
                <label for="name">Language</label>
                <div class="controls">
                   <?php echo form_dropdown(array('name'=> 'language_id[]', 'id' => 'language_id', 'class' => 'form-control select2','multiple'=>true), $languages, $data["language_id"]); ?>
                </div>
            </div>

            <hr/>

            <div class="control-group">
                <?=$status["error"]?>
            </div>
            

            <div class="form-actions">
                <button type="submit" value="save" class="btn btn-primary">Save</button>
                <? echo anchor("admin/content/capacity_building/view_course/".$data['course_id'],"<i class='btn btn-danger'>Back</i>")?>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>
