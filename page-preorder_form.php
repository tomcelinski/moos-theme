<?php
/*
Template Name: PreOrder Form Page
*/


//$totalReserved = GWLimitBySum::get_field_values_sum("1", "5");
//$totalSpeakers = TOTAL_SPEAKERS;
//$pctReserved = round(($totalReserved / $totalSpeakers), 2) * 100;

get_header();
?>
<style type="text/css">
.page-template-page-preorder_form-php .main-container	{
	background: #e3e2dd;
	padding-bottom: 1px;
}

.page-template-page-preorder_form-php .gform_body {
	background: #ffffff;
}
#field_1_10 {
	text-align: center;
	font-size: 39px;
	color: #ea292e;
	padding-top: 1px;
	line-height: 39px;
}
#field_1_9 label, #field_1_4 label,
.gfield_label {
	text-transform: uppercase;
	color: #b4b3ac;
	font-size: 19px; 
}

#cardNumber, #cardCVC, #s2id_cardExpMonth span, #s2id_cardExpYear span, #input_1_9, #input_1_4 {
color: #000000;
}
#cardNumber, #cardCVC, #input_1_9, #input_1_4, .gfield input, .gform_wrapper input[type="text"], .gform_wrapper input[type="url"], .gform_wrapper input[type="email"], .gform_wrapper input[type="tel"], .gform_wrapper input[type="number"], .gform_wrapper input[type="password"]  {
	font-size: 26px;
	font-weight: 100;
	padding: 2px 5px;
	color: #000000;
}

#cardCVC {
	text-align: center;
}

#recurlyTarget {
 padding: 20px 37px 20px 37px;
 background: #f6f6f6;
 width: 460px;
 margin: 0 auto;
}
.gfield_required {
	display: none;
}
#recurlyTarget .fieldset {
	display: block !important;
	margin: 0;
	vertical-align: top;
}

#recurlyTarget .fieldset.inline {
	display: inline-block !important;
	margin-right: 0px;
	margin-top: 20px;
}

#recurlyTarget .fieldset.inline.expiration {
	margin-right: 25px;
	float: none;
}

#recurlyTarget .fieldset.inline.cvc {
	margin-right: 10px;
	float: right;
	text-align: right;
}

#cardNumber {
	width: 95%;
}

#recurlyTarget label {
	margin-right: 8px;
}

#recurlyTarget .expiration label {
    display: inline-block;
}

input#cardCVC {
	width: 75px;
}

#ccSubmit {
    display: block;
    margin: 30px auto 0;
    text-align: center;
    text-decoration: none;
    width: 213px;
    cursor: pointer;
	
	 background-color: #ea292e;
    background-repeat: repeat-x;
    color: #FFFFFF;
    font-size: 23px;
    font-weight: 100;
	 padding: 10px 0px;
	
}  

#ccErrors {
	background: red;
	padding: 10px;
	color: #fff;
	margin-bottom: 20px;
	display: none;
}

.select2-container .select2-choice span {
    line-height: 30px;
}

#ccSubmit:hover {
	background-color: #FF2A04;
}

#s2id_cardExpMonth {
	margin-right: 10px;
	width: 72px;
}

#s2id_cardExpMonth.select2-container .select2-choice,
#s2id_cardExpYear.select2-container .select2-choice {
padding: 7px 10px;
}
#recurlyTarget .fieldset label {
	display: block;
	text-transform: uppercase;
	color: #b4b3ac;
	font-size: 19px; 
}


#reserveCardsList {
	display: none;
}


#gform_submit_button_1 {
	display: none;
}


</style>

<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript">
   // this identifies your website in the createToken call below
   Stripe.setPublishableKey('<?php echo STRIPE_API_PUBLIC; ?>');

	$(document).ready(function() { $("#input_1_1, #input_1_2_6, #cardExpMonth, #cardExpYear").select2(); });
</script>


<div id="preorderForm">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
//the_content();
if($pctReserved < 100){
	echo '<div id="preorderForm">';
	gravity_form(1, false, false, false, '', true);
	echo '</div>';
}else{
	echo '<div id="notifyForm">';
	echo "<p id='notifyText'>We're sorry, all the speakers have been reserved. Share your email with us and we'll update you when we have more available.</p>";
	gravity_form(2, false, false, false, '', true);
	echo '</div>';
}
?>
<?php endwhile; ?>

<script type="text/javascript">
	window.moosStripeStatus = "";
	window.moosStripeResponse = "";
	
	jQuery.fn.cleardefault = function() {
		return this.focus(function() {
			if( this.value == this.defaultValue ) {
				this.value = "";
			}
		}).blur(function() {
			if( !this.value.length ) {
				this.value = this.defaultValue;
			}
		});
	};
	
	jQuery(document).bind('gform_post_render', function(){
      //console.dir(arguments);
		
		$('select').select2();
   });
	
	jQuery(document).ready(function($){
		jQuery(".clearit input, .clearit textarea").cleardefault();
		/*
		$('#input_1_2_2').live('keydown', function(e) { 
			var keyCode = e.keyCode || e.which; 
		 
			if (keyCode == 9) { 
			  e.preventDefault(); 
			  $('#input_1_3_1').focus();
			} 
		});
		*/
		$('#ccSubmit').live("click", function(e){
			e.preventDefault();
			
			if($(this).hasClass("submitting")){
				return false;
			}
			
			$(this).addClass("submitting")
			
			if($('#input_1_8').val().length < 1){
				Stripe.createToken({
					number: $('#cardNumber').val(),
					cvc: $('#cardCVC').val(),
					exp_month: $('#cardExpMonth').val(),
					exp_year: $('#cardExpYear').val()
				}, stripeResponseHandler);
			}else{
				stripeResponseHandler(window.moosStripeStatus, window.moosStripeResponse);
			}
			
			//$('#gform_submit_button_1').trigger('click');
		});
	});
	
	var ccErrorTO = "";
	
	function stripeResponseHandler(status, response) {
		window.moosStripeStatus = status;
		window.moosStripeResponse = response;
		
		$("#ccSubmit").removeClass("submitting");
		if (response.error) {
			//console.info(status);
			//console.dir(response);
			
			clearTimeout(ccErrorTO);
			$("#ccErrors").hide();
			
			 // show the errors on the form
			 $("#ccErrors").text(response.error.message);
			 $("#ccErrors").show();
			 
			 ccErrorTO = setTimeout(function(){$("#ccErrors").fadeOut();}, 4000);
		} else {
			 // token contains id, last4, and card type
			 var token = response['id'];
			 
			 //console.info(token);
			 // insert the token into the form so it gets submitted to the server
			 $('#input_1_8').val(token);
			 // and submit
			 
			 
			 $('#gform_submit_button_1').trigger('click');
		}
  }

</script>
		</div>
	</div>
</div>

<?php get_footer(); ?>