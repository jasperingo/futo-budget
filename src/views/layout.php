<!DOCTYPE html>
<html>
	<head>
		<base href="/" />
		
		<meta charset="UTF-8" />
		
		<title>Futo Budget</title>
	
		<meta name="viewport"  content="width=device-width, initial-scale=1.0" />

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

		<link rel="shortcut icon" href="res/futo-logo.png" type="image/png" />
	</head>

	<body>
		<?= $this->fetch('./header.php') ?>

		<?php if (isset($user)) : ?>

		<div class="d-flex">
			<?= $this->fetch('./nav.php') ?>

			<main class="border flex-fill"><?= $content ?></main>
		<div>

		<?php else: ?>

		<main><?= $content ?></main>

		<?php endif; ?>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	</body>

</html>
