$(document).ready(function()
{
	// Forms placeholders
	placeholders_init();

	// Check forms placeholders on POST
	$('form').submit(placeholders_check);

	// External links
	$('a[data-target="blank"]').click(function(e)
	{
		e.preventDefault();
		window.open($(this).attr('href'));
	});

	// Autoresize textareas
	$('textarea.autoresize').each(function()
	{
		var textarea = $(this);

		textarea.on('keyup change', function()
		{
			var lines = textarea.val().split('\n').length;
			textarea.attr('rows', lines);
			textarea.height(lines * Math.floor(textarea.css('line-height').replace('px', '')));
		});

		textarea.keyup();
	});
});


//==============================================================================


function placeholders_init()
{
	$('form input[data-placeholder], form textarea[data-placeholder]').each(function()
	{
		$(this).focus(function() { if ($(this).val() == $(this).attr('data-placeholder')) $(this).val(''); });
		$(this).blur(function() { if ( ! $(this).val()) $(this).val($(this).attr('data-placeholder')); });
		$(this).keyup(function()
		{
			if ( ! $(this).val() || $(this).val() == $(this).attr('data-placeholder')) $(this).addClass('default');
			else $(this).removeClass('default');
		});
		$(this).blur();
		$(this).keyup();
	});
}

function placeholders_check()
{
	$('form input[data-placeholder], form textarea[data-placeholder]').each(function()
	{
		if ($(this).attr('data-placeholder') == $(this).val()) { $(this).val(''); }
	});
}


//==============================================================================

/*
	var APP_api_url = '';

	call_api('api_method', {
		param1: 'val1',
		param2: 'val2'
	}, api_callback_function);
*/
function call_api(pMethod, pParams, pCallback)
{
	var args = {'method': pMethod, 'params': pParams};
	$.get(APP_api_url, args, pCallback);
}


function scrollTo(pTop, pSpeed)
{
	var speed = pSpeed ? pSpeed : 400;

	$('html').animate({ scrollTop: pTop }, speed);
}

function shake(pDiv)
{
    var interval = 60;
    var distance = 5;
    var times    = 4;
    $(pDiv).css('position','relative');

    for(var iter=0; iter < (times+1); iter++)
        $(pDiv).animate({left:((iter%2==0 ? distance : distance*-1))}, interval);

    $(pDiv).animate({left: 0}, interval);
}

function copyToClipboard(text)
{
  var textArea = document.createElement("textarea");

  textArea.style.position = 'fixed';
  textArea.style.top = 0;
  textArea.style.left = 0;
  textArea.style.width = '2em';
  textArea.style.height = '2em';
  textArea.style.padding = 0;
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.boxShadow = 'none';
  textArea.style.background = 'transparent';
  textArea.value = text;

  document.body.appendChild(textArea);

  textArea.select();

  try
  {
    var successful = document.execCommand('copy');
    document.body.removeChild(textArea);
    return (successful) ? true : false;
  }
  catch (err)
  {
    return false;
  }
}
