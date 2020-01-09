<?php
include __DIR__ . '/../src/autoload.php';

$table = new \OSRM\Service\Table();

try {
	$response = $table
        //->setAnnotations('distance')
        ->fetch('13.388860,52.517037;13.397634,52.529407;13.428555,52.523219');
	if ($response->isOK())
    {
		echo '<pre>';
		print_r($response->toArray());
	} else {
		echo 'Table not found.';
	}
} catch (\OSRM\Exception $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}
