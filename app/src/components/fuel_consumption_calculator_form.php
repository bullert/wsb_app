<?php if (session_status() != PHP_SESSION_ACTIVE) session_start(); ?>

<form id="fuel_consumption_calculator_form" action="app/src/controllers/DirectHUBController.php" method="post">

	<div class="row" style="height: 150px;"></div>

	<div class="input-field">
		<input id="distance" name="distance" type="number" step=any min=0>
		<label for="distance">Przebyty dystans (km)</label>
		<span class="helper-text" data-error="" data-success="" />
	</div>

	<div class="input-field">
		<input id="fuel" name="fuel" type="number" step=any min=0>
		<label for="fuel">Zużyte paliwo (l)</label>
		<span class="helper-text" data-error="" data-success="" />
	</div>

	<?php if (isset($_SESSION['session_id'])) : ?>

		<div class="input-field">
			<select id="save_for" name="save_for">
				<option value="" disabled selected>Zapisz dla</option>
				<?php
					foreach ($_SESSION['vehicles'] as $vehicle)
					{
						echo "<option value=\"{$vehicle['vehicle_unit_id']}\">{$vehicle['make']} {$vehicle['model']}</option>";
					}
				 ?>
			</select>
			<label>Pojazdy</label>
			<span class="helper-text red-text"></span>
		</div>

	<?php endif; ?>

	<div id="calculator_info" class="input-field" style="margin-top: 0; margin-bottom: 0; display: none;">
		<p style="height: 24px;">Spalanie wynosi: <b id="consumption"></b> l/100km.</p>
		<?php if (!isset($_SESSION['session_id'])) : ?>

			<p><a class="href" href="/sign_up">Utwórz konto</a> aby zapisywać i porównywać dane.</p>

		<?php endif; ?>
	</div>

	<!-- <input name="header" type="text" value="fuel_consumption_calculation" /> -->

	<div class="col s6" style="padding: 0;">
		<button id="calculator_save" class="btn-form btn-form-left waves-effect waves-light btn" <?php if (!isset($_SESSION['session_id'])) echo 'disabled'; ?>>Zapisz</button>
	</div>
	<div class="col s6" style="padding: 0;">
		<button class="btn-form btn-form-right waves-effect waves-light btn">Oblicz</button>
	</div>

</form>

<script type="text/javascript">

	navigate();

	$('#save_for').formSelect();

	$('#fuel_consumption_calculator_form').submit(function(event) {
		event.preventDefault();

		var distance = parseFloat($('#distance').val()),
			fuel = parseFloat($('#fuel').val());

		if (isNaN(distance) || isNaN(fuel)) return;

		let result = (fuel / distance) * 100;

		$('#consumption').text(result.toFixed(2));
		$('#calculator_info').show();

		console.log(fuel, distance);
    });

	$('#calculator_save').click(function(event) {

		var form = $('#fuel_consumption_calculator_form'),
			result = parseFloat($('#consumption').text());

		for (let name of ['distance', 'fuel'])
		{
			var input = form.find('input[name='+name+']'),
				span = input.siblings("span");

			input.attr("class", isNaN(result) ? "validate invalid" : null);
			span.attr("data-error", isNaN(result) ? 'Nie dokonano jeszcze obliczeń.' : null);
		}

		if (isNaN(result)) return;

		var select = $('#save_for'),
			span = select.parent().siblings('span'),
			len = select.children('option').length,
			value = select.val();

		span.html(len < 2 ? 'Nie posiadasz żadnych pojazdów, musisz je najpierw <a class="href" href="/my_vehicles/new">dodać</a>' : null);
		if (len < 2) return;

		span.html(!value ? 'To pole nie może być puste.' : null);
		if (!value) return;

		var id = parseInt(value);
		
		console.log(result, select.val());
    });

	// $('#fuel_consumption_calculator_form').submit(function(event) {
	// 	event.preventDefault();
	//
	// 	var distance = parseFloat($('#distance').val()),
	// 		fuel = parseFloat($('#fuel').val());
	//
	// 	if (isNaN(distance) || isNaN(fuel)) return;
	//
	// 	let result = (fuel / distance) * 100,
	// 		text = 'Spalanie wynosi: <b>' + result.toFixed(2) + '</b> l/100km.';
	//
	// 	$('#consumption').html(text);
	// 	$('#calculator_info').show();
	//
	// 	console.log(fuel, distance);
	//
	// 	var form = $(this),
	// 		data = 'header=fuel_consumption_calculation&' + $(this).serialize(),
	// 		response = post2(data);
	//
	// 	response.done(function(result, status, jqXHR){
	// 		console.log(data);
	// 		console.log(result, status, jqXHR);
	// 		try {
	// 			// if (result && result[name])
	// 			// {
	// 			// 	for (var name in result)
	// 			// 	{
	// 			// 		var input = form.find('input[name=' + name + ']'),
	// 			// 			span = input.siblings("span");
	// 			//
	// 			// 		if (result[name])
	// 			// 		{
	// 			// 			input.attr("class", "validate invalid");
	// 			// 			span.attr("data-error", result[name]);
	// 			// 		}
	// 			// 		else
	// 			// 		{
	// 			// 			input.attr("class", "");
	// 			// 		}
	// 			// 	}
	// 			// }
	// 			// else
	// 			// {
	// 			// 	changeView('/sign_in');
	// 			// }
	// 		}
	// 		catch (e)
	// 		{
	// 			console.log(e);
	// 		}
	// 	});
    // });

</script>
