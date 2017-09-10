$(document).ready(function()
{
	View.init();
});

/**
*/
View = {
	map: [
		{key:'Space', keyCode:32, down:'History.close()', prevent:true }, // Close
		{key:'F',     keyCode:70, down:'More.favorite()', prevent:true }, // Favorite
		{key:'S',     keyCode:83, down:'More.share()',    prevent:true }, // Share
		{key:'G',     keyCode:71, down:'More.getpos()',   prevent:true }, // Getpos
	],

	init: function()
	{
		if ($('#application'))
		{
			$('#view .close').click(function()
			{
				History.close();
			});

			// Add Clickevent
			$('#svgView g').click(function()
			{
				var map  = $('#svgView').attr('data-map');
				var type = $(this).attr('data-type');
				var id   = $(this).attr('data-id');
				View.open(type, id);
				ga('send', 'event', 'Stuff', type, map, id);
			});
		}
	},


	isOpen: function() { return $('#view').is(':visible'); },

	open: function(pType, pId)
	{
		Mapping.setMap( View.map );

		// Loading
		$('#view svg.background').html(''+
			'<use xlink:href="#'+ pType +'" x="10%" y="10%" width="80%" height="80%" style="stroke:transparent; fill:#95a5a6;" />'+
			'<use xlink:href="#Loading" x="45%" y="45%" width="10%" height="10%" style="stroke:transparent; fill:#ecf0f1;"></use>'+
		'');

		// Open
		$('#view').addClass('open');
		View.loadContent(pType, pId);
	},

	close: function()
	{
		More.reportClose();
		Mapping.setMap( Selector.map );

		// Re-init View & Crosshair
		$('#view').removeClass('open');
		$('#view').removeClass('type-01');

		$('#view .img-container').html('');
		$('#view .location').removeClass('shown');
		$('#view .view-container .desc-container').removeClass('shown');
		$('#view .view-container #more').removeClass('shown');

		View.resetCrosshair();

		More.shareSet('http://ranksea.com/');
    More.getposSet('setpos 0 0 0;setang 0 0 0');
	},


	loadContent: function(pType, pId)
	{
		call_api('api_check_view', { 'id': pId }, View.loadContentCallback);
	},

	loadContentCallback: function(pData)
	{
		if (pData == 'ERR')
		{
			$('#view svg').html('<use xlink:href="#Error" x="45%" y="45%" width="10%" height="10%" style="stroke:transparent; fill:#ecf0f1;" />');
		}
		else
		{
			var data = JSON.parse(pData);

			// URL
			var urlbase   = document.URL;
			var slash     = (urlbase.substring(urlbase.length-1) == '/') ? '' : '/';
			var stufflink = ''+ slash +''+ data['type'] +'/'+ data['id'] +'/'+ View.toSlug(data['to_name']) +'-from-'+ View.toSlug(data['from_name']) +'';
			if (urlbase.indexOf(stufflink) > -1)
			{
				newURL = urlbase;
				More.shareSet(newURL);
			}
			else
			{
				var newURL = document.URL + stufflink;
				More.shareSet(newURL);
				History.open(data, newURL);
			}

      // Getpos
      if (data['getpos'])
      {
        $('#view .view-container #more .getpos').removeClass('notset');
        More.getposSet(data['getpos']);
      }
      else
      {
        $('#view .view-container #more .getpos').addClass('notset');
      }
      // <<TODO>>

			// Set Basic informations
			$('#view .view-container .from-name').html(data['from_name']);
			$('#view .view-container .to-name').html(data['to_name']);
			$('#view .view-container .description').html(data['description']);

			switch (data.view_type)
			{
				case '1':
					View.contentType1(data);
					break;

				case '2':
					View.contentType2(data);
					break;

				case '3':
					View.contentType3(data);
					break;

				default:
					View.contentType1(data);
					break;
			}
		}
	},

	setCrosshair: function(crosshair)
	{
		var crosshair = crosshair.split(',');
		if (crosshair[0] > 0)
			$('#view .view-container .img-container .crossUp').css('margin-top', (-1 * (6 + Math.round(crosshair[0]))) +'px').css('height', crosshair[0] +'px').addClass('crossLandmark');

		if (crosshair[1] > 0)
			$('#view .view-container .img-container .crossRight').css('width', Math.round(crosshair[1]) +'px').addClass('crossLandmark');

		if (crosshair[2] > 0)
			$('#view .view-container .img-container .crossDown').css('height', Math.round(crosshair[2]) +'px').addClass('crossLandmark');

		if (crosshair[3] > 0)
			$('#view .view-container .img-container .crossLeft').css('margin-left', (-1 * (6 + Math.round(crosshair[3]))) +'px').css('width', crosshair[3] +'px').addClass('crossLandmark');
	},

	resetCrosshair: function()
	{
		$('.crossUp').css('margin-top', '-15px');
		$('.crossUp').css('height', '10px');
		$('.crossRight').css('width', '10px');
		$('.crossDown').css('height', '10px');
		$('.crossLeft').css('margin-left', '-15px');
		$('.crossLeft').css('width', '10px');
	},

	toSlug: function(str)
	{
		var r = str;
			r = r.toLowerCase();
			r = r.replace(/\//g, 'and');
			r = r.replace(/ /g, '-');
		return r;
	},

	/**
	 * Content Types
	 */
	contentType1: function(data)
	{
		// Images
		var preview = $('<div class="img-prev bordered"></div>').css('background-image', 'url("'+ data.dir +'preview.jpg")');
		var posOne  = $('<div class="img-pos1 bordered"></div>').css('background-image', 'url("'+ data.dir +'position1.jpg")');
		var posTwo  = $('<div class="img-pos2 bordered"></div>').css('background-image', 'url("'+ data.dir +'position2.jpg")');
		var zoom    = $('<div class="img-zoom bordered"><span class="crossVertical"></span><span class="crossHorizontal"></span></div>').css('background-image', 'url("'+ data.dir +'zoom.jpg")');
		var view    = $('<div class="img-view bordered"><span class="crossUp"></span><span class="crossRight"></span><span class="crossDown"></span><span class="crossLeft"></span></div>').css('background-image', 'url("'+ data.dir +'view.jpg")');

		// Load Img Container
		$('#view svg.background use').hide();
		$('#view').addClass('type-01');
		$('#view .view-container .img-container').append(preview).append(posOne).append(posTwo).append(zoom).append(view);

		// Set Crosshair
		View.setCrosshair(data['crosshair']);

		// Show Location/Description
		$('#view .location').addClass('shown');
		$('#view .view-container .desc-container').addClass('shown');
		$('#view .view-container #more').addClass('shown');
		More.init( data['id'] );
	},

	contentType2: function(data) { console.log('Type 2 is undefined'); },

	/**
	 * Content Types
	 */
	contentType3: function(data)
	{
		// Images
		var view = $('<div class="img-view bordered"></div>').css('background-image', 'url("'+ data.dir +'view.jpg")');

		// Load Img Container
		$('#view svg.background use').hide();
		$('#view').addClass('type-03');
		$('#view .view-container .img-container').append(view);

		// Show Location/Description
		$('#view .location').addClass('shown');
		$('#view .view-container .desc-container').addClass('shown');
		$('#view .view-container #more').addClass('shown');
		More.init( data['id'] );
	},

};
