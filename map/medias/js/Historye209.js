$(document).ready(function()
{
	window.onpopstate = function(event) {
		if (event.state != null)
		{
			if (event.state.stuffOpen == true)
			{
				View.open(event.state.type, event.state.id);

				History.sendNewLoc();
			}
			else
			{
				View.close();

				History.sendNewLoc();
			}
		}
	};
});

History = {
	open: function(data, url)
	{
		window.history.pushState({ stuffOpen:true, type:data['type'], id:data['id'] }, '', url);

		History.sendNewLoc();
	},

	close: function()
	{
		if (window.history.length > 2)
		{
			window.history.back();
		}
		else
		{
			var pattern = new RegExp('(.*)\/[a-zA-Z-]+\/([0-9]+)\/', 'i');
			var docURL = document.URL;
			var mapURL = docURL.split(pattern);
			window.history.pushState({stuffOpen:false}, '', mapURL[1] +'/');
			View.close();

			History.sendNewLoc();
		}
	},

	sendNewLoc: function()
	{
		var loc = window.location,
			hashbang = "#!",
			bangIndex = location.href.indexOf(hashbang),
			page = bangIndex != -1 ? loc.href.substring(bangIndex).replace(hashbang, "/") : loc.pathname + loc.search;

		ga('send', 'pageview', page);
	}
};