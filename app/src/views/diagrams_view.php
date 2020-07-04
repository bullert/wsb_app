<?php if (session_status() != PHP_SESSION_ACTIVE) session_start(); ?>
<?php if (isset($_SESSION['session_id'])) : ?>
<div class="row" style="padding: 0 !important; margin: 0 !important; height: auto;">

	<div class="col s12" style="padding: 0 !important; margin: 0 !important; height: auto;">

		<div id="diagram" class="card-panel" style="margin: 100px 0 0 0 !important;">

			<div class="diagram-data-vehicle">

				<p class="diagram-data-vehicle-name"></p>

				<div class="progress">
					<div class="determinate teal lighten-1"></div>
				</div>
				<div class="progress">
					<div class="determinate teal accent-1"></div>
				</div>

				<div class="progress">
					<div class="determinate light-blue"></div>
				</div>
				<div class="progress">
					<div class="determinate light-blue accent-1"></div>
				</div>

				<div class="progress">
					<div class="determinate amber"></div>
				</div>
				<div class="progress">
					<div class="determinate amber accent-1"></div>
				</div>

			</div>

			<div class="diagram-data-vehicle">

				<p class="diagram-data-vehicle-name"></p>

				<div class="progress">
					<div class="determinate teal lighten-1"></div>
				</div>
				<div class="progress">
					<div class="determinate teal accent-1"></div>
				</div>

				<div class="progress">
					<div class="determinate light-blue"></div>
				</div>
				<div class="progress">
					<div class="determinate light-blue accent-1"></div>
				</div>

				<div class="progress">
					<div class="determinate amber"></div>
				</div>
				<div class="progress">
					<div class="determinate amber accent-1"></div>
				</div>

			</div>

		</div>

	</div>

</div>
<div class="row">

	<div class="col s12 xl6 push-xl6">
		<div class="input-field">
			<table class="diagram-legend">
				<tr>
					<td>spalanie:</td>
					<td class="center-align">minimalne:</td>
					<td class="center-align">średnie:</td>
					<td class="center-align">maksymalne:</td>
				</tr>
				<tr>
					<td>wyniki twojego egzemplarzu:</td>
					<td><div class="block teal lighten-1"></div></td>
					<td><div class="block light-blue"></div></td>
					<td><div class="block amber"></div></td>
				</tr>
				<tr>
					<td>ogólne wyniki tego modelu:</td>
					<td><div class="block teal accent-1"></div></td>
					<td><div class="block light-blue accent-1"></div></td>
					<td><div class="block amber accent-1"></div></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="col s12 l6 xl3 pull-xl6">
		<div class="input-field">
			<select id="compare1" class="compare-vehicles">
				<option value="" disabled selected>Wybierz</option>
				<?php
					foreach ($_SESSION['vehicles'] as $vehicle)
					{
						echo "<option value=\"{$vehicle['vehicle_unit_id']}\">{$vehicle['make']} {$vehicle['model']}</option>";
					}
				 ?>
			</select>
			<label>Pojazd 1</label>
			<span class="helper-text red-text"></span>
		</div>
	</div>

	<div class="col s12 l6 xl3 pull-xl6">
		<div class="input-field">
			<select id="compare2" class="compare-vehicles">
				<option value="" disabled selected>Wybierz</option>
				<?php
					foreach ($_SESSION['vehicles'] as $vehicle)
					{
						echo "<option value=\"{$vehicle['vehicle_unit_id']}\">{$vehicle['make']} {$vehicle['model']}</option>";
					}
				 ?>
			</select>
			<label>Pojazd 2</label>
			<span class="helper-text red-text"></span>
		</div>
	</div>

</div>
<?php endif; ?>

<script type="text/javascript">

	navigate();

	$('#compare1').formSelect();
	$('#compare2').formSelect();

	var data = 'header=get_fuel_consumption_data',
		response = post(data);

	response.done(function(result, status, jqXHR){

		// console.log(result, status, jqXHR, response);
		try {

			if (result && result['my_models_data'] && result['my_models_general_data'])
			{
				var myModelsData = result['my_models_data'],
					myModelsGeneralData = result['my_models_general_data'];

				$('.compare-vehicles').change(function(){
					var id1 = parseInt($('#compare1').val()),
						id2 = parseInt($('#compare2').val());

					if (isNaN(id1) || isNaN(id2)) return;

					var max = Math.max(myModelsData[id1]['max'], myModelsGeneralData[id1]['max'],
									   myModelsData[id2]['max'], myModelsGeneralData[id2]['max']) / 80;

					var base = $("#diagram .diagram-data-vehicle"),
						progressbars1 = base.eq(0).children('.progress'),
						progressbars2 = base.eq(1).children('.progress');

					$("#diagram .diagram-data-vehicle-name").eq(0).text($('#compare1 option:selected').text());
					$("#diagram .diagram-data-vehicle-name").eq(1).text($('#compare2 option:selected').text());

					progressbars1.eq(0).children('.determinate')
						.css('width', myModelsData[id1]['min'] / max + '%')
						.html('<p>'+(parseFloat(myModelsData[id1]['min'])).toFixed(2)+'</p>');
					progressbars1.eq(1).children('.determinate')
						.css('width', myModelsGeneralData[id1]['min'] / max + '%')
						.html('<p>'+(parseFloat(myModelsGeneralData[id1]['min'])).toFixed(2)+'</p>');
					progressbars1.eq(2).children('.determinate')
						.css('width', myModelsData[id1]['avg'] / max + '%')
						.html('<p>'+(parseFloat(myModelsData[id1]['avg'])).toFixed(2)+'</p>');
					progressbars1.eq(3).children('.determinate')
						.css('width', myModelsGeneralData[id1]['avg'] / max + '%')
						.html('<p>'+(parseFloat(myModelsGeneralData[id1]['avg'])).toFixed(2)+'</p>');
					progressbars1.eq(4).children('.determinate')
						.css('width', myModelsData[id1]['max'] / max + '%')
						.html('<p>'+(parseFloat(myModelsData[id1]['max'])).toFixed(2)+'</p>');
					progressbars1.eq(5).children('.determinate')
						.css('width', myModelsGeneralData[id1]['max'] / max + '%')
						.html('<p>'+(parseFloat(myModelsGeneralData[id1]['max'])).toFixed(2)+'</p>');

					progressbars2.eq(0).children('.determinate')
						.css('width', myModelsData[id2]['min'] / max + '%')
						.html('<p>'+(parseFloat(myModelsData[id2]['min'])).toFixed(2)+'</p>');
					progressbars2.eq(1).children('.determinate')
						.css('width', myModelsGeneralData[id2]['min'] / max + '%')
						.html('<p>'+(parseFloat(myModelsGeneralData[id2]['min'])).toFixed(2)+'</p>');
					progressbars2.eq(2).children('.determinate')
						.css('width', myModelsData[id2]['avg'] / max + '%')
						.html('<p>'+(parseFloat(myModelsData[id2]['avg'])).toFixed(2)+'</p>');
					progressbars2.eq(3).children('.determinate')
						.css('width', myModelsGeneralData[id2]['avg'] / max + '%')
						.html('<p>'+(parseFloat(myModelsGeneralData[id2]['avg'])).toFixed(2)+'</p>');
					progressbars2.eq(4).children('.determinate')
						.css('width', myModelsData[id2]['max'] / max + '%')
						.html('<p>'+(parseFloat(myModelsData[id2]['max'])).toFixed(2)+'</p>');
					progressbars2.eq(5).children('.determinate')
						.css('width', myModelsGeneralData[id2]['max'] / max + '%')
						.html('<p>'+(parseFloat(myModelsGeneralData[id2]['max'])).toFixed(2)+'</p>');
				});
			}
		}
		catch (e)
		{
			console.log(e);
		}
	});

</script>
