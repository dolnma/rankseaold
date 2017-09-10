$(document).ready(function() {
  $('[data-tooltip]').mouseenter(function(e) {
		var that = $(this);
		Tooltip.timeout = setTimeout(function() { Tooltip.open(e, that); }, 25);
	});

  document.addEventListener('mousemove', Tooltip.mouseMove, false);
});

/**
 * @Tooltip
 *
 * data-tooltip        // true                                || false
 * data-tt-position    // left/right/top/bottom/e-auto/cursor || cursor
 * data-tt-hoverable   // true                                || false
 * data-tt-wait        // (int)m (Min. 1)                     || 250ms
 * data-tt-refresh     // true                                || false
 */

Tooltip = {
  that: null,

  mouseX: 0,
  mouseY: 0,

  timeout: 0,
  liveContentTemp: '',

  /*****************************************************************************
   * Open **********************************************************************
   *****************************************************************************/
  open: function(e, that) {
    // Force Close
    $('.tooltip').remove();

    $(Tooltip.that).unbind('mouseleave.isHoverableMouseleave');
		$(Tooltip.that).unbind('mouseenter.isHoverableMouseenter');


    // Open
    Tooltip.that = that;
    var content = $(that).attr('data-tt-content') || $(that).attr('alt');

    if ( content ) {
      var $tt = $('<div class="tooltip">'+ this.shortcutReplace(content) +'</div>');

      // Options
      var optRefresh   = $(that).attr('data-tt-refresh');
      var optHoverable = $(that).attr('data-tt-hoverable');
      var optWait      = parseInt($(that).attr('data-tt-wait')) || 250;

      // On mouse move : Close / Refresh
      if ( ! optRefresh )
        $(that).click(function(e) { Tooltip.close(e, that); });
      else
        $(that).click(function(e) { Tooltip.refresh(e, that); });

      // Append
      $tt.animate({opacity:0}, 0).appendTo('body');
			Tooltip.setPosition(e, that);

      // Tooltip is hoverable
      if ( optHoverable ) {
        Tooltip.isHoverable(e, that);
				$tt.click(function(e) { Tooltip.close(e, that); });
      }
      else {
				$(that).mouseleave(function(e) { Tooltip.close(e, $(this)); });
      }

      // Add content on the fly
			if ( Tooltip.liveContentTemp !== '' ) {
        $tt.html( this.shortcutReplace(Tooltip.liveContentTemp) );
        Tooltip.liveContentTemp = '';
			}

      // data
      if ( $(that).attr('data-more-list') )
        $tt.attr('data-more-list', $(that).attr('data-more-list') );

      // Show
      $tt.animate({opacity:0}, optWait, function() { $(this).addClass('shown').animate({opacity:1}, 250); });
    }
  },


  /*****************************************************************************
   * liveContent ***************************************************************
   *****************************************************************************/
  liveContent: function(content) {
    if ( Tooltip.that ) {
      $(Tooltip.that).html( this.shortcutReplace(content) );
    }
    else
      Tooltip.liveContentTemp += content;
  },


  /*****************************************************************************
   * shortcutReplace ***********************************************************
   *****************************************************************************/
  shortcutReplace: function(content) {
    return content.replace(/(\[\w\])/i, '<span class="shortcut">$1</span>');
  },


  /*****************************************************************************
   * refresh *******************************************************************
   *****************************************************************************/
  refresh: function(e, that) {
		var content = $(that).attr('alt');
		$('.tooltip').html( this.shortcutReplace(content) );
		Tooltip.setPosition(e, that);
	},


  /*****************************************************************************
   * isHoverable ***************************************************************
   *****************************************************************************/
  isHoverable: function(e, that) {
    if ( $(that).attr('data-tt-hoverable') ) {
  		$(that).bind('mouseleave.isHoverableMouseleave',       function(e) { Tooltip.isHvTimerSet(e, that); });
  		$('.tooltip').bind('mouseleave.isHoverableMouseleave', function(e) { Tooltip.isHvTimerSet(e, that); });

  		$(that).bind('mouseenter.isHoverableMouseenter',       function(e) { Tooltip.isHvTimerUnset(); });
  		$('.tooltip').bind('mouseenter.isHoverableMouseenter', function(e) { Tooltip.isHvTimerUnset(); });
    }
	},

	isHvTimer: 0,
	isHvTimerSet: function(e, that) { Tooltip.isHvTimer = setTimeout(function() { Tooltip.close(e, that); }, 0); },
	isHvTimerUnset: function() { clearTimeout(Tooltip.isHvTimer); },


  /*****************************************************************************
   * mouseMove *****************************************************************
   *****************************************************************************/
  mouseMove: function(e) {
		Tooltip.mouseX = e.clientX;
		Tooltip.mouseY = e.clientY;

    // Only for cursor mode
		if ( $('.tooltip.cursor').length )
		{
			var tt   = $('.tooltip.cursor')[0].getBoundingClientRect();
			var left = (Tooltip.mouseX + tt.width  + 40 > window.innerWidth)  ? Tooltip.mouseX - tt.width      : Tooltip.mouseX;
			var top  = (Tooltip.mouseY + tt.height + 40 > window.innerHeight) ? Tooltip.mouseY - tt.height - 5 : Tooltip.mouseY + 25;
			$('.tooltip.cursor').css('left', left).css('top', top);
			$('.tooltip.cursor.shown').remove();
		}
	},


  /*****************************************************************************
   * Close *********************************************************************
   *****************************************************************************/
  close: function(e, that) {
    $('.tooltip').remove();

    $(that).unbind('mouseleave.isHoverableMouseleave');
		$(that).unbind('mouseenter.isHoverableMouseenter');

    Tooltip.that = null;
  },


  /*****************************************************************************
   * setPosition ***************************************************************
   *****************************************************************************/
  setPosition: function(e, that) {
    var box    = $(that)[0].getBoundingClientRect();
    var tt     = $('.tooltip')[0].getBoundingClientRect();
    var left   = 0;
    var top    = 0;

    var opt = $(that).attr('data-tt-position');

    switch (opt) {
      case 'cursor':
        left = (Tooltip.mouseX + tt.width  + 40 > window.innerWidth)  ? Tooltip.mouseX - tt.width      : Tooltip.mouseX;
        top  = (Tooltip.mouseY + tt.height + 40 > window.innerHeight) ? Tooltip.mouseY - tt.height - 5 : Tooltip.mouseY + 25;
        break;

      case 'e-auto':
        if ( ( box.left + box.width + tt.width + 40 ) > window.innerWidth) {
          left = ( box.left - tt.width );
          top  = ( box.top + (box.height / 2) - (tt.height / 2) );
          opt = 'left';
        }
        else {
          left = ( box.left + box.width );
          top  = ( box.top + (box.height / 2) - (tt.height / 2) );
          opt = 'right';
        }
        break;

      case 'top':
        left = ( box.left + (box.width / 2) - (tt.width / 2) );
        top  = ( box.top - tt.height );
        break;

      case 'bottom':
        left = ( box.left + (box.width / 2) - (tt.width / 2) );
        top  = ( box.top + box.height );
        break;

      case 'left':
        left = ( box.left - tt.width );
        top  = ( box.top + (box.height / 2) - (tt.height / 2) );
        break;

      case 'right':
        left = ( box.left + box.width );
        top  = ( box.top + (box.height / 2) - (tt.height / 2) );
        opt = 'right';
        break;

      default:
        left = (Tooltip.mouseX + tt.width  + 40 > window.innerWidth)  ? Tooltip.mouseX - tt.width      : Tooltip.mouseX;
        top  = (Tooltip.mouseY + tt.height + 40 > window.innerHeight) ? Tooltip.mouseY - tt.height - 5 : Tooltip.mouseY + 25;
        opt  = 'cursor';
        break;
    }

    left = Math.floor(left);
    top  = Math.floor(top);

    $('.tooltip').css('left', left).css('top', top).addClass(opt);
  }
};
