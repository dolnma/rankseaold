$(document).ready(function()
{
	Selector.init();

	$.extend($.fn.disableTextSelect = function() {
		return this.each(function() {
			if ($.browser.mozilla)
			{
				$(this).css('MozUserSelect', 'none');
			}
			else if ($.browser.msie)
			{
				$(this).bind('selectstart', function() { return false; });
			}
			else
			{
				$(this).mousedown(function() { return false; });
			}
		});
	});

	$('#svgView polygon').bind('contextmenu', function() { return false; });

	$('#application').disableTextSelect();
});

var Selector = {
	map: [
		{key:'1',     keyCode:49, down:'Selector.toggleTypeByID(0)', prevent:true }, // Stuff 0
		{key:'2',     keyCode:50, down:'Selector.toggleTypeByID(1)', prevent:true }, // Stuff 1
		{key:'3',     keyCode:51, down:'Selector.toggleTypeByID(2)', prevent:true }, // Stuff 2
		{key:'4',     keyCode:52, down:'Selector.toggleTypeByID(3)', prevent:true }, // Stuff 3
		{key:'5',     keyCode:53, down:'Selector.toggleTypeByID(4)', prevent:true }, // Stuff 4
		{key:'6',     keyCode:54, down:'Selector.toggleTypeByID(5)', prevent:true }, // Stuff 5
		{key:'7',     keyCode:55, down:'Selector.toggleTypeByID(6)', prevent:true }, // Stuff 6
		{key:'8',     keyCode:56, down:'Selector.toggleTypeByID(7)', prevent:true }, // Stuff 7
		{key:'9',     keyCode:57, down:'Selector.toggleTypeByID(8)', prevent:true }, // Stuff 8

		{key:'C',     keyCode:67, down:'Selector.toggleCallouts()',  prevent:true }, // Callouts
		{key:'F',     keyCode:70, down:'Selector.toggleFav()',       prevent:true }, // Favorite
		{key:'H',     keyCode:72, down:"Selector.toggleHelp()",      prevent:true }, // Help
		{key:'O',     keyCode:79, down:'Selector.toggleOverview()',  prevent:true }, // Overview
		{key:'S',     keyCode:83, down:'Selector.toggleSide()',      prevent:true }, // Side
		{key:'T',     keyCode:84, down:'Selector.toggleTick()',      prevent:true }, // Ticks

		{key:'Space', keyCode:32, down:'Selector.calloutsFocusON()', up:'Selector.calloutsFocusOFF()', prevent:true }, // Toggle Callouts

		{key:'Shift', keyCode:16, down:'Selector.addShift()', up:'Selector.removeShift()', prevent:true }, // Toggle shift press
		{key:'Ctrl',  keyCode:17, down:'Selector.addCtrl()',  up:'Selector.removeCtrl()',  prevent:true }, // Toggle ctrl press
	],

	_filters:
	{
		fav      : false,
		type     : 'Smoke',
		callouts : true,
		side     : 3,
		tick     : 2,
	},

	init: function()
	{
		if ($('#application').is(':visible'))
		{
      /**
       * Custom Settings
       */
      if (typeof SelectorCustomFilters !== 'undefined')
      {
        Selector._filters.fav      = SelectorCustomFilters.p_favorite;
        Selector._filters.type     = SelectorCustomFilters.p_stuff;
        Selector._filters.callouts = SelectorCustomFilters.p_callouts;
        Selector._filters.side     = SelectorCustomFilters.p_side;
        Selector._filters.tick     = SelectorCustomFilters.p_ticks;
      }

			/**
			 * Selector
			 **/
			// Favorites
			$('#selector .filters .fav li').click(function() { Selector.toggleFav(); });

			// Types
			$('#selector .types li').click(function() { Selector.toggleType( $(this).attr('data-type') ); });

			// More Opts (Side / Tick)
			$('#selector .moreOpts .callouts').click(function() { Selector.toggleCallouts(); });
			$('#selector .moreOpts .side').click(    function() { Selector.toggleSide(); });
			$('#selector .moreOpts .ticks').click(   function() { Selector.toggleTick(); });

			Selector.center();

      /**
			 * CircleHover
			 **/
      $('body').on('mouseenter', '.hoverCircle', function() { Selector.moreStuffEnable( $(this).attr('data-more-list') ); });
      $('body').on('mouseleave', '.hoverCircle', function() { Selector.moreStuffDisable(); });

      $('body').on('mouseenter', '.tooltip', function() { Selector.moreStuffEnable( $(this).attr('data-more-list') ); });
      $('body').on('mouseleave', '.tooltip', function() { Selector.moreStuffDisable(); });

			/**
			 * Tooltip
			 **/
			$('body').on('mouseenter', '.tooltip p', function() { $('#svgView g[data-id="'+ $(this).attr('data-id') +'"]').attr('data-hovered', 'true'); });
			$('body').on('mouseleave', '.tooltip p', function() { $('#svgView g[data-id="'+ $(this).attr('data-id') +'"]').attr('data-hovered', 'false'); });

			$('body').on('click', '.tooltip p', function(e) {
				var map  = $('#svgView').attr('data-map');
				var type = $(this).attr('data-type');
				var id   = $(this).attr('data-id');

				$('#svgView g[data-id="'+ id +'"]').attr('data-hovered', 'false');

				View.open(type, id);
				ga('send', 'event', 'Stuff', type, map, id);
			});


			// Align
			window.onresize = function(e) { Selector.center(); };
			window.onscroll = function(e) { Selector.center(); };

			// Shortcuts
			Mapping.setMap( Selector.map );
			Selector.draw();
		}
	},

	/**
	 * Selector
	 */
	   addCtrl : function(e) { $('#application').addClass('keyCtrl'); },
	removeCtrl : function(e) { $('#application').removeClass('keyCtrl'); },

	   addShift : function(e) { $('#application').addClass('keyShift'); },
	removeShift : function(e) { $('#application').removeClass('keyShift'); },

	toggleFav: function()
	{
		Selector._filters.fav = (Selector._filters.fav) ? false : true;

		var msg = (Selector._filters.fav) ? '[F] Show all' : '[F]avorites only';
		$('#selector .filters .fav li').attr('alt', msg);
		$('#selector .filters .fav li').toggleClass('hidden');

		Selector.redraw();
	},

	toggleSide: function()
	{
		Selector._filters.side = (Selector._filters.side == 2) ? 3 : 2;
		var msg = (Selector._filters.side == 3) ? 'Terrorist' : 'Counter-Terrorist';
		$('#selector .filters .side').attr('alt', '[S]ide : '+ msg);
		$('#selector .filters .side').attr('data-side', Selector._filters.side);
		$('#selector .filters .side span').text('[S]ide : '+ msg);

		Selector.redraw();
	},

	toggleTick: function()
	{
    var msg;

		if (Selector._filters.tick == 2)
		{
			Selector._filters.tick = 3;
			msg = '128 Ticks';
		}
		else if (Selector._filters.tick == 3)
		{
			Selector._filters.tick = 0;
			msg = 'Disabled';
		}
		else
		{
			Selector._filters.tick = 2;
			msg = '64 Ticks';
		}

		$('#selector .filters .ticks').attr('data-tick', Selector._filters.tick);
		$('#selector .filters .ticks').attr('alt', '[T]ickrate : '+ msg);
		$('#selector .filters .ticks span').text('[T]ickrate : '+ msg);

		Selector.redraw();
	},

	toggleOverview: function()
	{
		$('#application img.spectate').toggle();
		$('#application img.radar').toggle();
	},

	toggleTypeByID: function(i)
	{
		var type = $('#selector .types li:eq('+ i +')').attr('data-type');

		if (type)
			Selector.toggleType(type);
	},

	toggleType: function(pType)
	{
		$('#selector .filters ul.types li').addClass('hidden');

		Selector._filters.type = pType;

		$('#selector .filters ul.types li[data-type='+ pType +']').toggleClass('hidden');

		Selector.redraw();
	},

	toggleHelp: function()
	{
		if ($('#shortcuts').is(':visible'))
			$('#shortcuts').fadeOut(50);
		else
			$('#shortcuts').fadeIn(50);
	},

	draw: function()
	{
		var filters = Selector._filters;

    // Show / Hide
		$('#svgView').children('g').each( function(i) { $(this).show(); });
		$('#svgView').children('g').each( function(i) {
			var el = $(this);

			// Type
			var type = el.attr('data-type');

			if (filters.type != type)
			{
				el.hide();
				return;
			}

			// Fav
			if (filters.fav)
			{
				if ( ! el.attr('data-fav'))
				{
					el.hide();
					return;
				}
			}

			// Ticks : Disabled
			var bind = el.attr('data-bind');
			if (bind == 1 && ticks === 0)
			{
				el.hide();
				return;
			}

			// Ticks
			var ticks = el.attr('data-ticks');
			if (ticks > 1 && ticks != filters.tick)
			{
				el.hide();
				return;
			}

			// Side
			var side = el.attr('data-side');

			if (side > 1)
			{
				// T
				if (filters.side == 3 && side != 3)
				{
					el.hide();
					return;
				}
				// CT
				else if (filters.side == 2 && side != 2)
				{
					el.hide();
					return;
				}
			}
		});

    // Data-tt-content
	  $('#svgView').children('g').each( function(i) {
      var el = $(this).find('.hoverCircle');
      el.attr('data-tt-content', '');

      var circleA = {
        x   : parseInt(el.attr('cx')),
        y   : parseInt(el.attr('cy')),
        r   : ((parseInt(el.attr('r')) / 4) * 3),
        id  : el.parent().attr('data-id'),
        type: el.parent().attr('data-type'),
        alt : el.attr('alt')
      };

      el.attr('data-tt-content', '<p data-type="'+ circleA.type +'" data-id="'+ circleA.id +'">'+ circleA.alt +'</p>');

      // More content
      var moreContent = '';
      var dataMoreList = '';
      $('#svgView .hoverCircle').each(function(j) {
        var that = $(this);

  			var circleB = {
          x : parseInt(that.attr('cx')),
          y : parseInt(that.attr('cy')),
          r : ((parseInt(that.attr('r')) / 4) * 3),
          id: that.parent().attr('data-id')
        };

        if ( (circleA.id != circleB.id) && (that.parent().css('display') !== 'none') ) {
  				if ( Selector.circleCollide(circleA, circleB) ) {
  					var type = that.parent().attr('data-type');
  					var id   = that.parent().attr('data-id');
  					var alt  = that.attr('alt');

            dataMoreList += id +';';
            moreContent += '<p data-type="'+ type +'" data-id="'+ id +'">'+ alt +'</p>';
  				}
  			}
      });

      if (moreContent !== '') {
        el.attr('data-tt-content', el.attr('data-tt-content') +'<div class="moreStuff">'+ moreContent +'</div>');
        el.attr('data-more-list', dataMoreList);
      }


    });
	},

	redraw: function() { Selector.draw(); },

	center: function()
	{
		if ($(window).width() > 480)
		{
			var top = 10;

			if ($('#selector').innerHeight() < $(window).height())
			   top = (window.pageYOffset + $(window).height() / 2) - ($('#selector').innerHeight() / 2);

			$('#selector').css('top', top);
		}
		else
		{
			$('#selector').css('top', 0);
		}
	},

	/**
	 * Callouts
	 */
	toggleCallouts: function() {
		Selector._filters.callouts = !Selector._filters.callouts;
		var msg = (Selector._filters.callouts) ? 'Hide' : 'Show';
		$('#selector .filters .callouts').attr('alt', '[C] '+ msg +' Callouts');
		$('#selector .filters .callouts').attr('data-callout', Selector._filters.callouts);

		$('#application').toggleClass('callouts-hidden');
	},

	calloutsFocusON: function()
	{
		$('#application #mapOverflow #svgView').hide();

		if ( ! Selector._filters.callouts )
			$('#application').removeClass('callouts-hidden');
	},

	calloutsFocusOFF: function()
	{
		$('#application #mapOverflow #svgView').show();

		if ( ! Selector._filters.callouts )
			$('#application').addClass('callouts-hidden');
	},

  /**
   * MoreStuff
   */
  moreStuffEnable : function( list ) {
    if (list) {
      list = list.split(';');

      for (var i = 0; i < list.length; i++)
        $('#svgView g[data-id="'+ list[i] +'"]').attr('data-more', (i+1));
    }
  },

  moreStuffDisable : function() {
    $('#svgView g').attr('data-more', '');
  },

	circleCollide: function(circleA, circleB)
	{
		var dist = (circleA.x - circleB.x) * (circleA.x - circleB.x) + (circleA.y - circleB.y) * (circleA.y - circleB.y);
		return (dist < (circleA.r + circleB.r) * (circleA.r + circleB.r));
	},
};
