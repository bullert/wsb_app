<?php if (session_status() == PHP_SESSION_ACTIVE) session_start(); ?>

<?php if (!isset($_SESSION['session_id'])) : ?>

	<form id="reg_form" action="app/src/controllers/DirectHUBController.php" method="post" style="">

		<div class="row" style="height: 150px;"></div>

		<div class="input-field">
			<input id="login" name="login" type="text" class="">
			<label for="login">Login</label>
			<span class="helper-text" data-error="" data-success="" />
		</div>

		<div class="input-field">
			<input id="email" name="email" type="text" class="">
			<label for="email">Email</label>
			<span class="helper-text" data-error="" data-success="" />
		</div>

		<div class="input-field">
			<input id="password" name="password" type="password" class="">
			<label for="password">Hasło</label>
			<span class="helper-text" data-error="" data-success="" />
		</div>

		<div class="input-field">
			<input id="password_confirm" name="password_confirm" type="password" class="">
			<label for="password_confirm">Powtórz hasło</label>
			<span class="helper-text" data-error="" data-success="" />
		</div>

		<!-- <input name="header" type="text" value="form_validation" /> -->

		<div class="col s6" style="padding: 0;">
			<a href="/sign_in" class="href teal lighten-4 btn-form btn-form-left waves-effect waves-dark btn">Zaloguj</a>
		</div>

		<div class="col s6" style="padding: 0;">
			<button class="btn-form btn-form-right waves-effect waves-light btn">Zarejestruj</button>
		</div>

	</form>

<?php else : ?>

	<script type="text/javascript"> changeView('/home'); </script>

<?php endif; ?>

<script type='text/javascript'>

	// InitMaterialize();
	navigate();

	$("#reg_form input").blur(function(event) {

		var form = $("#reg_form"),
			url = form.attr('action')
			input = $(this),
			name = input.prop("name"),
			span = input.siblings("span");
			data = 'header=single_field_validation&' + input.serialize();

		if (name == 'password_confirm')
			data += '&' + $('input[name=password]').serialize();

		var response = post(data);

		response.done(function(result, status, jqXHR){
			// console.log(data);
			// console.log(result, status, jqXHR);
			try {
				if (result && result[name])
				{
					input.attr("class", "validate invalid");
					span.attr("data-error", result[name]);
				}
				else
				{
					input.attr("class", "");
				}
			}
			catch (e)
			{
				console.log(e);
			}
		});
	});

    $("#reg_form").submit(function(event) {
		event.preventDefault();

		var form = $(this),
			url = form.attr('action')
			data = 'header=form_validation&' + $(this).serialize(),
			response = post(data);

		response.done(function(result, status, jqXHR){
			// console.log(data);
			// console.log(result, status, jqXHR);
			try {
				if (result && result[name])
				{
					for (var name in result)
					{
						var input = form.find('input[name=' + name + ']'),
							span = input.siblings("span");

						if (result[name])
						{
							input.attr("class", "validate invalid");
							span.attr("data-error", result[name]);
						}
						else
						{
							input.attr("class", "");
						}
					}
				}
				else
				{
					changeView('/sign_in');
				}
			}
			catch (e)
			{
				console.log(e);
			}
		});
    });

</script>
