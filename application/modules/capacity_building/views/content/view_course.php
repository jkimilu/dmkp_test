

<div class="row-fluid row-fluid-into"> 
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="span12"></div>
            
                
            </div>
        <div class="panel-body">
             <div class="span12">
                <h5>  <a href="<?php echo site_url("admin/content/capacity_building/"); ?>" class=" " title='Back'>
                    Courses <i class="fa fa-chevron-right"></i> </a> <?=$course->name?></h5>
            </div>
            <h3><?=$course->name?></h3><h4><?=$course->description?></h4><hr>
            <div class="span12"><div class="span3">Provider:</div><div class="span9">

                


                <a href="<?php echo site_url("/admin/content/capacity_building/view_provider/$course->provider_id");?>"><?=$course->provider?></a>
                    

                </div></div>
            <div class="span12"><div class="span3">Category:</div><div class="span9"><a href="<?=site_url("/admin/content/capacity_building/view_category/$course->category_id")?>"><?=$course->category?></a></div></div>
            <div class="span12"><div class="span3">Duration:</div><div class="span9"><?=$course->duration?></div></div>
            <div class="span12"><div class="span3">Course Link:</div><div class="span9"><a href='<?=$course->url?>'>Link</a></div></div>
            <div class="span12"><div class="span3">Languages:</div><div class="span9"><?=$course->language?></div></div>

             <div class="span12">Resources: <?=anchor("admin/content/capacity_building/add_resource/$course->id", "<i class='fa fa-plus'> </i>",["title"=>"Add New Course Resource"])?><hr></div>

             <div class="span12">
                <?php foreach($resources as $resource) {

                    echo "<div class=''><a href='$resource->url'>$resource->name</a></div>";
                }
                ?>
                
             </div>
             
         
             <div class="span12">
                <div class="form-actions">
                    <a href="<?php echo $editCourseUrl."/".$course->id; ?>" class="btn btn-primary"><i class='fa fa-pencil'> Edit</i></a>
                &nbsp;
                <a href="<?php echo $deleteCourseUrl."/".$course->id; ?>" onclick="return confirm('Are you sure you want to delete this course?')" class="btn btn-danger"><i class='fa fa-trash-o'> Delete</i></a>
            </div>

      
            
            </div>
        </div>
        
    </div> 
</div>
</div>
</div>
</div>



