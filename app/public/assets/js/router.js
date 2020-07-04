$(document).ready(function(){

	views = [
		'/home',
		'/sign_in',
		'/sign_up',
		'/users',
		'/cars',
		'/my_vehicles',
		'/my_vehicles/new',
		'/fuel_consumption_calculator',
		'/diagrams'
	];

	let view, path = window.location.pathname;

	if (view = getViewNameIfExist(path, views))
	{
		loadView(getViewUrlFromName(view));
	}

	$(window).on('popstate', function(){
		let view, path = window.location.pathname;

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
		if (view == url) return view;
	}
	return null;
}

function changeView(name)
{
	console.log(views);
	if (getViewNameIfExist(name, views))
	{
		let url = getViewUrlFromName(name);
		window.history.pushState(null, null, name);
		loadView(url);
	}
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

// function post2(data)
// {
// 	var path = window.location.pathname,
// 		subdirsLength = path.split('/').length - 1,
// 		url = 'app/src/controllers/DirectHUBController.php';
//
// 	for (let i = 0; i < subdirsLength - 1; i++)
// 	{
// 		url = '../' + url;
// 	}
//
// 	return $.ajax({
// 		type: 'POST',
// 		url: url,
// 		async: true,
// 		data: data,
// 		// dataType: 'json',
// 		success: function(response, status, jqXHR)
// 		{
// 			// console.log(data);
// 			// console.log(response, status, jqXHR);
// 		},
// 		error: function(jqXHR, status, error)
// 		{
// 			console.log(data);
// 			console.error(error);
// 		}
// 	});
// }
