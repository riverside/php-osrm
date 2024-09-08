<?php
include __DIR__ . '/../src/autoload.php';

$nearest = new \Riverside\Osrm\Service\Nearest();

try {
	$response = $nearest
        ->setNumber(5)
        ->fetch('13.388860,52.517037');
	if ($response->isOK())
    {
		echo '<pre>';
		print_r($response->toArray());
	} else {
		echo 'Nearest not found.';
	}
} catch (\Riverside\Osrm\Exception $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}
