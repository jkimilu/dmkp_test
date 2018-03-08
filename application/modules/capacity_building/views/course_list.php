<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" type="text/css">

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

      <script src="<?php echo base_url('themes/dmkp/js/js.cookie.js'); ?>"></script>
    

     <script>
    $().ready(function(){

        $("#dTable").dataTable();

    
    })
     </script>






        

      <div class=""><ol class="breadcrumb"><li class="breadcrumb-item">Search: </li><?=$menu?></ol></div>
        <table class="table table-compact table-striped table-condensed" width="100%" id='dTable'>
            <thead><tr><th>Course</th><th>Provider</th><th>Description</th><th>Link</th><th>Duration</th><th>Language</th><th>Category</th></tr>
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
                <td><a href='capacity_building/view/$course->id'>$course->name</a></td>
                <td>$course->provider</td>
                <td>$course->description</td>
                <td>";
                echo $course->url?"<a href='$course->url' target='_blank'>link</a>":"";
                echo "</th>
                <td>$course->duration</td>
                <td>$course->language</td>
                <td>$course_categories_list</td>
                </tr>";

            }
        ?>
          </tbody>
        </table>
      

    </div>






   


