$(document).ready(function(){

	// console.log(window.location.href);

	views = [
		'/home',
		'/sign_in',
		'/sign_up',
		'/users',
		'/cars',
		'/my_vehicles',
		'/my_vehicles/new',
		'/fuel_consumption_calculator'
	];

	let view, path = window.location.pathname;

	if (view = getViewNameIfExist(path, views))
	{
		console.log(view, path, getViewUrlFromName(view));
		loadView(getViewUrlFromName(view));
	}

	$(window).on('popstate', function(){
		let view, path = window.location.pathname;
		console.log(path);
		// alert();
		// console.log(getLocationFromUrl(path));
		if (view = getViewNameIfExist(path, views))
		{
			console.log(view)
			loadView(getViewUrlFromName(view));
		}
	});

	navigate();
});

function navigate()
{
	$('a.href').unbind().click(function(e){
		e.preventDefault();
		let name = $(this).attr('href');
		changeView(name);
	});
}

function getViewNameIfExist(url, views)
{
	for (let view of views)
	{
		// console.log(view, url, 69);
		if (view == getLocationFromUrl(url))
			return view;
	}
	return null;
}

function changeView(name)
{
	console.log(views);
	if (getViewNameIfExist(name, views))
	{
		let url = getViewUrlFromName(name);
		// console.log(name, url);
		window.history.pushState(null, null, name);
		loadView(url);
	}
}

function getLocationFromUrl(url)
{
	// console.log(url + 54);
	// var split = url.split('/');
	// return split[split.length - 1];
	return url;
}

function getViewUrlFromName(name)
{
	return '../app/src/views' + name + '_view.php';
}

function loadView(url)
{
	$('#viewer').load(url);
	$(window).scrollTop(0);
}

function post(data)
{
	var path = window.location.pathname,
		subdirsLength = path.split('/').length - 1,
		url = 'app/src/controllers/DirectHUBController.php';

	for (let i = 0; i < subdirsLength - 1; i++)
	{
		url = '../' + url;
	}

	return $.ajax({
		type: 'POST',
		url: url,
		async: true,
		data: data,
		dataType: 'json',
		success: function(response, status, jqXHR)
		{
			// console.log(data);
			// console.log(response, status, jqXHR);
		},
		error: function(jqXHR, status, error)
		{
			console.log(data);
			console.error(error);
		}
	});
}

function post2(data)
{
	var path = window.location.pathname,
		subdirsLength = path.split('/').length - 1,
		url = 'app/src/controllers/DirectHUBController.php';

	for (let i = 0; i < subdirsLength - 1; i++)
	{
		url = '../' + url;
	}

	return $.ajax({
		type: 'POST',
		url: url,
		async: true,
		data: data,
		// dataType: 'json',
		success: function(response, status, jqXHR)
		{
			// console.log(data);
			// console.log(response, status, jqXHR);
		},
		error: function(jqXHR, status, error)
		{
			console.log(data);
			console.error(error);
		}
	});
}
