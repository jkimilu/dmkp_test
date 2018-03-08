<div class="admin-box">
    <h3>Edit Course Resource</h3> 
    <?php echo form_open(site_url("admin/content/capacity_building/saveResource")); ?>

<input type="hidden" name="id" value="<?=$resource->id?>" >

        <fieldset>


            <div class="control-group">
                <label for="name">Name</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'resource_name', 'id' => 'resource_name', 'min-length'=>"100", 'class' => 'form-control'),$resource->resource_name); ?>
                </div>
            </div>
            <div class="control-group">
                
                <div class="controls">
                    <?php echo form_input(array('name'=> 'resource_category', 'id' => 'resource_category', 'min-length'=>"100", 'class' => 'form-control', "type"=>"hidden","value"=>"capacity_building")); ?>
                </div>
            </div>
            <div class="control-group">
                <label for="course_provider_id">Course</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'resource_id', 'id' => 'resource_id', 'class' => 'form-control select2'), $courses,$resource->resource_id); ?>
                </div>
            </div>
            <hr>
            <div class="control-group">
                <label for="course_category_id">Type</label>
                <div class="controls">
                    <?php echo form_dropdown(array('name'=> 'resource_type', 'id' => 'resource_type', 'class' => 'form-control select2'), $types,$resource->resource_type); ?>
                </div>
            </div>

            <hr/>

        

            <div class="control-group">
                <label for="category">Link</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'resource_url', 'id' => 'resource_url', 'class' => 'form-control'),$resource->resource_url); ?>
                </div>
            </div>

            

            <div class="form-actions">
                <button type="submit" value="save" class="btn btn-primary">Save</button>
                <? echo anchor("admin/content/capacity_building/view_course/".$resource->resource_id,"<i class='btn btn-danger'>Back</i>")?>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>
