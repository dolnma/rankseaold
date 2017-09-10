$(document).ready(function(){

	$(document).on('click', '#getId', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#dynamic-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/wp-content/themes/ranksea/popup/getpopup_mirage.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#dynamic-content').html('');    
			$('#dynamic-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});
$(document).ready(function(){
	
	$(document).on('click', '#getId', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#dynamic-content2').html(''); // leave it blank before ajax call
		$('#modal-loader2').show();      // load ajax loader
		
		$.ajax({
			url: '/wp-content/themes/ranksea/popup/gethelp_mirage.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#dynamic-content2').html('');    
			$('#dynamic-content2').html(data); // load response 
			$('#modal-loader2').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#dynamic-content2').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader2').hide();
		});
		
	});
	
});