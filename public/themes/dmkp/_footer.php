
    <div class="row-fluid footer">
        <hr />

        <ul class="unstyled inline pull-left">
            <li><a href="<?php echo site_url('dmkp/copyright_notice'); ?>">Copyright Notice</a></li>
            <li class="administrator"><a href="<?php echo site_url('admin'); ?>" target="_blank">Admin</a></li>
        </ul>

        <ul class="unstyled inline pull-right">
            <li>&copy; World Vision International <?php echo date('Y'); ?> | All Rights Reserved</li>
        </ul>
    </div>

    <div id="logoutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel"><i class="fa fa-ban"></i> Log Out</h4>
        </div>

        <div class="modal-body">
            <p><?php echo $logged_in_user['first_name'] ?>, are you sure you want to log out?</p>
        </div>

        <div class="modal-footer">
            <a href="#none" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
            <a href="<?php echo site_url('dmkp/logout'); ?>" class="btn btn-primary"><i class="fa fa-ban"></i> Log Out</a>
        </div>
    </div>

    <div id="feedbackModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel"><i class="fa fa-comments"></i> Feed Back Form</h4>
        </div>

        <!-- form -->
        <div id="contact_form">
        <?php //echo form_open(site_url('dmkp/submit_feedback')); ?>
            <div class="modal-body container-fluid">
                <!-- .row-fluid -->
                <div class="row-fluid">
                	<div id="contact_results"></div>
                    <div class="alert alert-danger">Fields marked with an asterix (*) are required. <button class="close" type="button" data-dismiss="alert">x</button></div>

                    <h4>Type of feedback<span class="red_font">*</span></h4>

                    <label class="checkbox inline">
                            <input type="checkbox" name="content" id="1" value="Content"> Content
                        </label>
    
                        <label class="checkbox inline">
                            <input type="checkbox" name="links" id="2" value="Links"> Links
                        </label>
    
                        <label class="checkbox inline">
                            <input type="checkbox" name="design" id="2" value="Design"> Design
                        </label>
                        
                        <label class="checkbox inline">
                            <input type="checkbox" name="other" id="3" value="Other"> Other
                        </label>
                        
                        
                        <h4>Message<span class="red_font">*</span></h4>
                        <textarea class="span12" name="message" id="message" rows="4" required="true"></textarea>

                        <h4>Explain where on the page the issue is<span class="red_font">*</span></h4>
                        <textarea class="span12" name="explanation" id="explanation" rows="2" placeholder="eg. In the second paragraph, fourth line..." required="true"></textarea>

                    <input name="url_with_issue" value="<?php echo current_url(); ?>" type="hidden">

                    <div class="controls controls-row">
                    <?php //print_r($_SESSION); ?>
                        <input name="full_name" required="true" class="span6" placeholder="Your Name" id="disabledInput" value="<?php echo $logged_in_user['first_name'].' '.$logged_in_user['last_name'] ?>" type="text">
                        <input name="email_address" required="true" class="span6" placeholder="Your Email Address" value="<?php echo $logged_in_user['email'];?>"  type="email">
                        <input type="hidden" name="key" value="Pop1919izsCF2bMkV" />
                        
                    </div>
                </div>
                <!-- /.row-fluid -->
            </div>
            <!-- /.container-fluid -->
		
            <div class="modal-footer">
                <a href="#none" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
               <!-- <button type="submit" class="btn btn-primary"> Submit Form</button>-->
                 <input type="submit" id="submit_btn" class="btn btn-primary" value="Submit Form">
            </div>
        <?php echo form_close(); ?>
       </div>
    </div>

    <!-- Le javascript
            ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('themes/dmkp/js/bootstrap.min.js'); ?>"></script>

    <!-- Manually trigger the javascript functions -->
    <script>
        $(document).ready(function(){
            {
                $('.tipify').tooltip(); //Tool Tip
                $('.pop').popover(); // Pop Over
                $('.carousel').carousel(); // Carousel

                <?php echo(isset($extraJS) ? $extraJS : ''); ?>
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#submit_btn").click(function() { 
                var proceed = true;
                //simple validation at client's end
                //loop through each field and we simply change border color to red for invalid fields		
                $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
                    $(this).css('border-color',''); 
                    if(!$.trim($(this).val())){ //if this field is empty 
                        $(this).css('border-color','red'); //change border color to red   
                        proceed = false; //set do not proceed flag
                    }
                    //check invalid email
                    var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
                    if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                        $(this).css('border-color','red'); //change border color to red   
                        proceed = false; //set do not proceed flag				
                    }	
                });
               
                if(proceed) //everything looks good! proceed...
                {
                    //get input field values data to be sent to server
                    post_data = {
						'content'	: $('input[name="content"]:checked').val(),
						'links'	: $('input[name="links"]:checked').val(),
						'design'	: $('input[name="design"]:checked').val(),
						'other'	: $('input[name="other"]:checked').val(),
                        'message'		: $('textarea[name=message]').val(), 
                        'explanation'	: $('textarea[name=explanation]').val(),
						'full_name'	: $('input[name=full_name]').val(),
						'email_address'	: $('input[name=email_address]').val()
                    };
                    
                    //Ajax post data to server
                    $.post('<?php echo base_url();?>/lib/receiver.php', post_data, function(response){  
                        if(response.type == 'error'){ //load json data from server and output message     
                            output = '<div class="alert alert-danger">'+response.text+'</div>';
                        }else{
                            output = '<div class="alert-success">'+response.text+'</div>';
                            //reset values in all input fields
                            $("#contact_form  input[required=true], #contact_form textarea[required=true], #contact_form").val(''); 
							$('input:checkbox').removeAttr('checked');
                            $("#contact_form #contact_body").slideUp(); //hide form after success
                            setTimeout (window.close, 5000);
                        }
                        $("#contact_form #contact_results").hide().html(output).slideDown();
                    }, 'json');
                }
            });
            
            //reset previously set border colors and hide all message on .keyup()
            $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
                $(this).css('border-color',''); 
                $("#result").slideUp();
                //window.close();setTimeout (window.close, 5000);
            });
        });
        </script>

    <ul class="unstyled inline holla">
        <li><a href="#feedbackModal" class="btn btn-gray" data-toggle="modal"><i class="fa fa-comments"></i> Feedback</a></li>
        <li><a href="<?php echo site_url('dmkp/need_help'); ?>" class="btn btn-gray"><i class="fa fa-medkit"></i> Need help now?</a></li>
    </ul>
</body>