<?php //echo $listView; ?>



<div class="row-fluid">

  <div class="span3">
    <h3><i class='fa fa-home'> Courses</i></h3>

  </div>
<div class="span9">
       <div class="pull-right"> 

       	<a href="<?php echo $addCourseUrl ?>" class="btn btn-primary">New Course</a>

       	<a href="<?php echo site_url('admin/content/capacity_building/providers'); ?>" class="btn btn-primary">Providers</a>

       	<a href="<?php echo site_url('admin/content/capacity_building/categories'); ?>" class="btn btn-primary">Categories</a>

          <a href="<?php echo site_url('admin/content/capacity_building/languages'); ?>" class="btn btn-primary">Languages</a>
	

    </div>

</div>

       <div class="clear"> <p></p></div>
        <table class="table table-compact table-striped" width="100%" id='dTable'>
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
                <td><a title='view course details' href='capacity_building/view_course/$course->id'>$course->name</a></th><th>"; ?>

                
                <a  title='view provider details' href="<?php echo site_url("admin/content/capacity_building/view_provider/$course->provider_id");?>"><?=$course->provider?></a>

               <?php echo "</td>
                <td>$course->duration</td>
                <td>$course->language</td>
                <td>$course_categories_list</td>
                <td>
                
                <a href='capacity_building/edit_course/$course->id' class=''><i class='fa fa-pencil'></i></a>"; ?>
                 <a href="capacity_building/delete_course/<?=$course->id?>" onclick="return confirm('Are you sure you want to delete this course?')" class=""><i class='fa fa-trash-o'> </i></a>
              <?  echo "
                </td>
                </tr>";

            }
        ?>
  </tbody>
        </table>
      

    </div>
   </div>