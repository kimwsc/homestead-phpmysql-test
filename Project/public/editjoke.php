<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {

	if (isset($_POST['joketext'])) {

		save($pdo, 'joke', 'id', [
			'id' => $_POST['jokeid'],
			'joketext' => $_POST['joketext'],
			'authorid' => 1,
			'jokedate' => new DateTime()
		]);

		header ('location: jokes.php');

	} else {

		if (isset($_GET['id'])) {
			$joke = findById($pdo, 'joke', 'id', $_GET['id']);
		}

		$title = 'Edit joke';

		ob_start();

		include __DIR__ . '/../templates/editjoke.html.php';

		$output = ob_get_clean();
	}

} catch (PDOException $e){
	$title  = 'An error occurred';

	$output = 'Database error: ' .
	$e->getMessage() . ' in ' .
	$e->getFile() . ' : ' .
	$e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';