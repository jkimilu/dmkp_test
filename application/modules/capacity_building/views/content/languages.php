<div class="row-fluid">

  <div class="span3">
    <h3><i class='fa fa-home'> Languages</i></h3>
  </div>
<div class="span9">
       <div class="pull-right"> 

          <a href="<?php echo site_url('admin/content/capacity_building/add_language'); ?>" class="btn btn-primary">New Language</a>

        <a href="<?php echo site_url('admin/content/capacity_building'); ?>" class="btn btn-primary">Courses</a>

        <a href="<?php echo site_url('admin/content/capacity_building/providers'); ?>" class="btn btn-primary">Providers</a>
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
             foreach($languages as $language)
            {

                echo "<tr>
                 <td scope='row'>$count</td>
                 <td>$language->name</td>
                
                
              
              <td>
                <a href=".site_url("/admin/content/capacity_building/edit_language/$language->id")." class=''><i class='fa fa-pencil'></i></a>";
                ?>
                <a href="<?=site_url("/admin/content/capacity_building/delete_language/$language->id")?>" onclick="return confirm('Are you sure you want to delete this language?')"><i class='fa fa-trash-o'></i></a>

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




