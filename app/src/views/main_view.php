<nav id='nav-container' class="nav primary-color-mid">
	<?php components('navbar.php'); ?>
</nav>

<main class="secondary-color-light">

	<div id="viewer" class="container"></div>

	<?php components('footer.php'); ?>

</main>

<script>

	// post('header=auto_authentication');
	//
	// function post(data)
	// {
	// 	var response = $.ajax({
	// 		type: 'POST',
	// 		url: 'app/src/controllers/DirectHUBController.php',
	// 		async: false,
	// 		data: data,
	// 		dataType: 'json',
	// 		success: function(response, status, jqXHR)
	// 		{
	// 			console.log(response, status, jqXHR);
	// 			$('#nav-container').load('../../app/src/components/navbar.php');
	// 			// changeView('home');
	// 		},
	// 		error: function(jqXHR, status, error)
	// 		{
	// 			console.error(error);
	// 		}
	// 	});
	//
	// 	return response;
	// }

	// $(document).ready(function() {
	// 	// alert();
	// 	var url = '../../../app/src/controllers/SessionController.php',
	// 		response = post(url);
	//
	// 	console.log(response);
	//
	// 	// if (!response || !response.responseJSON || !response.responseJSON.data) return false;
	// 	//
	// 	// let data = response.responseJSON.data;
	// });
	//
	// function post(url)
	// {
	// 	var response = $.ajax({
	// 		type: "POST",
	// 		url: url,
	// 		async: false,
	// 		dataType: 'json',
	// 		success: function(response, status, jqXHR)
	// 		{
	// 			console.log(response, status, jqXHR, "a");
	// 		},
	// 		error: function(jqXHR, status, error)
	// 		{
	// 			console.error(error);
	// 		}
	// 	});
	//
	// 	return response;
	// }

</script>
