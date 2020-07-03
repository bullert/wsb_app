<?php if (session_status() != PHP_SESSION_ACTIVE) session_start(); ?>
<div class="row">

	<div class="col s12">

		<div class="card-panel">

			<div class="row">
				<div class="col s12 m8 push-m2 l6 push-l3 xl4 push-xl4" style="background: red;">
					<?php if (!isset($_SESSION['session_id'])) : ?>

						<a class="href waves-effect waves-light btn-small" href="/sign_in">Zaloguj</a>
						<a class="href waves-effect waves-light btn-small" href="/sign_up">Zarejestruj</a>

					<?php else : echo $_SESSION['session_id']; ?>



					<?php endif; ?>

					<?php echo session_status(); ?>
				</div>
			</div>

		</div>

	</div>

</div>
<script>

	// navigate

	// $('a.href').click(function(e){
	// 	e.preventDefault();
	// 	let name = $(this).attr('href');
	// 	changeView(name);
	// });

	// InitMaterialize();

	// $('#dropdown1').load('../../app/src/components/navbar_dropdown.php');

	// $("#sign_in, #sign_up").click(function(){
	// 	let name = $(this).prop('id');
	// 	changeView(name);
	// });

</script>
