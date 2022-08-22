<script>
	$(document).ready(function(){
			$custom_fields = "<?php echo custom_fields_sort();?>";	
			if($custom_fields){
				$allfields_raw = $custom_fields.split(',');
				$.each($allfields_raw, function(key, val){
							$order = key+1;
							$('div[data-guid="'+val.replace('customfield-item-', '')+'"]').attr('data-order', $order);
				});
				$list = $('.customfield-item').sort(function (a, b) {
     				 var contentA =parseInt( $(a).attr('data-order'));
      				 var contentB =parseInt( $(b).attr('data-order'));
      			    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
   				});
				$('.custom-field-items').html($list);
			}
	});
</script>