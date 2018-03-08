<div class="row-fluid">
<div class="span12"></div>
<div class="span12">
    <h5>  <a href="<?php echo site_url("admin/content/capacity_building/"); ?>" class=" " title='Back'>
        Courses <i class="fa fa-chevron-right"></i> </a> Provider <i class="fa fa-chevron-right"></i> <?=$provider->name?></h5>
</div>

 <div class="span12">Courses: <a href="<?php echo site_url("admin/content/capacity_building/add_course/$provider->id"); ?>" class="fa fa-plus" title='Add Course'></a>
    <hr></div>
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
                <td>$course_categories_list</td>
                <td>"; ?>

                

                 <a href="<?php echo site_url("admin/content/capacity_building/edit_course/$course->id"); ?>" class='fa fa-pencil'></a>

                  <a href="<?php echo site_url("admin/content/capacity_building/delete_course/$course->id"); ?>" class='fa fa-trash-o' onclick="return confirm('Are you sure you want to delete this course?')"></a>
               <? echo "
                
                </td>
                </tr>";

            }
        ?>
         </tbody>  
        </table>
       

             </div>

             <div class="span12">
                <div class="form-actions">
                    <a href="<?php echo site_url("admin/content/capacity_building/edit_provider/$provider->id"); ?>" class="btn btn-primary">Edit</a>
                &nbsp;
                <a href="<?php echo site_url("admin/content/capacity_building/delete_provider/$provider->id"); ?>" onclick="return confirm('Are you sure you want to delete this provider and all its associated courses?')" class="btn btn-danger">Delete</a>
            </div>



</div>

















