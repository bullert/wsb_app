<?php if (session_status() == PHP_SESSION_ACTIVE) session_start(); ?>

<?php if (!isset($_SESSION['session_id'])) : ?>

	<form id="sign_in_form" action="app/src/controllers/DirectHUBController.php" method="post" style="">

		<div class="row" style="height: 150px;"></div>

		<div class="input-field">
			<input id="login" name="login" type="text" class="">
			<label for="login">Login</label>
			<span class="helper-text" data-error="" data-success="" />
		</div>

		<div class="input-field">
			<input id="password" name="password" type="password" class="">
			<label for="password">Hasło</label>
			<span class="helper-text" data-error="" data-success="" />
		</div>

		<!-- <input name="header" type="text" value="form_validation" /> -->

		<div class="input-field">
			<p>
				<label>
					<input id="stay_logged_in" name="stay_logged_in" type="checkbox" class="filled-in" checked="checked" />
					<span>Nie wylogowywuj mnie.</span>
				</label>
			</p>
		</div>

		<div class="col s6" style="padding: 0;">
			<a href="/sign_up" class="href teal lighten-4 btn-form btn-form-left waves-effect waves-dark btn">Zarejestruj</a>
		</div>

		<div class="col s6" style="padding: 0;">
			<button class="btn-form btn-form-right waves-effect waves-light btn">Zaloguj</button>
		</div>

	</form>

<?php else : ?>

	<script type="text/javascript"> changeView('/home'); </script>

<?php endif; ?>

<script type="text/javascript">

	// InitMaterialize();

	navigate();

	$("#sign_in_form").submit(function(event){
		event.preventDefault();

		var form = $(this),
			data = 'header=authentication&' + form.serialize(),
			response = post(data);

		response.done(function(result, status, jqXHR){
			console.log(data);
			console.log(result, status, jqXHR, response);
			try {
				// let errors = response.responseJSON;
				// console.log(errors);

				var login = form.find('input[name=login]'),
					password = form.find('input[name=password]'),
					span = password.siblings("span");

				if (result && result['password'])
				{
					login.attr("class", "validate invalid");
					password.attr("class", "validate invalid");
					span.attr("data-error", result['password']);
				}
				else
				{
					login.attr("class", "");
					password.attr("class", "");
					changeView('/home');
					$('#nav-container').load('../../app/src/components/navbar.php');
				}
			}
			catch (e)
			{
				console.log(e);
			}
		});
	});

</script>
