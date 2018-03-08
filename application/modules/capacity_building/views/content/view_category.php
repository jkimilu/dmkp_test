<div class="row-fluid row-alert">
    <div class="span12">
        <!-- .alert -->
        <?php if(isset($pageAlert)) : ?>
            <div class="alert alert-block alert-info fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p><i class="fa fa-warning"></i> <?php echo $pageAlert; ?></p>
            </div>
        <?php endif; ?>
        <!-- /.alert -->
    </div>
</div>

<div class="row-fluid row-fluid-into"> 
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><div class="img" style="background-image: url('<?php echo(base_url('themes/dmkp/img/capacity_building.jpg')); ?>');">&nbsp;</div></h3>
                <h2> <i class="fa fa-gear"></i> Category Detail</i> &nbsp; </h2>

                
            </div>
        <div class="panel-body">
             <div class="span12"><a href="<?php echo site_url("admin/content/capacity_building/categories"); ?>" class="fa fa-chevron-left" title='Back'> Back</a></div>
            
             <div class="span12"><h3><?=$category->name?></h3></div>
             <div class="span12">Courses: <a href="<?php echo site_url("admin/content/capacity_building/add_course/?category_id=$category->id"); ?>" class="fa fa-plus" title='Add Course'></a><hr></div>
             <div class="span12">
               <table class="table table-compact table-striped table-condensed" width="100%" id='dTable'>
            <thead><tr><th>Course</th><th>Provider</th><th>Duration</th><th>Language</th><th>Category</th>
                <th>Actions</th></tr>
            </thead>
            <tbody>
            <?php 

             foreach($courses as $course)
            {

                


                $categories=$db->query("select cc.name from bf_course_categories_pivot pv left join bf_course_categories cc on cc.id=pv.category_id where course_id=$course->id")->result();
                $course_categories=[];
                if(count($categories)>0)
                {
                    foreach($categories as $cat){

                    $course_categories[]=$cat->name;

                    }

                   
                }
                 $course_categories_list=ucwords(implode(",",$course_categories));


                echo "<tr>
                 <td>"; ?>
 <a href="<?php echo site_url("admin/content/capacity_building/view_course/$course->id"); ?>"><?=$course->name?></a>

               <?  echo "</td>
                <th>$course->provider</td>
                
                <td>$course->duration</td>
                <td>$course->language</td>
                <td> $course_categories_list</td>
                <td>"; ?>

                

                 <a href="<?php echo site_url("admin/content/capacity_building/edit_course/$course->id"); ?>" class='fa fa-pencil'></a>

                  <a href="<?php echo site_url("admin/content/capacity_building/delete_course/$course->id"); ?>" class='fa fa-trash-o' onclick="return confirm('Are you sure you want to delete this course?')"></a>
               <? echo "
                
                </td>
                </tr>";

            }
        ?>

        </table>
        </tbody>  

             </div>
         
             <div class="span12">
                <div class="form-actions">
                    <a href="<?php echo site_url("admin/content/capacity_building/edit_category/$category->id"); ?>" class="btn btn-primary">Edit</a>
                &nbsp;
                <a href="<?php echo site_url("admin/content/capacity_building/delete_category/$category->id"); ?>" onclick="return confirm('Are you sure you want to delete this category and all its associated courses?')" class="btn btn-danger">Delete</a>
            </div>

      
            
            </div>
        </div>
        
    </div> 
</div>
</div>
</div>
</div>



