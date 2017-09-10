$(document).ready(function()
{
	window.addEventListener('keydown', Mapping.keyDown, false);
	window.addEventListener('keyup',   Mapping.keyUp, false);
});

var Mapping = {

	map: [  ],


	stateAlt  : false,
	stateCtrl : false,
	stateShift: false,

	keyDown: function(e)
	{
		// States
		this.stateAlt   = e.altKey;
		this.stateCtrl  = e.ctrlKey;
		this.stateShift = e.shiftKey;

		// Check mapping
		for (var i in map = Mapping.map)
		{
			var pair = map[i];
			if (pair['keyCode'] == e.keyCode && pair['down'])
			{
				if (pair['prevent'])
					e.preventDefault();
				
				var fn   = pair['down'].replace(/(.*)\((.*)\)/, '$1');
				var args = pair['down'].replace(/(.*)\((.*)\)/, '$2');

				Mapping.execute(window, fn, args);
			}
		}
	},

	keyUp: function(e)
	{
		// States
		this.stateAlt   = e.altKey;
		this.stateCtrl  = e.ctrlKey;
		this.stateShift = e.shiftKey;

		// Check mapping
		for (var i in map = Mapping.map)
		{
			var pair = map[i];
			if (pair['keyCode'] == e.keyCode && pair['up'])
			{
				var fn   = pair['up'].replace(/(.*)\((.*)\)/, '$1');
				var args = pair['up'].replace(/(.*)\((.*)\)/, '$2');

				Mapping.execute(window, fn, args);
			}
		}
	},
	
	setMap: function(pArr)
	{
		this.map = pArr;
	},
	
	clearMap: function()
	{
		this.map = [  ];
	},
	
	execute: function(ctx, fn, args)
	{
		var args = [].slice.call(arguments).splice(2);
		var namespaces = fn.split(".");
		var func = namespaces.pop();

		for (var i = 0; i < namespaces.length; i++)
		{
			ctx = ctx[namespaces[i]];
		}

		return ctx[func].apply(this, args);
	},
};