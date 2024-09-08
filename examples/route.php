<?php
include __DIR__ . '/../src/autoload.php';

$route = new \Riverside\Osrm\Service\Route();

try {
	$response = $route
        ->setSteps('true')
        ->fetch('13.388860,52.517037;13.397634,52.529407');
	if ($response->isOK())
    {
		echo '<pre>';
		print_r($response->toArray());
	} else {
		echo 'Route not found.';
	}
} catch (\Riverside\Osrm\Exception $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}
