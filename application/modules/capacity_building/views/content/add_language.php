<div class="admin-box">
    <h3>Add Category</h3> 
    <?php echo form_open(site_url("admin/content/capacity_building/save_language")); ?>
        

        <fieldset>


            <div class="control-group">
                <label for="name">Name</label>
                <div class="controls">
                    <?php echo form_input(array('name'=> 'name', 'id' => 'name', 'min-length'=>"100", 'class' => 'form-control',"required"=>"required", "value"=>set_value('name'))); ?>
                </div>
            </div>
      

            <div class="form-actions">
                <button type="submit"  value="save" class="btn btn-primary">Save</button>
                <a href="<?php echo site_url("admin/content/capacity_building/languages"); ?>" class="btn btn-danger">Discard</a>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>
