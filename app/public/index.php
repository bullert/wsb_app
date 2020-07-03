<?php include('router.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

		<link rel="stylesheet" type="text/css" href="<?php assets('css/main.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php assets('css/navbar.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php assets('css/searchbar.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php assets('css/footer.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php assets('css/forms.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php assets('css/tables.css'); ?>">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

		<script src="<?php assets('js/materialize_init.js'); ?>"></script>
		<script src="<?php assets('js/redir.js'); ?>"></script>

		<title>Page Title</title>
	</head>
	<body>
	 
		<?php views('main_view.php') ?>
		
	</body>
</html>
