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

<!-- row-fluid -->
<div class="row-fluid row-fluid-into">
    <!-- left -->
    <div class="span12">
        <div class="dm_intro">
            <div class="img" style="background-image: url('<?php echo(base_url('themes/dmkp/img/capacity_building.jpg')); ?>');">&nbsp;</div>
            <h2><i class="fa fa-graduation-cap"></i> Capacity Building</h2>
            <p>HEA focuses at both the organisational and individual staff levels to improve disaster management practice within World Vision. HEA seeks to strengthen the quality of our disaster management work by building capable staff, effective organisational systems and quality programming underpinned by the application of learning.  This page contains some links to relevant resources for response teams.</p>
        </div>
    </div>
    <!-- /left -->

    <!-- right 
    <div class="span2">
        <?php echo $keyInsights; ?>
    </div>
     /right -->
</div>
<!-- /row-fluid -->
<!-- row-fluid -->




<script type="text/javascript">

    function getParam(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}



    $(document).ready(function(){
        $('.tree-toggle').click(function () {
        $(this).parent().children('ul.tree').toggle(200);
    });
    $(function(){
    $('.tree-toggle').parent().children('ul.tree').toggle(200);
    });


    //reset all cookies on page reload
     Cookies.set("provider_id",0);
        Cookies.set("category_id",0);
    Cookies.set("language_id",0);

    //load all courses
    $("#courseList").load("capacity_building/course_list");

    $.get("capacity_building/category_list","",function(data){
          

            obj = $.parseJSON(data);
            $("#supcats").html(obj.length);

            $.each(obj,function(key,val){
                $("#categoryList").append("<li class='categories' category_id='"+val.category_id+"' ><a href='#'>"+val.name+"<sup>"+val.count+"</sup></a></li>");
     })

        
        

    });


    //$("#categoryList").load("capacity_building/category_list");

    $("#all").on("click", function() {
        
        //unset all cookies

        Cookies.set("provider_id",0);
        Cookies.set("category_id",0);
        Cookies.set("language_id",0);


        $(".tree li").removeClass("active");
        $('.tree-toggle').parent().children('ul.tree').toggle(false);
        $("#courseList").load("capacity_building/course_list");
        $.get("capacity_building/category_list","",function(data){
          

            obj = $.parseJSON(data);
            $("#supcats").html(obj.length);

            $.each(obj,function(key,val){
                $("#categoryList").append("<li class='categories' category_id='"+val.category_id+"' ><a href='#'>"+val.name+"<sup>"+val.count+"</sup></a></li>");
     });});

    });

     var providers=[];
     var categories=[];
     var url="";

    $(document).on("click",".providers", function(e) {
        
        e.preventDefault();

       
        $(this).addClass("active");

        $(".languages").removeClass("active");

       

        if($.inArray($(this).attr("provider_id"),providers)>-1)
        {
            providers.splice(providers.indexOf($(this).attr("provider_id")), 1);
            $(this).removeClass("active");
           
        }
        else{
        providers.push($(this).attr("provider_id"));
        
        }



        
        url="provider_id="+JSON.stringify(providers);

        Cookies.set("provider_id",$(this).attr("provider_id"));

        $("#courseList").load("capacity_building/course_list?"+url);


        $.get("capacity_building/category_list","provider_id="+JSON.stringify(providers),function(data){

            obj = $.parseJSON(data);
            $("#supcats").html(obj.length)
            $("#categoryList li").remove();
            $.each(obj,function(key,val){
                $("#categoryList").append("<li class='categories' category_id='"+val.category_id+"' ><a href='#'>"+val.name+"<sup>"+val.count+"</sup></a></li>");
            });

        });

        //$("#categoryList").load("capacity_building/category_list?provider_id="+$(this).attr("provider_id"));


    });

    

    $(document).on("click",".categories", function(e) {
        
        //e.preventDefault();
        //var url="";



        //$(".categories").removeClass("active");
        $(this).addClass("active");

        $(".languages").removeClass("active");

        if($.inArray($(this).attr("category_id"),categories)>-1)
        {
            categories.splice(categories.indexOf($(this).attr("category_id")), 1);
            $(this).removeClass("active");
           
        }
        else{
        categories.push($(this).attr("category_id"));
        
        }

       

        Cookies.set("category_id",$(this).attr("category_id"));

        //if(Cookies.get("provider_id")>0)
        url=url+"&category_id="+JSON.stringify(categories);

       


         $("#courseList").load("capacity_building/course_list?"+url);

        //$("#courseList").load("capacity_building/course_list?"+url+"&category_id="+JSON.stringify(categories));


    });

   $(document).on("click",".languages", function(e) {
        
        //var url="";
        Cookies.set("languages", 1);
        $(".languages").removeClass("active");
         $(this).addClass("active");

        
        //url=url+"&category_id="+Cookies.get("category_id");

            //alert($(this).attr("language")+url);

        $("#courseList").load("capacity_building/course_list?"+url+"&language="+$(this).attr("language"));

    });

    


    


});
</script>





<div class="row-fluid">
    <div class="span3">



        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Filter Courses</h3>
                </div>
                <div class="panel-body">
            <div>
            <ul class="nav nav-list">
                <? echo "<li><label id='all' class='tree-toggle nav-header'></span><a href=''>All Courses<sup> ".$all_courses."</sup></label></a></li>"; ?>
       
                <li ><label id='providers' class="tree-toggle nav-header"></span> By Providers <sup><?=count($providers)?></sup></label>
                    <ul class="nav nav-list tree">

                        <?php
                         foreach($providers as $provider)
                        {  
                            
                            echo "<li class='providers' provider_id='$provider->provider_id' ><a href='#'>".$provider->name ."<sup> ".$provider->count."</sup></a></li>";

                        } 
                        ?>
                    </ul>
                </li>
                <li class="divider"></li>
                <li><label id='categories'  class="tree-toggle nav-header">By Category <sup id='supcats'><?=count($course_categories)?></sup></label>
                  <ul class="nav nav-list tree" id='categoryList'>
                     
                    </ul>
                            </li>
                <li class="divider"></li>
                <li><label id='languages' class="tree-toggle nav-header">By Language <sup><?=count($languages)?></sup></label>
                    <ul class="nav nav-list tree">
                      <?php
                         foreach($languages as $language)
                        {  
                           
                            //print_r($category2);
                           echo "<li class='languages' language='$language->name'><a href='#'>".$language->name ."</a><span class='small'></span></li>";

                        } 

                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </div>





    </div>

    <div class="span9">

        <div id="courseList"></div>

      
</div>

</div>


   