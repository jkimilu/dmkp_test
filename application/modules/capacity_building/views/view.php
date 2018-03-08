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
<!-- /.row-alert -->
<div class="row-fluid row-fluid-into">
	<div class="row">
		<div class="panel panel-default">
   			<div class="panel-heading">
		    	<h3 class="panel-title"><div class="img" style="background-image: url('<?php echo(base_url('themes/dmkp/img/capacity_building.jpg')); ?>');">&nbsp;</div></h3>
		    	<h2><i class="fa fa-graduation-cap"></i>Course Information</i></h2>
		    	
	    	</div>
        <div class="panel-body">
        	<h3><?=$course->name?></h3><h4><?=$course->description?></h4><hr>
        	<div class="span12"><div class="span3">Provider:</div><div class="span9"><?=$course->provider?></div></div>
        	<div class="span12"><div class="span3">Category:</div><div class="span9"><?=$course->category?></div></div>
        	<div class="span12"><div class="span3">Duration:</div><div class="span9"><?=$course->duration?></div></div>
        	<div class="span12"><div class="span3">Course Link:</div><div class="span9"><a href='<?=$course->url?>'>Link</a></div></div>
        	<div class="span12"><div class="span3">Languages:</div><div class="span9"><?=$course->language?></div>
        </div>
      	
	</div> 
</div>




