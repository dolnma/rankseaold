$(document).ready(function()
{

});

/**
*/
var More = {
	init: function(pId)
	{
		$('#more *').unbind('click');
		$('#report *').unbind('click');

		$('#more.logged li.favorite').click(function() { More.favorite(); });
		var fav = $('#svgView g[data-id="'+ pId +'"]').attr('data-fav');
		$('#more.logged li.favorite').attr('data-id', pId);
		this.favoriteToggle(pId, fav);

		$('#more.logged li.report').click(function() { More.reportToggle(pId); });

		$('#report .form .btOk').click(function() { More.reportSend(); });
		$('#report .form .btKo').click(function() { More.reportClose(); });
		$('#report .close').click(function() { More.reportClose(); });
		$('#report .form #reason').change(function() { More.reportBt(); });

		$('#more.logged li.share').click(function() { More.share(); });
		$('#more li.getpos').click(function() { More.getpos(); });
	},

	/**
	 * FAVORITE
	 */
	favorite: function()
	{
		var pId = $('#more.logged li.favorite').attr('data-id');
		call_api('api_toggle_favorite', { 'id': pId }, More.favoriteAnswer);
	},

	favoriteAnswer: function(pData)
	{
		var pId = $('#more.logged li.favorite').attr('data-id');
		if (pData == 'OK Added')
		{
			More.favoriteToggle(pId, true);
		}
		else if (pData == 'OK Removed')
		{
			More.favoriteToggle(pId, false);
		}
	},

	favoriteToggle: function(pId, isFav)
	{
		if (isFav)
		{
			$('#more li.favorite svg').html('<use xlink:href="#more-favorite-full" />');
			$('#svgView g[data-id="'+ pId +'"]').attr('data-fav', '1');
		}
		else
		{
			$('#more li.favorite svg').html('<use xlink:href="#more-favorite" />');
			$('#svgView g[data-id="'+ pId +'"]').attr('data-fav', '');
		}
	},

	/**
	 * REPORT
	 */
	reportToggle: function(pId)
	{
		if ($('#report').is(':visible'))
			this.reportClose();
		else
			this.reportOpen(pId);
	},

	reportOpen: function(pId)
	{
		Mapping.setMap([  ]);
        var left = ($(window).width() / 2)  - ($('#report').innerWidth() / 2);
        var top  = ($(window).height() / 2) - ($('#report').innerHeight() / 2);
        $('#report').css('left', left +'px').css('top', top +'px');

		$('#report .form .btOk').attr('disabled', 'disabled');
		$('#report .form #reason').val('null');
		$('#report .form #comment').val('');
		$('#report').fadeIn(100);
		$('#report .form #stuff_id').val(pId);
	},

	reportClose: function()
	{
		$('#report').fadeOut(100);
		$('#report .form #stuff_id').val('');
		Mapping.setMap( View.map );
	},

	reportBt: function()
	{
		$('#report .form .btOk').attr('disabled', 'disabled');

		if ($('#report .form #reason').val() != 'null')
			$('#report .form .btOk').prop('disabled', false);
	},

	reportSend: function()
	{
		var send = true;

		var stuffID = $('#report .form #stuff_id').val();
		var reason  = $('#report .form #reason').val();
		var comment = $('#report .form #comment').val();

		if (stuffID == null) send = false;
		if (reason == 'null') send = false;

		if (send)
		{
			$('#report .form .btOk').attr('disabled', 'disabled');
			call_api('api_report', { 'stuff_id': stuffID, 'reason': reason, 'comment': comment }, More.reportAnswer);
		}
	},

	reportAnswer: function(pData)
	{
		if (pData == 'OK')
			More.reportClose();
	},


  shareSet: function(pUrl)
	{
		$('#more #input-share').val(pUrl);
	},

  share: function()
  {
    var value = $('#more #input-share').val();

    var copy = copyToClipboard( value );

    if (copy)
      $('#more .share').animate({opacity: .1}, 10, function() { $(this).animate({opacity: 1}, 250); });
    else
      shake( $('#more .share') );

    ga('send', 'event', 'StuffMore', 'Share');
  },

  getposSet: function(pGetpos)
  {
    $('#more #input-getpos').val(pGetpos);
  },

  getpos: function ()
  {
    var value = $('#more #input-getpos').val();
    var zAxis = parseFloat(value.split(' ')[3]);

    var copy = copyToClipboard( value.replace(zAxis, (zAxis - 64)) );

    if (copy)
      $('#more .getpos').animate({opacity: .1}, 10, function() { $(this).animate({opacity: 1}, 250); });
    else
      shake( $('#more .getpos') );

    ga('send', 'event', 'StuffMore', 'Getpos');
  },
};
