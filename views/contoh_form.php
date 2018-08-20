<script type="text/javascript">
 	function dosubmit()
	{
    	$.post("<?=base_url()?>testing/dosubmit", $("#contoh-frm").serialize() ,
	 		function(returData)
			{
	 					if(returData.error)
						{
	 						alert(returData.message);
					        
							/*var rv = '<div class="alert alert-error">'+returData.message+'</div>';
							$('#show_message').html(rv);
							$('#show_message').slideDown('normal');	*/
							
							setTimeout(
								function(){
									$.unblockUI();
								}
							,1500);
							
						}
						else
						{
							
							var rv = returData.message;
							$('#blockMessage').html(rv);
							$('#blockMessage').slideDown('normal');
							
							//$("#blockMessage").html('<h1>Terima kasih, kami akan segera membalas email anda</h1>');	
						
							setTimeout(function() 
							{
							 	$.unblockUI();
							    if(returData.redirect)
								{
								    //redirect to index
 									window.location.href= returData.redirect;
								}
							    
							}, 5000);
							
						}	
	 					
	 		},'json').fail
			(
	 			function() 
				{ 
	 				$("#blockMessage").html('<h1>Request failed, please try again later or contact administrator</h1>');	
	 				setTimeout(
						function(){
							$.unblockUI();
						}
					,1500);
	 				
				}
	 		);
    }
	$(function($) {
		//showRecaptcha('recaptcha_div');
		
		$('#submit-contoh').click(function(e){
			
			e.preventDefault(); 	    	
	    	$.blockUI({ 
	    		message: $('#blockMessage'),
	            css: { 
	    		border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#cccccc', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } }); 
	        
	 		$("#blockMessage").html('<h1>Please wait... </h1>');
			
				dosubmit();
			return false;
		});
		
		
		
	}); 
</script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
	var xlocal = 1; //Initial field counter is 1
	var xcustom = 1; //Initial field counter is 1
	var xremarks = 1; //Initial field counter is 1

    var addButtonLocal = $('.add_button_local'); //Add button selector
	var addButtonCustom = $('.add_button_custom'); //Add button selector
	var addButtonRemarks = $('.add_button_remarks'); //Add button selector
	
    var wrapper = $('.field_wrapper'); //Input field wrapper
	var wrapper2 = $('.field_wrapper2'); //Input field wrapper
	var wrapper3 = $('.field_wrapper3'); //Input field wrapper
	
    var fieldHTML = '<div><input type="text" name="field_name[]" value="" placeholder="Kind of Charges"/>&nbsp;<input type="text" name="field_rate[]" value="" placeholder="Rate (IDR)"/>&nbsp;<input type="text" name="field_remarks[]" value="" placeholder="Remarks"/>&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/remove-icon.png"/></a></div>'; //New input field html 
    var fieldHTML2 = '<div><input type="text" name="field_name2[]" value="" placeholder="Kind of Charges"/>&nbsp;<input type="text" name="field_rate2[]" value="" placeholder="Rate (IDR)"/>&nbsp;<input type="text" name="field_remarks2[]" value="" placeholder="Remarks"/>&nbsp;<a href="javascript:void(0);" class="remove_button2" title="Remove field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/remove-icon.png"/></a></div>'; //New input field html 
    var fieldHTML3 = '<div><input type="text" name="field_remarks3[]" value="" placeholder="Remarks" /> <a href="javascript:void(0);" class="remove_button3" title="Remove field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/remove-icon.png"/></a></div>'; //New input field html 
  
	
	
    $(addButtonLocal).click(function(){ //Once add button is clicked
        if(xlocal < maxField){ //Check maximum number of input fields
            xlocal++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
	$(addButtonCustom).click(function(){ //Once add button is clicked
        if(xcustom < maxField){ //Check maximum number of input fields
            xcustom++; //Increment field counter
            $(wrapper2).append(fieldHTML2); // Add field html
        }
    });
	$(addButtonRemarks).click(function(){ //Once add button is clicked
        if(xremarks < maxField){ //Check maximum number of input fields
            xremarks++; //Increment field counter
            $(wrapper3).append(fieldHTML3); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        xlocal--; //Decrement field counter
    });
	$(wrapper2).on('click', '.remove_button2', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        xcustom--; //Decrement field counter
    });
	$(wrapper3).on('click', '.remove_button3', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        xremarks--; //Decrement field counter
    });
});
</script>
<form id="contoh-frm" method="post" action="<?=base_url();?>testing/dosubmit/">

	<input type="hidden" name="date" value="<?=date("Y-m-d")?>">
	<input type="text" name="send_to" placeholder="To"><br /><br />
	<input type="text" name="attn_to" placeholder="Attn"><br /><br />
	<input type="text" name="subject" placeholder="Subject"><br /><br />
	LOCAL CHARGE AT KOREA
	<div class="field_wrapper">
		<div>
			<input type="text" name="field_name[]" placeholder="Kind of Charges" value=""/>&nbsp;<input type="text" name="field_rate[]" placeholder="Rate (IDR)" value=""/>&nbsp;<input type="text" name="field_remarks[]" placeholder="Remarks" value=""/>
			<a href="javascript:void(0);" class="add_button_local" title="Add field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/add-icon.png"/></a>
		</div>
	</div>
	<br /><br />


	CUSTOM CLEARANCE IMPORT ( LCL - AIR )
	<div class="field_wrapper2">
		<div>
			<input type="text" name="field_name2[]" placeholder="Kind of Charges" value=""/>&nbsp;<input type="text" name="field_rate2[]" placeholder="Rate (IDR)" value=""/>&nbsp;<input type="text" name="field_remarks2[]" placeholder="Remarks" value=""/>
			<a href="javascript:void(0);" class="add_button_custom" title="Add field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/add-icon.png"/></a>
		</div>
	</div>

	<br /><br />
	Remarks :
	<div class="field_wrapper3">
		<div>
			<input type="text" name="field_remarks3[]" placeholder="Remarks" value=""/>&nbsp;<a href="javascript:void(0);" class="add_button_remarks" title="Add field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/add-icon.png"/></a>
		</div>
	</div>

	<br /><br />

	<input type="text" name="created_by" placeholder="dibuat Oleh"><br /><br />
	<input type="text" name="jabatan" placeholder="Jabatan"><br /><br />
	<input type="text" name="email" placeholder="Email Penerima"><br /><br />
	<input type="submit" value='Send' id='submit-contoh' class="button3"/>
</form>