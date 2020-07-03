<?php if (!isset($_SESSION['session_id'])) : ?>

	<form id="add_vehicle_form" action="app/src/controllers/DirectHUBController.php" method="post">

		<div class="row" style="height: 150px;"></div>

		<div class="input-field">
			<select id="makes_list" name="makes_list">
				<option value="" disabled selected>Wybierz markę</option>
			</select>
			<label>Marka</label>
			<span class="helper-text red-text"></span>
		</div>

		<div class="input-field">
			<select id="models_list" name="models_list">
				<option value="" disabled selected>Wybierz model</option>
			</select>
			<label>Model</label>
			<span class="helper-text red-text"></span>
		</div>

		<!-- <input name="header" type="text" value="add_vehicle" /> -->

		<div class="col s12" style="padding: 0;">
			<button id="add_vehicle" class="btn-form btn-form-right waves-effect waves-light btn">Dodaj</button>
		</div>

	</form>

<?php else : ?>

	<script type="text/javascript"> changeView('/home'); </script>

<?php endif; ?>

<script>

	// InitMaterialize();
	navigate();

	// init models

	$('#models_list').formSelect();

	// init makes

	var data = 'header=get_all_vehicles_makes',
		response = post(data);

	response.done(function(result, status, jqXHR){
		// console.log(data);
		// console.log(result, status, jqXHR);
		try {
			if (result)
			{
				$.each(result, function (i, make) {
					$('#makes_list').append($('<option>', {
						value: make,
						text : make
					}));
				});

				$('#makes_list').formSelect();
			}
		}
		catch (e)
		{
			console.log(e);
		}
	});

	// makes on change

	$('#makes_list').change(function(){

		var makesList = $(this);

		makesList.parent().siblings('span').text(makesList.val() ? null : 'To pole nie może być puste.');

		var data = 'header=get_all_models_of_make&' + $(this).serialize(),
			response = post(data);

		response.done(function(result, status, jqXHR){
			// console.log(data);
			// console.log(result, status, jqXHR);
			try {
				if (result)
				{
					$('#models_list').children('option.tmp').remove();
					$('#models_list').children('option').eq(0).prop('selected', 'selected');
					$.each(result, function (i, item) {
						$('#models_list').append($('<option>', {
							value: item,
							text : item,
							class: 'tmp'
						}));
					});

					$('#models_list').formSelect();
				}
			}
			catch (e)
			{
				console.log(e);
			}
		});
	});

	$('#models_list').change(function(){

		var modelsList = $(this);
		modelsList.parent().siblings('span').text(modelsList.val() ? null : 'To pole nie może być puste.');
	});

	$("#add_vehicle_form").submit(function(event){
		event.preventDefault();

		var makesList = $('#makes_list'),
			modelsList = $('#models_list');

		makesList.parent().siblings('span').text(makesList.val() ? null : 'To pole nie może być puste.');
		modelsList.parent().siblings('span').text(modelsList.val() ? null : 'To pole nie może być puste.');

		if (!makesList.val() || !modelsList.val()) return;

		var data = 'header=add_vehicle&' + $(this).serialize(),
			response = post(data);

		response.done(function(errors, status, jqXHR){
			// console.log(data);
			// console.log(errors, status, jqXHR);
			try {
				if (!errors)
				{
					changeView('/my_vehicles');
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
