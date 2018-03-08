<div class="row-fluid">

  <div class="span3">
    <h3><i class='fa fa-home'> Providers</i></h3>
  </div>
<div class="span9">
       <div class="pull-right"> 

         <a href="<?php echo site_url('admin/content/capacity_building/add_provider'); ?>" class="btn btn-primary">New Provider</a>

        <a href="<?php echo site_url('admin/content/capacity_building'); ?>" class="btn btn-primary">Courses</a>

        <a href="<?php echo site_url('admin/content/capacity_building/categories'); ?>" class="btn btn-primary">Categories</a>
   

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
             foreach($providers as $provider)
            {

                echo "<tr>
                 <td scope='row'>$count</td>
                 <td>".anchor("admin/content/capacity_building/view_provider/$provider->id", $provider->name, array('title' => 'View Provider!'))."</td>
                
                
              
              <td>
                <a href=".site_url("/admin/content/capacity_building/edit_provider/$provider->id")." class=''><i class='fa fa-pencil'></i></a>";

                ?>
                
                <a href="<?=site_url("/admin/content/capacity_building/delete_provider/$provider->id")?>" onclick="return confirm('Are you sure you want to delete this provider and all its associated courses?')"><i class='fa fa-trash-o'></i></a>
                <? echo "</td>
                </tr>";

                $count++;

            }
        ?>
 </tbody>
        </table>
      

    </div>
   </div>


