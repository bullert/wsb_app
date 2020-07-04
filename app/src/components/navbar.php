<?php if (session_status() != PHP_SESSION_ACTIVE) session_start(); ?>
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

			<?php if (isset($_SESSION['session_id'])) : ?>
				<li><a class="nav-link href" href="/diagrams">Wykresy</a></li>
			<?php endif; ?>

		</div>
		<li class="searchbar-container">
			<div class="input-field searchbar">
				<input id="search" type="search" placeholder="Szukaj" />
				<i id="searchbar-close-trigger" class="material-icons">close</i>
				<i id="searchbar-open-trigger" class="material-icons">search</i>
			</div>
		</li>
		<li class="hide-on-med-and-down">
			<a class="dropdown-trigger nav-dropdown" data-target="nav-dropdown">
				<i class="material-icons">more_vert</i>
			</a>
		</li>
	</ul>
</div>

<ul class="sidenav" id="mobile-demo">
	<li><a class="href sidenav-close sidenav-icon"><i class="material-icons">menu</i></a></li>
	<li><a class="href sidenav-close" href="/home">Strona główna</a></li>
	<li><a class="href sidenav-close" href="/fuel_consumption_calculator">Kalkulator</a></li>

	<?php if (isset($_SESSION['session_id'])) : ?>
		<li><a class="href sidenav-close" href="/diagrams">Wykresy</a></li>
		<li><a class="href sidenav-close" href="/my_vehicles">Moje pojazdy</a></li>
	<?php endif; ?>

	<ul>

		<li class="divider"></li>

		<?php if (isset($_SESSION['session_id'])) : ?>

			<li><a class="sidenav-close sidenav-bottom" href="/logout">Wyloguj</a></li>

		<?php else : ?>

			<li><a class="href sidenav-close sidenav-bottom" href="/sign_in">Zaloguj</a></li>
			<li><a class="href sidenav-close sidenav-bottom" href="/sign_up">Zarejestruj</a></li>

		<?php endif; ?>

	</ul>

</ul>

<ul id="nav-dropdown" class="dropdown-content">

	<?php if (isset($_SESSION['session_id'])) : ?>

		<li><a class="href" href="/my_vehicles">Moje pojazdy</a></li>
		<li class="divider"></li>
		<li><a href="/logout">Wyloguj</a></li>

	<?php else : ?>

		<li><a class="href" href="/sign_in">Zaloguj</a></li>
		<li><a class="href" href="/sign_up">Zarejestruj</a></li>

	<?php endif; ?>

</ul>

<script type="text/javascript">

	InitMaterialize();

	navigate();

	$('#searchbar-open-trigger').click(function(e){

		let searchbar = $(this).parent();

		if (!searchbar.hasClass('focused'))
		{
			searchbar.removeClass('closed').addClass('focused');
		}
		else
		{
			let value = $('#search').val(),
				header = 'header=search&query=' + value;

			// post(header);
			// console.log(header);
		}
	});

	$('#searchbar-close-trigger').click(function(e){
		$(this).parent().removeClass('focused').addClass('closed');
	});

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

</script>
