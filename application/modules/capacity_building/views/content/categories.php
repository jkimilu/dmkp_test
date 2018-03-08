<div class="row-fluid">

  <div class="span3">
    <h3><i class='fa fa-home'> Categories</i></h3>
  </div>
<div class="span9">
       <div class="pull-right"> 

         <a href="<?php echo site_url('admin/content/capacity_building/add_category'); ?>" class="btn btn-primary">New Category</a>

        <a href="<?php echo site_url('admin/content/capacity_building'); ?>" class="btn btn-primary">Courses</a>

        <a href="<?php echo site_url('admin/content/capacity_building/providers'); ?>" class="btn btn-primary">Providers</a>
   

    </div>
     <hr>
</div>
       <div class="clear"><p></p></div>
        <table class="table table-compact table-striped table-condensed" width="100%" id='dTable'>
            <thead><tr>
              <th>Id</th>
              <th>Name</th>
              <th>Actions</th></tr>
            </thead>
            <tbody>
            <?php 

            $count=1;
             foreach($categories as $category)
            {

                echo "<tr>
                 <td scope='row'>$count</td>
                 <td>".anchor("admin/content/capacity_building/view_category/$category->id", $category->name, array('title' => 'View category!'))."</td>
                
                
              
              <td>
                <a href=".site_url("/admin/content/capacity_building/edit_category/$category->id")." class=''><i class='fa fa-pencil'></i></a>";
                ?>
                <a href="<?=site_url("/admin/content/capacity_building/delete_category/$category->id")?>" onclick="return confirm('Are you sure you want to delete this category and all its associated courses?')"><i class='fa fa-trash-o'></i></a>

                <?
                echo "</td>
                </tr>";

                $count++;

            }
        ?>
      </tbody>
        </table>
      

    </div>
   </div>






