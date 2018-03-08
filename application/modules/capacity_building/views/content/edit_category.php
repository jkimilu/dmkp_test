<div class="admin-box">
    <h3>Edit Category</h3> 
    <?php echo form_open(site_url("admin/content/capacity_building/save_category")); ?>
        <input type="hidden" name="id" value="<?=$category->id?>">

        <fieldset>


            <div class="control-group">
                <label for="name">Name</label>
                <div class="controls">
                    <?php echo form_input(['name'=> 'name', 'id' => 'name', 'min-length'=>"100", 'class' => 'form-control',"required"=>"required"],$category->name); ?>
                </div>
            </div>
      

            <div class="form-actions">
                <button type="submit"  value="save" class="btn btn-primary">Save</button>
                <a href="<?php echo site_url("admin/content/capacity_building/categories"); ?>" class="btn btn-danger">Discard</a>
            </div>
        </fieldset>
    <?php echo form_close(); ?>
</div>
