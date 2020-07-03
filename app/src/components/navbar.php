<?php session_start(); ?>
<div class="nav-wrapper">
	<ul id="nav-mobile" class="left hide-on-med-and-down" style="width: 100%; display: flex !important;">
		<li>
			<a data-target="mobile-demo" class="sidenav-trigger" style="margin: 0;">
				<i class="material-icons">menu</i>
			</a>
		</li>
		<div class="hide-on-med-and-down">
			<li><a class="nav-link href" href="/home">Strona główna</a></li>
			<li><a class="nav-link href" href="/fuel_consumption_calculator">Kalkulator</a></li>
			<li><a class="nav-link href" href="/cars">Pojazdy</a></li>
		</div>
		<li class="searchbar-container">
			<!-- <form>
				<div class="input-field search-bar">
					<input id="search" type="search" />
					<label class="label-icon" for="search"><i class="material-icons search-icon">search</i></label>
					<i class="material-icons close-icon">close</i>
				</div>
			</form> -->
			<!-- <form> -->
				<div class="input-field searchbar">
					<input id="search" type="search" placeholder="Szukaj" />
					<i id="searchbar-close-trigger" class="material-icons">close</i>
					<i id="searchbar-open-trigger" class="material-icons">search</i>
				</div>
			<!-- </form> -->
			<!-- <div class="input-field">
				<input id="search" type="search" required />
				<label class="label-icon" for="search"><i class="material-icons">search</i></label>
				<i class="material-icons">close</i>
			</div> -->
		</li>
		<li class="hide-on-med-and-down">
			<a class="dropdown-trigger nav-dropdown" data-target="nav-dropdown">
				<i class="material-icons">more_vert</i>
			</a>
		</li>
	</ul>

	<!-- <a class="dropdown-trigger nav-dropdown right hide-on-med-and-down" data-target="nav-dropdown">
		<i class="material-icons right">more_vert</i>
	</a> -->

	<!-- <a data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a> -->

</div>

<ul class="sidenav" id="mobile-demo">
	<li><a class="href sidenav-close sidenav-icon"><i class="material-icons">menu</i></a></li>
	<li><a class="href sidenav-close" href="/home">Strona główna</a></li>
	<li><a class="href sidenav-close" href="/fuel_consumption_calculator">Kalkulator</a></li>
	<li><a class="href sidenav-close" href="/cars">Pojazdy</a></li>

	<ul>

		<li class="divider"></li>

		<?php if (isset($_SESSION['session_id'])) : ?>

			<li><a class="href sidenav-close sidenav-bottom" href="/logout">Wyloguj</a></li>

		<?php else : ?>

			<li><a class="href sidenav-close sidenav-bottom" href="/sign_in">Zaloguj</a></li>
			<li><a class="href sidenav-close sidenav-bottom" href="/sign_up">Zarejestruj</a></li>

		<?php endif; ?>

	</ul>

</ul>

<ul id="nav-dropdown" class="dropdown-content">

	<?php if (isset($_SESSION['session_id'])) : ?>

		<li><a class="href" href="/my_vehicles">Moje pojazdy</a></li>
		<li><a href="/logout">Wyloguj</a></li>

	<?php else : ?>

		<li><a class="href" href="/sign_in">Zaloguj</a></li>
		<li class="divider"></li>
		<li><a class="href" href="/sign_up">Zarejestruj</a></li>

	<?php endif; ?>

</ul>

<script type="text/javascript">

	InitMaterialize();

	navigate();

	// $('#searchbar-open-trigger').click(function(e){
	//
	// 	let searchbar = $(this).parent();
	//
	// 	if (!searchbar.hasClass('focused'))
	// 	{
	// 		searchbar.removeClass('closed').addClass('focused');
	// 	}
	// 	else
	// 	{
	// 		let value = $('#search').val(),
	// 			header = 'header=search&query=' + value;
	//
	// 		post(header);
	// 		console.log(header);
	// 	}
	// });
	// $('#searchbar-close-trigger').click(function(e){
	// 	$(this).parent().removeClass('focused').addClass('closed');
	// });
	//
	$('a[href="/logout"]').click(function(e){
		e.preventDefault();
		let response = post('header=logout');
		response.done(function(result, status, jqXHR){
			console.log(result, status, jqXHR);
			try {
				changeView('/sign_in');
				$('#nav-container').load('../../app/src/components/navbar.php');
			}
			catch (e)
			{
				console.error(e);
			}
		});
	});

	// $('.href').click(function(e){
	// 	e.preventDefault();
	// 	let name = $(this).attr('href');
	// 	changeView(/name);
	// });

	// function post(data)
	// {
	// 	var response = $.ajax({
	// 		type: 'POST',
	// 		url: 'app/src/controllers/DirectHUBController.php',
	// 		async: false,
	// 		data: data,
	// 		success: function(response, status, jqXHR)
	// 		{
	// 			console.log(response, status, jqXHR);
	// 			$('#nav-container').load('../../app/src/components/navbar.php');
	// 			// changeView('/sign_in');
	// 			// changeView('/home');
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


<!-- <div class="row nav-layer"></div> -->
<!-- alignment: 'right', constrainWidth: false -->
