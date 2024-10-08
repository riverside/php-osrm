<?php
include __DIR__ . '/../src/autoload.php';

$matcher = new \Riverside\Osrm\Service\Matcher();

try {
	$response = $matcher->fetch('13.388860,52.517037;13.397634,52.529407');
	if ($response->isOK())
    {
		echo '<pre>';
		print_r($response->toArray());
	} else {
		echo 'Match not found.';
	}
} catch (\Riverside\Osrm\Exception $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}
