<?php if (session_status() != PHP_SESSION_ACTIVE) session_start(); ?>
<?php if (isset($_SESSION['session_id'])) : ?>

<div id="my-vehicles-list" class="card-panel" style="margin: 100px; padding: 0;">

	<div>
		<h6>Moje pojazdy</h6>
		<a id="my-vehicles-list-dropdown-trigger" class="dropdown-trigger" data-target="my-vehicles-list-dropdown">
			<i class="material-icons grey-text text-lighten-1">more_vert</i>
		</a>
	</div>

	<ul id="my-vehicles-list-dropdown" class="dropdown-content">
		<li><a class="href" href="/my_vehicles/new">Dodaj</a></li>
		<?php if (isset($_SESSION['vehicles']) && count($_SESSION['vehicles']) > 0) : ?>
			<li><a id="my-vehicles-list-edit-mode-trigger">Edytuj</a></li>
			<li><a id="my-vehicles-list-delete-trigger">Usuń</a></li>
		<?php endif; ?>
	</ul>

	<li class="divider"></li>

	<?php if (isset($_SESSION['vehicles']) && count($_SESSION['vehicles']) == 0) : ?>
		<h6 class="table-no-results">Nie znaleziono żadnych pojazdów ;_;</h6>
	<?php else : ?>

	<table class="highlight">

        <thead>
			<tr>
				<th id="my-vehicles-list-check-all-trigger" data-targget="my-vehicles-list-edit-mode">
					<label>
						<input type="checkbox" class="filled-in" />
						<span class="tooltipped" data-position="bottom" data-tooltip="zaznacz wszystko"></span>
					</label>
				</th>
				<th>Marka</th>
				<th>Model</th>
				<th>Średnie spalanie</th>
			</tr>
        </thead>
		<tbody>

			<?php if (isset($_SESSION['vehicles'])) : foreach ($_SESSION['vehicles'] as $vehicle) : ?>

				<tr>
					<td data-targget="my-vehicles-list-edit-mode">
						<label>
							<input type="checkbox" class="filled-in" />
							<span></span>
						</label>
					</td>
					<td id="vehicle_id"><?php echo $vehicle['vehicle_unit_id']; ?></td>
					<td><?php echo $vehicle['make']; ?></td>
					<td><?php echo $vehicle['model']; ?></td>
					<td><?php echo $vehicle['vehicle_unit_id']; ?></td>
				</tr>

			<?php endforeach; endif; ?>

        </tbody>

	</table>

	<?php endif; ?>

</div>

<?php endif; ?>

<div id="my-vehicles-list-removal-modal" class="modal" style="width: 400px;">
	<div class="modal-content">
		<h6 style="font-size: 18px; font-weight: 500;">Czy aby na pewno?</h6>
		<p>Czy na pewno chcesz usunąć zaznaczone elementy, nie będą one więcej dostępne.</p>
	</div>
	<div class="modal-footer">
		<a class="modal-close waves-effect btn-flat grey-text" style="font-weight: 500;">Anuluj</a>
		<a id="my-vehicles-list-removal-modal-confrim" class="modal-close waves-effect btn-flat red-text" style="font-weight: 500;">Usuń</a>
	</div>
</div>

<script>

	navigate();

	// init dropdown

	$('#my-vehicles-list-dropdown-trigger').dropdown({alignment: 'right', constrainWidth: false});

	// init modal

	$('#my-vehicles-list-removal-modal').modal();

	// init tooltip

	$('.tooltipped').tooltip();

	// toggle edit mode

	$('#my-vehicles-list-edit-mode-trigger').click(function(){

		$('*[data-targget="my-vehicles-list-edit-mode"]').toggleClass('edit-mode');
	});

	// check, uncheck all

	$('#my-vehicles-list-check-all-trigger').click(function(){
		let isChecked = $(this).find('input[type=checkbox]').prop('checked'),
			value = isChecked ? false : true;

		$('*[data-targget="my-vehicles-list-edit-mode"]').find('input[type=checkbox]').prop('checked', value);
	});

	// open removal modal

	$('#my-vehicles-list-delete-trigger').click(function(){
		let modal = $('#my-vehicles-list-removal-modal'),
			instance = M.Modal.getInstance($('#my-vehicles-list-removal-modal'));
		instance.open();
	});

	// remove checked elements

	$('#my-vehicles-list-removal-modal-confrim').click(function(){
		var removed = [];
		$('td[data-targget="my-vehicles-list-edit-mode"]').each(function(){
			let isChecked = $(this).find('input[type=checkbox]').prop('checked');
			if (isChecked) removed.push($(this).siblings('td#vehicle_id').text());
		});

		if (removed.length == 0) return;
		var data = 'header=delete_vehicles&vehicles=' + removed;
		console.log(data);
		var response = post2(data);

		response.done(function(result, status, jqXHR){
			console.log(data);
			console.log(result, status, jqXHR);
			try {
				let errors = response.responseJSON;
				console.log(errors);

				if (errors)
				{

				}
				else
				{
					// alert();
					changeView('/my_vehicles');
					// $('#nav-container').load('../../app/src/components/navbar.php');
				}
			}
			catch (e)
			{
				console.log(e);
			}
		});
	});

</script>
