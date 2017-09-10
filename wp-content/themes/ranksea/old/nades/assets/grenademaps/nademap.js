			$(document).ready(function () {
				$('.popup-youtube').magnificPopup({
				  disableOn: 3,
				  type: 'iframe',
				  mainClass: 'mfp-fade',
				  removalDelay: 160,
				  preloader: false,
					
				  fixedContentPos: false
				});
				$('.grenade').hover(
					function() {
						this_id = $(this).attr('id')
						label = $('#l'+this_id)
						label.css("color", "red")
					},
					function() {
						this_id = $(this).attr('id')
						label = $('#l'+this_id)
						label.css("color", "")
					}
				);
				$('.videoLink').hover(
					function() {
						this_id = $(this).attr('id').replace('l','')
						label = $('#'+this_id+" .line_dot")
						label.attr("class", label.attr("class") + " js_grenade_hover")
						label = $('#'+this_id+" .nade_white")
						label.attr("class", label.attr("class") + " js_grenade_hover")
					},
					function() {
						this_id =  $(this).attr('id').replace('l','')
						label = $('#'+this_id+" .line_dot")
						label.attr("class", label.attr("class").replace(" js_grenade_hover", ""))
						label = $('#'+this_id+" .nade_white")
						label.attr("class", label.attr("class").replace(" js_grenade_hover", ""))
					}
				);
				$(".videoLink").mouseenter(function(){
					$(this).css('color', 'red');
				}).mouseleave(function(){
					$(this).css('color', '');
				});
				$("#hideNadeList").click(function() {
				  $('#grenadeList').slideToggle();
				  $("#hideNadeList").toggleClass("glyphicon-chevron-down glyphicon-chevron-up")
				});
				
				$(".grenadeLink").hover(
					function(){
						var asdf = $(this).parent()
					if (typeof(Storage) !== "undefined") {
   					 // Retrieve
   					 	console.log(localStorage.getItem("smokemap"));
					}



						$("#map > g").each(function(){
                            console.log(this);
							if (!$(this).is(asdf)){

                                if ($(this).attr('name') == localStorage.getItem("smokemap")){
                                    $(this).attr("style", "opacity:0.1; pointer-events:none");
								}else{
                                    $(this).attr("style", "opacity:0; pointer-events:all;display:none;");
								};

							}
						})
						$(this).children('.line_dot').attr("class", $(this).children('.line_dot').attr("class") + " js_grenade_hover")
						$(this).find('.nade_white').attr("class", $(this).find('.nade_white').attr("class") + " js_grenade_hover")
					},
					function(){
						$("#map > g").each(function(){

                            if ($(this).attr('name') == localStorage.getItem("smokemap")){
                                $(this).attr("style", "opacity:1; pointer-events:all");
                            }else{
                                $(this).attr("style", "opacity:1; pointer-events:all;display:none;");
                            };


						})
						$(this).children('.line_dot').attr("class", $(this).children('.line_dot').attr("class").replace(" js_grenade_hover", ""))
						$(this).find('.nade_white').attr("class", $(this).find('.nade_white').attr("class").replace(" js_grenade_hover", ""))
					}
				)
				$("#overlay .grenadeLink").click(
					function(e){
						e.preventDefault()
					}
				)

			var down = false;
			var g_x0=0, g_y0=0, g_x1=0, g_y1=0;
			var rect;
			$( window ).resize(function() {
				updateRect();
			})
			$( window ).scroll(function() {
				updateRect()
			})
			updateRect = function(){
				rect = $('#map')[0].getBoundingClientRect();
			}
			rect = $('#map')[0].getBoundingClientRect();
			$('#map').mousedown(function(event){
				if (!down) {
					g_x0 = Math.round((event.clientX - rect.left) * (1024/rect.width))
					g_y0 = Math.round((event.clientY - rect.top) * (1024/rect.height))
					$('#makeCircle').attr('cx', g_x0)
					$('#makeCircle').attr('cy', g_y0)
					$('#makeLine').attr('x1', g_x0)
					$('#makeLine').attr('y1', g_y0)
					$('#makeLine').attr('x2', g_x0)
					$('#makeLine').attr('y2', g_y0)
					$('#makeNade').attr('x', (g_x0-27)*2)
					$('#makeNade').attr('y', (g_y0-27)*2)
				}
				down = true;
			})
			$('#map').mousemove(function( event ) {
				if (down){
					zx1 = Math.round((event.clientX - rect.left) * (1024/rect.width))
					zy1 = Math.round((event.clientY - rect.top) * (1024/rect.height))
					$('#makeLine').attr('x2', zx1)
					$('#makeLine').attr('y2', zy1)
					$('#makeNade').attr('x', (zx1-27)*2)
					$('#makeNade').attr('y', (zy1-27)*2)
				}
			})
			$('#map').mouseup(function(event){
				if (down) {
					g_x1 = Math.round((event.clientX - rect.left) * (1024/rect.width))
					g_y1 = Math.round((event.clientY - rect.top) * (1024/rect.height))
				}
				down = false
			})
			
			var rootURL = "http://"+window.location.host;
			var currentURL = stripTrailingSlash(location.protocol + '//' + location.host + location.pathname);
			$('#create').click(function() {
				if ($("#link").val() == "" || $("#name").val() == ""){
					alert("All grenades need links and labels!");
					return;
				}
				$.ajax(
					{
					url: rootURL+'/wp-content/themes/ranksea/nades/maps/'+mapid+'/grenades',
					type: 'POST',
					beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {x:g_x0, y:g_y0, x2:g_x1, y2:g_y1, nadetype:$("#nadetype").val(), link:$("#link").val(), label:$("#name").val()},
					success: function(response) {

						g_x = 0;
						g_y = 0;
						g_x2 = 0;
						g_y2 = 0;
						alert("Unknown error (are you logged in?)");
						if (response == "toomany"){
							alert("Sorry, each account is limited to 5 grenades per map during the testing period.");
						} else if (response == "success"){
							location.reload(); 
						} else {
							alert("Unknown error (are you logged in?)");
						}
					}
				});
			});
			$(".deleteButton").click(function(){
				$.ajax({
					type: 'DELETE',
					url: currentURL+"/grenades/"+$(this).attr('data-id'), 
					success: function(response) {
						location.reload();
					}
				});
			})

			$(".upvote").click(function() {
				if (loggedIn == "false"){
					alert("Sorry, you must be logged in to vote.");
					$('#sign_up').modal('show');
					return;
				}
				$.ajax({
					type: 'POST',
					url: currentURL+"/grenades/"+$(this).attr('data-id')+"/like",
					headers: {"X-HTTP-Method-Override": "PUT"},
					success: function(response) {
						location.reload();
						
					}
				});
				
			});
			$(".downvote").click(function() {
				if (loggedIn == "false"){
					alert("Sorry, you must be logged in to vote.");
					return;
			    	//$('#sign_up').modal('show');
				}		
				$.ajax({
					type: 'POST',
					url: currentURL+"/grenades/"+$(this).attr('data-id')+"/unlike",
					headers: {"X-HTTP-Method-Override": "PUT"},
					success: function(response) {
						location.reload();
					}
				});
			});

			function stripTrailingSlash(str) {
			    if(str.substr(-1) == '/') {
			        return str.substr(0, str.length - 1);
			    }
			    return str;
			}
		});
