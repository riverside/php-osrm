<?php
include __DIR__ . '/../src/autoload.php';

$match = new \OSRM\Service\Match();

try {
	$response = $match->fetch('13.388860,52.517037;13.397634,52.529407');
	if ($response->isOK())
    {
		echo '<pre>';
		print_r($response->toArray());
	} else {
		echo 'Match not found.';
	}
} catch (\OSRM\Exception $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}
