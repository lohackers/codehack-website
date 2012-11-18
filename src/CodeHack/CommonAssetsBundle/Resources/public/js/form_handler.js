/** * * * * * * * *
 * DONATION FORM HANDLING
** * * * * * * * */
$(function(){
	$('#form-donation-container form input')
		.focus(function(){
			$(this)
				.attr('value','');
			})
		.blur(function(){
			if($(this).attr('value')!=''){
				return 0;
				}
			$(this).attr('value',$(this).attr('original-value'));
			});
	});